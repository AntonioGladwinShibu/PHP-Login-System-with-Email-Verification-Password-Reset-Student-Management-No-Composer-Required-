<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars(trim($_POST['student_name'] ?? ''), ENT_QUOTES, 'UTF-8');
    $father_name = htmlspecialchars(trim($_POST['father_name'] ?? ''), ENT_QUOTES, 'UTF-8');
    $father_age = filter_var($_POST['father_age'] ?? '', FILTER_VALIDATE_INT);
    $mother_name = htmlspecialchars(trim($_POST['mother_name'] ?? ''), ENT_QUOTES, 'UTF-8');
    $mother_age = filter_var($_POST['mother_age'] ?? '', FILTER_VALIDATE_INT);
    $student_age = filter_var($_POST['student_age'] ?? '', FILTER_VALIDATE_INT);
    $tenth_mark = htmlspecialchars(trim($_POST['tenth_mark'] ?? ''), ENT_QUOTES, 'UTF-8');
    $twelfth_mark = htmlspecialchars(trim($_POST['twelfth_mark'] ?? ''), ENT_QUOTES, 'UTF-8');
    $cgpa = htmlspecialchars(trim($_POST['cgpa'] ?? ''), ENT_QUOTES, 'UTF-8');
    $address = htmlspecialchars(trim($_POST['address'] ?? ''), ENT_QUOTES, 'UTF-8');
    $contact = htmlspecialchars(trim($_POST['contact'] ?? ''), ENT_QUOTES, 'UTF-8');
    $created_at = date('Y-m-d H:i:s');

    // Basic validation
    if (empty($name) || empty($father_name) || empty($mother_name) || empty($address) || empty($contact)) {
        die("Error: Required fields missing.");
    }
    if ($father_age < 18 || $father_age > 100 || $mother_age < 18 || $mother_age > 100 || $student_age < 5 || $student_age > 100) {
        die("Error: Invalid age values.");
    }
    if (!is_numeric($tenth_mark) || !is_numeric($twelfth_mark) || !is_numeric($cgpa)) {
        die("Error: Marks and CGPA must be numeric.");
    }

    // File upload
    if (!isset($_FILES['photo']) || $_FILES['photo']['error'] !== UPLOAD_ERR_OK) {
        die("Error: Photo upload failed.");
    }

    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $fileType = $_FILES['photo']['type'];
    if (!in_array($fileType, $allowedTypes)) {
        die("Error: Only JPEG, PNG, and GIF files allowed.");
    }

    $maxSize = 5 * 1024 * 1024;
    if ($_FILES['photo']['size'] > $maxSize) {
        die("Error: File must be less than 5MB.");
    }

    $uploadDir = "uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $photoName = time() . '_' . preg_replace("/[^a-zA-Z0-9.]/", "", $_FILES['photo']['name']);
    $photoPath = $uploadDir . $photoName;

    if (!move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath)) {
        die("Error: Failed to save photo.");
    }

    try {
        $stmt = $conn->prepare("INSERT INTO students (student_name, father_name, father_age, mother_name, mother_age, student_age, tenth_mark, twelfth_mark, cgpa, address, contact, photo, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $father_name, $father_age, $mother_name, $mother_age, $student_age, $tenth_mark, $twelfth_mark, $cgpa, $address, $contact, $photoName, $created_at]);

        echo "<div style='text-align:center; color: green; background-color: #e6ffe6; padding: 10px; border-radius: 5px; margin: 10px auto; max-width:600px;'>Student registered successfully!</div>";
    } catch (Exception $e) {
        if (file_exists($photoPath)) unlink($photoPath);
        die("<div style='color:red;text-align:center;'>Error: " . $e->getMessage() . "</div>");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Student</title>
    <style>
        body {
            background: #f8f8f8;
            font-family: Arial, sans-serif;
        }
        form {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }
        input, textarea {
            width: 100%;
            margin: 10px 0;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }
        input[type="file"] {
            border: none;
        }
        button {
            background-color: #cc0000;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            width: 100%;
            cursor: pointer;
        }
        button:hover {
            background-color: #a60000;
        }
        a {
            display: block;
            text-align: center;
            text-decoration: none;
            background: #333;
            color: white;
            padding: 10px;
            margin: 20px auto;
            width: fit-content;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<form method="post" enctype="multipart/form-data">
    <h2 style="text-align:center;">Register Student</h2>
    <input type="text" name="student_name" placeholder="Student Name" required>
    <input type="text" name="father_name" placeholder="Father's Name" required>
    <input type="number" name="father_age" placeholder="Father's Age" required>
    <input type="text" name="mother_name" placeholder="Mother's Name" required>
    <input type="number" name="mother_age" placeholder="Mother's Age" required>
    <input type="number" name="student_age" placeholder="Student Age" required>
    <input type="text" name="tenth_mark" placeholder="10th Mark (%)" required>
    <input type="text" name="twelfth_mark" placeholder="12th Mark (%)" required>
    <input type="text" name="cgpa" placeholder="College CGPA" required>
    <textarea name="address" placeholder="Address" required></textarea>
    <input type="text" name="contact" placeholder="Contact" required>
    <input type="file" name="photo" required><br><br>
    <button type="submit">Register</button>
</form>

<a href="list_students.php">View Students</a>

</body>
</html>
