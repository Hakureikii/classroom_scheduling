<?php
include_once("../../connection.php");
$stmt = $conn -> prepare("SELECT *, CONCAT(i.last_name, ', ', i.first_name, ' ', i.middle_name) AS instructor_name 
FROM instructors as i
ORDER BY instructor_name ASC");
$stmt -> execute();
$instructors = $stmt -> fetchAll(PDO::FETCH_ASSOC);
echo json_encode($instructors);

?>