<?php
include_once("../../connection.php");

$course_code = $_POST["course_code"];
$descriptive_title = $_POST["descriptive_title"];
$units = $_POST["units"];

   // Check if course already exists
   $check = $conn->prepare("SELECT * FROM courses WHERE course_code = :course_code AND descriptive_title = :descriptive_title");
   $check->execute(
      [
         ":course_code" => $course_code,
         ":descriptive_title" => $descriptive_title,
         ]
   );
   if ($check->rowCount() > 0) {
      echo "Course code already exists.";
      exit;
   } else {
      // Insert new course
      $stmt = $conn->prepare("INSERT INTO courses (course_code, descriptive_title, units) 
                                VALUES (:course_code, :descriptive_title, :units)");
      $stmt->execute([
         ":course_code" => $course_code,
         ":descriptive_title" => $descriptive_title,
         ":units" => $units
      ]);

      echo "success";
   }
?>