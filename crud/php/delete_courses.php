<?php
include_once("../../connection.php");

$course_id = $_POST["course_id"];

if (!empty($course_id)) {
    $stmt = $conn->prepare("DELETE FROM courses WHERE course_id = :course_id");
    $stmt->execute([
        ":course_id" => $course_id
    ]);
    echo "ok";
} else {
    echo "err";
}

?>