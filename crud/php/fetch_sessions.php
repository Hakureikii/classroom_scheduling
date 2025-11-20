<?php
session_start();
include_once "../../connection.php";

if (isset($_SESSION["instructorID"])) {
    $instructor_id = $_SESSION["instructorID"];
    $fetch = $conn->prepare("SELECT 
ses.session_day, ses.date_issued, rm.room_name, s.section_name, ses.session_type, c.descriptive_title, CONCAT(i.first_name, ' ', i.last_name) as instructor, DATE_FORMAT(ses.time_start, '%l:%i %p') AS time_start_formatted, DATE_FORMAT(ses.time_end, '%l:%i %p') AS time_end_formatted
FROM sessions as ses
INNER JOIN rooms as rm ON rm.room_id = ses.session_room_id
INNER JOIN teaching_assignments as ta ON ta.assignment_id = ses.assignment_id
INNER JOIN instructors as i ON i.instructor_id = ta.instructor_id
INNER JOIN sections as s ON s.section_id = ta.section_id
INNER JOIN courses as c ON c.course_id = ta.course_id

WHERE i.instructor_id = :instructor_id AND ses.archived = 0");
    $fetch->execute([
        ":instructor_id" => $instructor_id
    ]);
    $instructor_sessions = $fetch->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($instructor_sessions);

} else if (isset($_SESSION["studentID"])) {
    $student_id = $_SESSION["studentID"];
    $section_id = $_SESSION["studentSection"];
    $fetch2 = $conn->prepare("SELECT 
ses.session_day, ses.date_issued, rm.room_name, s.section_name, ses.session_type, c.descriptive_title, CONCAT(i.first_name, ' ', i.last_name) as instructor, DATE_FORMAT(ses.time_start, '%l:%i %p') AS time_start_formatted, DATE_FORMAT(ses.time_end, '%l:%i %p') AS time_end_formatted
FROM sessions as ses
INNER JOIN rooms as rm ON rm.room_id = ses.session_room_id
INNER JOIN teaching_assignments as ta ON ta.assignment_id = ses.assignment_id
INNER JOIN instructors as i ON i.instructor_id = ta.instructor_id
INNER JOIN sections as s ON s.section_id = ta.section_id
INNER JOIN courses as c ON c.course_id = ta.course_id

WHERE s.section_id = :section_id and ses.archived = 0");
    $fetch2->execute([
        ":section_id" => $section_id
    ]);
    $student_sessions = $fetch2->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($student_sessions);
} else {
    echo "unauthorized";
}


?>