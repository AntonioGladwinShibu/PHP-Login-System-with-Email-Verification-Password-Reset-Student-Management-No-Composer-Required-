<?php
require 'config.php';

header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename="student_data.csv"');

$output = fopen("php://output", "w");

// Column headers
fputcsv($output, ['Name', 'Age', 'Contact']);

// Fetch student data
$sql = "SELECT student_name, student_age, contact FROM students";
$stmt = $conn->prepare($sql);
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Write data
foreach ($students as $row) {
    fputcsv($output, [$row['student_name'], $row['student_age'], $row['contact']]);
}

fclose($output);
exit;
