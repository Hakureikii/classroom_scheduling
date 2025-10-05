<?php
include_once("../../connection.php");
$stmt = $conn -> prepare("SELECT *, CONCAT(s.last_name, ', ', s.first_name, ' ', s.middle_name) AS student_name 
FROM students as s");
$stmt -> execute();
$students = $stmt -> fetchAll(PDO::FETCH_ASSOC);
echo json_encode($students);

?>