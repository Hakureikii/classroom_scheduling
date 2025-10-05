<?php
include_once("../../connection.php");

$stmt = $conn->prepare("SELECT * FROM rooms");
$stmt->execute();
$rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($rooms);
?>