<?php
include_once "../../connection.php";

$room_id = $_POST["room_id"];
$stmt = $conn->prepare("(
SELECT 
    r.room_name,
    CONCAT(c.course_code, ': ', c.descriptive_title) AS course,
    CONCAT(i.last_name, ', ', i.first_name) AS instructor,
    s.section_name,
    sch.time_start,
    sch.time_end,
    sch.day,
    sch.type AS schedule_type
FROM schedules AS sch
INNER JOIN rooms AS r ON r.room_id = sch.room_id
INNER JOIN teaching_assignments AS ta ON ta.assignment_id = sch.assignment_id
INNER JOIN sections AS s ON s.section_id = ta.section_id
INNER JOIN courses AS c ON c.course_id = ta.course_id
INNER JOIN instructors AS i ON i.instructor_id = ta.instructor_id
WHERE r.room_name = :room_id
  AND sch.day = DAYNAME(NOW())
  AND TIME(NOW()) BETWEEN sch.time_start AND sch.time_end
)

UNION ALL

(
SELECT 
    r.room_name,
    c.descriptive_title AS course,  -- sessions do not have course_code
    CONCAT(i.last_name, ', ', i.first_name) AS instructor,
    s.section_name,
    ses.time_start,
    ses.time_end,
    ses.session_day AS day,
    ses.session_type AS schedule_type
FROM sessions AS ses
INNER JOIN rooms AS r ON r.room_id = ses.session_room_id
INNER JOIN teaching_assignments AS ta ON ta.assignment_id = ses.assignment_id
INNER JOIN instructors AS i ON i.instructor_id = ta.instructor_id
INNER JOIN sections AS s ON s.section_id = ta.section_id
INNER JOIN courses AS c ON c.course_id = ta.course_id
WHERE r.room_name = :room_id
  AND ses.session_day = DAYNAME(NOW())
  AND TIME(NOW()) BETWEEN ses.time_start AND ses.time_end
);
");

$stmt->execute([
    ":room_id" => $room_id
]);

$current_schedule = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($current_schedule);

?>