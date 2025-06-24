<?php include 'config.php'; ?>
<h2 style="text-align:center;color:red;">List of Students</h2>

<?php
$stmt = $conn->query("SELECT id, student_name, student_age, contact FROM students");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $link = "detail.php?id=" . $row['id'];
    echo "<div style='text-align:center;padding:10px;'>
            <a href='$link' style='text-decoration:none;color:black;'>
                <strong>Name:</strong> {$row['student_name']} |
                <strong>Age:</strong> {$row['student_age']} |
                <strong>Contact:</strong> {$row['contact']}
            </a>
          </div>";
}
?>

<div style="text-align:center;margin-top:30px;">
    <a href="student.php"
        style="text-decoration:none;color:white;background-color:red;padding:10px 20px;border-radius:5px;">Add
        Student</a>
</div>