<?php
include_once "../../connection.php";
$room_id = $_POST["room_id"];

$query = "
(
SELECT 
   sch.day AS day,
   sch.time_start,
   sch.time_end,
   rm.room_name,
   s.section_name,
   CONCAT(i.last_name, ', ', i.first_name) AS instructor,
   CONCAT(c.course_code, ': ', c.descriptive_title) AS course,
   DATE_FORMAT(sch.time_start, '%l:%i %p') AS time_start_formatted, 
   DATE_FORMAT(sch.time_end, '%l:%i %p') AS time_end_formatted,
   sch.type AS schedule_type,
   CASE 
      WHEN TIME(NOW()) BETWEEN sch.time_start AND sch.time_end THEN 'occupied'
      ELSE 'inactive'
   END AS status
FROM schedules AS sch
INNER JOIN rooms AS rm ON sch.room_id = rm.room_id
INNER JOIN teaching_assignments AS ta ON ta.assignment_id = sch.assignment_id
INNER JOIN courses AS c ON c.course_id = ta.course_id
INNER JOIN sections AS s ON s.section_id = ta.section_id
INNER JOIN instructors AS i ON i.instructor_id = ta.instructor_id
WHERE rm.room_name = :room_id
)

UNION ALL

(
SELECT 
   ses.session_day AS day,
   ses.time_start,
   ses.time_end,
   rm.room_name,
   s.section_name,
   CONCAT(i.last_name, ', ', i.first_name) AS instructor,
   c.descriptive_title AS course,
   DATE_FORMAT(ses.time_start, '%l:%i %p') AS time_start_formatted,
   DATE_FORMAT(ses.time_end, '%l:%i %p') AS time_end_formatted,
   ses.session_type AS schedule_type,
   CASE 
      WHEN TIME(NOW()) BETWEEN ses.time_start AND ses.time_end THEN 'occupied'
      ELSE 'inactive'
   END AS status
FROM sessions AS ses
INNER JOIN rooms AS rm ON rm.room_id = ses.session_room_id
INNER JOIN teaching_assignments AS ta ON ta.assignment_id = ses.assignment_id
INNER JOIN instructors AS i ON i.instructor_id = ta.instructor_id
INNER JOIN sections AS s ON s.section_id = ta.section_id
INNER JOIN courses AS c ON c.course_id = ta.course_id
WHERE rm.room_name = :room_id
)

ORDER BY FIELD(day, 'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'),
         time_start, status
";

$stmt = $conn->prepare($query);
$stmt->execute([
    ":room_id" => $room_id
]);

$room_schedule = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($room_schedule);
?>
