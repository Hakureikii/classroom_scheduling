<?php
session_start();
include_once "../../connection.php";

// PHPMailer files
require "../../PHPMailer-master/src/PHPMailer.php";
require "../../PHPMailer-master/src/Exception.php";
require "../../PHPMailer-master/src/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

date_default_timezone_set('Asia/Singapore');

$instructor_id = $_SESSION["instructorID"];
$room = $_POST["room"];
$date = $_POST["date"];
$day = date("l", strtotime($date));
$assignment = $_POST["assignment"];
$session_type = $_POST["session_type"];
$time_start = $_POST["time_start"];
$time_end = $_POST["time_end"];

// GET SECTION
$fetch = $conn->prepare("SELECT section_id FROM teaching_assignments WHERE assignment_id = :assignment_id");
$fetch->execute([":assignment_id" => $assignment]);
$section = $fetch->fetch(PDO::FETCH_COLUMN);

// GET STUDENT EMAILS
$emails_stmt = $conn->prepare("SELECT email FROM students WHERE section_id = :section_id");
$emails_stmt->execute([":section_id" => $section]);
$student_emails = $emails_stmt->fetchAll(PDO::FETCH_COLUMN);

// CHECK IF INSTRUCTOR AVAILABLE
$i_available = $conn->prepare("
    SELECT * 
    FROM schedules sch
    INNER JOIN teaching_assignments ta ON ta.assignment_id = sch.assignment_id
    WHERE ta.instructor_id = :instructor_id
    AND day = :day
    AND (time_start < :new_end AND time_end > :new_start)
");
$i_available->execute([
    ":instructor_id" => $instructor_id,
    ":day" => $day,
    ":new_end" => $time_end,
    ":new_start" => $time_start
]);

// CHECK IF ROOM AVAILABLE
$r_available = $conn->prepare("
    SELECT * FROM schedules 
    WHERE room_id = :room_id
    AND day = :day
    AND (time_start < :new_end AND time_end > :new_start)
");
$r_available->execute([
    ":room_id" => $room,
    ":day" => $day,
    ":new_end" => $time_end,
    ":new_start" => $time_start
]);

// CHECK IF SECTION AVAILABLE
$s_available = $conn->prepare("
    SELECT * 
    FROM schedules sch
    INNER JOIN teaching_assignments ta ON ta.assignment_id = sch.assignment_id
    WHERE ta.section_id = :section_id
    AND day = :day
    AND (time_start < :new_end AND time_end > :new_start)
");
$s_available->execute([
    ":section_id" => $section,
    ":day" => $day,
    ":new_end" => $time_end,
    ":new_start" => $time_start
]);

// AVAILABILITY LOGIC
if ($i_available->rowCount() > 0) {
    echo "instructor not available";
    exit;
}
if ($room_avail = $r_available->rowCount() > 0) {
    echo "conflicting schedules";
    exit;
}
if ($s_available->rowCount() > 0) {
    echo "section not available";
    exit;
}

// INSERT SESSION
$insert = $conn->prepare("
    INSERT INTO sessions(assignment_id, session_room_id, session_type, session_day, date_issued, time_start, time_end)
    VALUES(:assignment_id, :room_id, :session_type, :day, :date_issued, :time_start, :time_end)
");
$insert->execute([
    ":assignment_id" => $assignment,
    ":room_id" => $room,
    ":session_type" => $session_type,
    ":day" => $day,
    ":date_issued" => $date,
    ":time_start" => $time_start,
    ":time_end" => $time_end,
]);

// EMAIL CONTENT
$subject = "New Session Scheduled";
$message = "Dear Student,\n\nA new session has been scheduled:\n";
$message .= "Room: $room\n";
$message .= "Date: $date ($day)\n";
$message .= "Time: $time_start - $time_end\n";
$message .= "Session Type: $session_type\n\n";
$message .= "For more details please check your account.";

// SEND EMAILS
$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'classrooomscheduling@gmail.com'; 
    $mail->Password = 'vdzc txgv wtkm ibmf';  
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('no-reply@yourdomain.com', 'ICAS');

    foreach ($student_emails as $email) {
        $mail->addAddress($email);
    }

    $mail->isHTML(false);
    $mail->Subject = $subject;
    $mail->Body = $message;

    $mail->send();
    echo "session added and notifications sent";
} catch (Exception $e) {
    echo "session added but email failed: {$mail->ErrorInfo}";
}
?>
