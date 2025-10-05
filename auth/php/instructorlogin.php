<?php
session_start();
include_once("../../connection.php");
$email = $_POST["email"];
$password = $_POST["password"];
$stmt = $conn->prepare("SELECT * FROM instructors WHERE email = :email AND password = :password");
$stmt->execute([
    ":email" => $email,
    ":password" => $password,
]);
$instructor = $stmt->fetch(PDO::FETCH_ASSOC);

if ($instructor === false) {
    echo "err";
} else {
    $_SESSION["instructorID"] = $instructor["instructor_id"];
    $_SESSION["instructorName"] = $instructor["first_name"];
    echo "granted";
}

?>