<?php
include_once("../../connection.php");
$stmt = $conn -> prepare("SELECT * FROM admin");
$stmt -> execute();
$admin = $stmt -> fetchAll(PDO::FETCH_ASSOC);
echo json_encode($admin);

?>