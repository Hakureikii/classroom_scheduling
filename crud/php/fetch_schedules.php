<?php
include_once("../../connection.php");
$instructor_id = $_POST["instructor_id"];
$stmt = $conn->prepare("SELECT 
    i.instructor_id,
    sch.schedule_id, 
    sch.day, 
    rm.room_name, 
    s.section_name, 
    c.course_code, 
    CONCAT(i.last_name, ', ', i.first_name) AS instructor, 
    DATE_FORMAT(sch.time_start, '%l:%i %p') AS time_start_formatted, 
    DATE_FORMAT(sch.time_end, '%l:%i %p') AS time_end_formatted
FROM teaching_assignments AS ta
INNER JOIN instructors AS i ON i.instructor_id = ta.instructor_id
INNER JOIN sections AS s ON s.section_id = ta.section_id
INNER JOIN courses AS c ON c.course_id = ta.course_id
INNER JOIN schedules AS sch ON sch.assignment_id = ta.assignment_id
INNER JOIN rooms AS rm ON sch.room_id = rm.room_id
WHERE i.instructor_id = :instructor_id
ORDER BY FIELD(sch.day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');");

$stmt->execute([
   ":instructor_id" => $instructor_id
]);
$schedules = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($schedules) > 0) {
   echo json_encode($schedules);
} else {
   echo json_encode(["msg" => "no schedules"]);
}

?>