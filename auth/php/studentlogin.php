<?php
session_start();
include_once("../../connection.php");
$email = $_POST["email"];
$password = $_POST["password"];
$stmt = $conn->prepare("SELECT * FROM students WHERE email = :email");
$stmt->execute([
    ":email" => $email,
]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if ($student == false) {
    echo "invalid";
} else {
    if (password_verify($password, $student['password'])) {
        $_SESSION["studentID"] = $student["student_id"];
        $_SESSION["studentName"] = $student["first_name"];
        $_SESSION["studentSection"] = $student["section_id"];
        echo "granted";
    } else {
        echo "err";
    }
}

?>