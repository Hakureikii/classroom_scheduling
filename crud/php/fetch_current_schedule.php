<?php
include_once "../../connection.php";

$room_id = $_POST["room_id"];
$stmt = $conn->prepare("SELECT r.room_name,
CONCAT(c.course_code, ': ', c.descriptive_title) as course,
CONCAT(i.last_name, ', ', i.first_name) as instructor,
s.section_name,
sch.*
FROM schedules as sch
INNER JOIN rooms as r ON r.room_id = sch.room_id
INNER JOIN teaching_assignments as ta ON ta.assignment_id = sch.assignment_id
INNER JOIN sections as s ON s.section_id = ta.section_id
INNER JOIN courses as c ON c.course_id = ta.course_id
INNER JOIN instructors as i ON i.instructor_id = ta.instructor_id
WHERE r.room_name = :room_id AND sch.day = DAYNAME(NOW()) AND TIME(NOW()) BETWEEN sch.time_start AND sch.time_end");

$stmt -> execute([
    ":room_id" => $room_id
]);

$current_schedule = $stmt -> fetchAll(PDO::FETCH_ASSOC);
echo json_encode($current_schedule);

?>