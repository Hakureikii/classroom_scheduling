<?php
include_once("../../connection.php");

   $stmt = $conn->prepare("SELECT 
      ta.assignment_id,
      CONCAT(s.section_name, ' ', c.course_code, ' ', i.first_name, ' ', i.last_name) AS course_section,
      CONCAT(i.last_name, ', ', i.first_name, ' ', i.middle_name) AS instructor_name,
      s.section_name,
      c.course_code,
      c.descriptive_title
   FROM teaching_assignments ta
   INNER JOIN instructors i ON i.instructor_id = ta.instructor_id
   INNER JOIN sections s ON s.section_id = ta.section_id
   INNER JOIN courses c ON c.course_id = ta.course_id
   ORDER BY s.section_name ASC;
");

$stmt->execute();
$sections = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($sections) > 0) {
   echo json_encode($sections);
} else {
   echo json_encode(["msg" => "no assignments"]);
}
?> 