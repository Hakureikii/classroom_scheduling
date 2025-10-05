<?php
include_once("../../connection.php");

$student_id = $_POST["student_id"];

if (!empty($student_id)) {
    $stmt = $conn->prepare("DELETE FROM students WHERE student_id = :student_id");
    $stmt->execute([
        ":student_id" => $student_id
    ]);
    echo "ok";
} else {
    echo "err";
}

?>