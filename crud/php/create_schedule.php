<?php
include_once("../../connection.php");
$day = $_POST["day"];
$new_start_time = $_POST["new_start_time"];
$new_end_time = $_POST["new_end_time"];
$room_no = $_POST["room_no"];
$course_assignment = $_POST["course_assignment"];

//Check for same schedule assignment on same day
$schedule = $conn->prepare("SELECT * FROM schedules WHERE day = :day AND assignment_id = :assignment_id");
$schedule->execute([
   ":day" => $day,
   ":assignment_id" => $course_assignment
]);
$existing = $schedule->fetchAll(PDO::FETCH_ASSOC); //schedule assignment variable


//Check number of sessions per week
$session = $conn->prepare("SELECT * FROM schedules WHERE assignment_id = :assignment_id");
$session->execute([
   ":assignment_id" => $course_assignment
]);
$session_count = $session->fetchAll(PDO::FETCH_ASSOC); //session count variable


//Check time difference to prevent sessions less than 30 minutes


//Check overlapping schedules to prevent insertion of overlapping schedules
$overlap = $conn->prepare("SELECT * FROM schedules WHERE day = :day AND time_start < :new_end_time AND time_end > :new_start_time AND room_id = :room_no");
$overlap->execute([
   ":day" => $day,
   ":new_end_time" => $new_end_time,
   ":new_start_time" => $new_start_time,
   ":room_no" => $room_no,
]);
$result = $overlap->fetchAll(PDO::FETCH_ASSOC);

//Prevent overlapping and duplicating schedules
// if (count($existing) > 0) { //Check schedule if existing on the same day
//    echo "assigned today!";
// } else {
//    if (count($session_count) < 2) { //Check if session count reaches the limit
//       if ($result === []) {
//       $stmt = $conn->prepare("INSERT INTO schedules(room_id, assignment_id, day, time_start, time_end) VALUES(:room_no, :course_assignment, :day, :new_start_time, :new_end_time)");
//       $stmt->execute([
//          ":room_no" => $room_no,
//          ":course_assignment" => $course_assignment,
//          ":day" => $day,
//          ":new_start_time" => $new_start_time,
//          ":new_end_time" => $new_end_time,
//       ]);
//       echo "success";

//       } else { //Overlapping schedule preventing insert
//          echo "overlap";
//       }
//    } else { //Session cap reached
//       echo "limit reached!";
//    }
// }

echo json_encode($result);

if ($result === []) {
   $stmt = $conn->prepare("INSERT INTO schedules(room_id, assignment_id, day, time_start, time_end) VALUES(:room_no, :course_assignment, :day, :new_start_time, :new_end_time)");
   $stmt->execute([
      ":room_no" => $room_no,
      ":course_assignment" => $course_assignment,
      ":day" => $day,
      ":new_start_time" => $new_start_time,
      ":new_end_time" => $new_end_time,
   ]);
   echo "success";
} else { //Overlapping schedule preventing insert
   echo "overlap";
}