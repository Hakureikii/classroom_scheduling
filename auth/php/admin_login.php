<?php
session_start();
include_once("../../connection.php");

$username = $_POST["username"];
$password = $_POST["password"];

$stmt = $conn->prepare("SELECT * FROM admin WHERE username = :username AND password = :password");
$stmt->execute([
   ":username" => $username,
   ":password" => $password,
]);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);

if ($admin === false) {
   echo "err";
} else {
   $_SESSION["admin_ID"] = $admin["admin_id"];
   $_SESSION["admin"] = $admin["username"];
   echo "granted";

}
?>