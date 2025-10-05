<?php
include_once("../../connection.php");

$instructor_id = $_POST["instructor_id"];

if (!empty($instructor_id)) {
    $stmt = $conn->prepare("DELETE FROM instructors WHERE instructor_id = :instructor_id");
    $stmt->execute([
        ":instructor_id" => $instructor_id
    ]);
    echo "ok";
} else {
    echo "err";
}

?>