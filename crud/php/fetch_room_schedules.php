<?php
include_once "../../connection.php";
$room_id = $_POST["room_id"];

$stmt = $conn -> prepare("SELECT 
   sch.*,
   rm.room_name,
   s.section_name,
   CONCAT(i.last_name, ', ', i.first_name) as instructor,
   CONCAT(c.course_code, ': ', c.descriptive_title) as course,
   DATE_FORMAT(sch.time_start, '%l:%i %p') AS time_start_formatted, 
   DATE_FORMAT(sch.time_end, '%l:%i %p') AS time_end_formatted,
   CASE 
      WHEN TIME(NOW()) BETWEEN sch.time_start AND sch.time_end THEN 'occupied'
      ELSE 'inactive'
   END AS status
FROM schedules AS sch
INNER JOIN rooms as rm ON sch.room_id = rm.room_id
INNER JOIN teaching_assignments as ta ON ta.assignment_id = sch.assignment_id
INNER JOIN courses as c ON c.course_id = ta.course_id
INNER JOIN sections as s ON s.section_id = ta.section_id
INNER JOIN instructors as i ON i.instructor_id = ta.instructor_id
WHERE DAYNAME(NOW()) = sch.day AND room_name = :room_id
ORDER BY sch.time_start");
$stmt -> execute([
    ":room_id" => $room_id
]);

$room_schedule = $stmt -> fetchAll(PDO::FETCH_ASSOC);
echo json_encode($room_schedule);


?>