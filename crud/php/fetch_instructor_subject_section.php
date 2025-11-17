<?php
session_start();
include_once "../../connection.php";

$instructor_id = $_SESSION["instructorID"];

$stmt = $conn -> prepare("SELECT ta.assignment_id, CONCAT(s.section_name, ' ', c.descriptive_title) as sub_sec
FROM teaching_assignments as ta
INNER JOIN instructors as i ON i.instructor_id = ta.instructor_id
INNER JOIN courses as c ON c.course_id = ta.course_id
INNER JOIN sections as s ON s.section_id = ta.section_id
WHERE ta.instructor_id = :instructor_id");

$stmt -> execute([
    ":instructor_id" => $instructor_id
]);
$sub_sec = $stmt -> fetchAll(PDO::FETCH_ASSOC);
echo json_encode($sub_sec);

?>