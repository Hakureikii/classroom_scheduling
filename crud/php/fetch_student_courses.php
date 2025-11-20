<?php
session_start();
include_once "../../connection.php";
$section_id = $_SESSION["studentSection"];


$fetch = $conn->prepare("SELECT *, CONCAT(i.first_name, ' ', i.last_name) as instructor FROM teaching_assignments as ta
INNER JOIN instructors as i ON i.instructor_id = ta.instructor_id
INNER JOIN courses as c ON c.course_id = ta.course_id
INNER JOIN sections as s ON s.section_id = ta.section_id

WHERE ta.section_id = :section_id");

$fetch->execute([
    ":section_id" => $section_id
]);

$student_courses = $fetch->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($student_courses);


?>