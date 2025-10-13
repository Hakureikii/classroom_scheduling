<?php
include_once("../../connection.php");

$course_id = $_POST["course_id"];
$course_code = $_POST["course_code"];
$descriptive_title = $_POST["descriptive_title"];
$units = $_POST["units"];

if ($course_id && $course_code && $descriptive_title && $units) {
   $stmt = $conn->prepare("UPDATE courses SET course_code = :course_code, descriptive_title = :descriptive_title, units = :units WHERE course_id = :course_id");
   $stmt->execute([
      ":course_id"=> $course_id,
      ":course_code"=> $course_code,
      ":descriptive_title"=> $descriptive_title,
      ":units"=> $units,
   ]);
   echo "updated!";

} else {
   echo "Missing required fields.";
}
?>