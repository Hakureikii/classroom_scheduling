<?php
include_once("../../connection.php");
$stmt = $conn -> prepare("SELECT *, CONCAT(c.course_code, ' ', c.descriptive_title) AS course_details
FROM courses as c");
$stmt -> execute();
$courses = $stmt -> fetchAll(PDO::FETCH_ASSOC);
echo json_encode($courses);

?>