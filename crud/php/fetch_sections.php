<?php
include_once("../../connection.php");
$stmt = $conn -> prepare("SELECT * FROM sections");
$stmt -> execute();
$sections = $stmt -> fetchAll(PDO::FETCH_ASSOC);
echo json_encode($sections);

?>