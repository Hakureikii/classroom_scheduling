<?php
session_start();
include_once "../../connection.php";

$student_id = $_SESSION["studentID"];
$day = $_POST["day"];

$stmt = $conn->prepare("SELECT * FROM students WHERE student_id = :student_id");
$stmt->execute([
    ":student_id" => $student_id
]);
$section_id = $stmt->fetch(PDO::FETCH_ASSOC);


if ($day === "") {
    $schedule = $conn->prepare("SELECT *, 
CONCAT(c.course_code, ' ', c.descriptive_title) as course, 
CONCAT(i.last_name, ', ', i.first_name) as instructor,
DATE_FORMAT(sch.time_start, '%l:%i %p') AS time_start_formatted, 
DATE_FORMAT(sch.time_end, '%l:%i %p') AS time_end_formatted
FROM schedules as sch 
INNER JOIN rooms as r ON r.room_id = sch.room_id
INNER JOIN teaching_assignments as ta ON ta.assignment_id = sch.assignment_id
INNER JOIN courses as c ON c.course_id = ta.course_id
INNER JOIN sections as s ON s.section_id = ta.section_id
INNER JOIN students as st ON st.section_id = s.section_id
INNER JOIN instructors as i ON i.instructor_id = ta.instructor_id

WHERE s.section_id = :section_id AND st.student_id = :student_id
ORDER BY FIELD(sch.day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'), sch.time_start");

    $schedule->execute([
        ":section_id" => $section_id["section_id"],
        ":student_id" => $student_id,
    ]);

    $student_schedule = $schedule->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($student_schedule);

} else {
    $schedule = $conn->prepare("SELECT *, 
CONCAT(c.course_code, ' ', c.descriptive_title) as course, 
CONCAT(i.last_name, ', ', i.first_name) as instructor,
DATE_FORMAT(sch.time_start, '%l:%i %p') AS time_start_formatted, 
DATE_FORMAT(sch.time_end, '%l:%i %p') AS time_end_formatted
FROM schedules as sch 
INNER JOIN rooms as r ON r.room_id = sch.room_id
INNER JOIN teaching_assignments as ta ON ta.assignment_id = sch.assignment_id
INNER JOIN courses as c ON c.course_id = ta.course_id
INNER JOIN sections as s ON s.section_id = ta.section_id
INNER JOIN students as st ON st.section_id = s.section_id
INNER JOIN instructors as i ON i.instructor_id = ta.instructor_id

WHERE s.section_id = :section_id AND st.student_id = :student_id AND sch.day = :day
ORDER BY FIELD(sch.day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'), sch.time_start");

    $schedule->execute([
        ":section_id" => $section_id["section_id"],
        ":student_id" => $student_id,
        ":day" => $day,
    ]);

    $student_schedule = $schedule->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($student_schedule);
}



?>