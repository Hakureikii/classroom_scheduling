<?php
session_start();
$instructor_id = $_SESSION["instructorID"];

$stmt = $conn -> prepare("SELECT * FROM teaching_assignments");

?>