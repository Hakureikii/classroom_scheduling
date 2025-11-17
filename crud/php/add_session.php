<?php
session_start();
include_once "../../connection.php";

$instructor_id = $_SESSION["instructorID"];
$room = $_POST["room"];
$date = $_POST["date"];
$day = date("l", strtotime($date));
$assignment = $_POST["assignment"];
$session_type = $_POST["session_type"];
$time_start = $_POST["time_start"];
$time_end = $_POST["time_end"];


// RETRIEVE SECTION
$fetch = $conn -> prepare("SELECT section_id FROM teaching_assignments WHERE assignment_id = :assignment_id");
$fetch -> execute([
    ":assignment_id" => $assignment
]);
$section = $fetch -> fetch(PDO::FETCH_COLUMN);


// CHECK IF INSTRUCTOR IS AVAILABLE
$i_available = $conn->prepare("SELECT * 
FROM schedules as sch
INNER JOIN teaching_assignments as ta ON ta.assignment_id = sch.assignment_id
INNER JOIN instructors as i ON i.instructor_id = ta.instructor_id
WHERE ta.instructor_id = :instructor_id
  AND day = :day
  AND (
      time_start < :new_end
      AND time_end > :new_start
  )
");
$i_available -> execute([
    ":instructor_id" => $instructor_id,
    ":day" => $day,
    ":new_end" => $time_end,
    ":new_start" => $time_start,
]);
$instructor_avail = $i_available -> fetchAll(PDO::FETCH_ASSOC);


// CHECK IF ROOM IS AVAILABLE
$r_available = $conn->prepare("SELECT * FROM schedules 
WHERE room_id = :room_id
  AND day = :day
  AND (
      time_start < :new_end
      AND time_end > :new_start
  )
");

$r_available -> execute([
    ":room_id" => $room,
    ":day" => $day,
    ":new_end" => $time_end,
    ":new_start" => $time_start,
]);
$room_avail = $r_available -> fetchAll(PDO::FETCH_ASSOC);


// CHECK IF SECTION IS AVAILABLE
$s_available = $conn->prepare("SELECT * 
FROM schedules as sch
INNER JOIN teaching_assignments as ta ON ta.assignment_id = sch.assignment_id
INNER JOIN sections as s ON s.section_id = ta.section_id
WHERE s.section_id = :section_id
  AND day = :day
  AND (
      time_start < :new_end
      AND time_end > :new_start
  )
");
$s_available -> execute([
    ":section_id" => $section,
    ":day" => $day,
    ":new_end" => $time_end,
    ":new_start" => $time_start,
]);
$section_avail = $s_available -> fetchAll(PDO::FETCH_ASSOC);


if ($instructor_avail !== []) {
    echo "instructor not available";
} else {
    if ($room_avail !== []) {
        echo "conflicting schedules";
    } else {
        if ($section_avail !== []) {
            echo "section not available";
        } else {
            $insert = $conn -> prepare("INSERT INTO sessions(assignment_id, room_id, session_type, day, date_issued, time_start, time_end)
            VALUES(:assignment_id, :room_id, :session_type, :day, :date_issued, :time_start, :time_end)");
            $insert -> execute([
                ":assignment_id" => $assignment,
                ":room_id" => $room,
                ":session_type" => $session_type,
                ":day" => $day,
                ":date_issued" => $date,
                ":time_start" => $time_start,
                ":time_end" => $time_end,
            ]);
            echo "session added";
        }
    }
}
?>