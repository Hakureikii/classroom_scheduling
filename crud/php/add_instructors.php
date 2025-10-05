<?php
include_once("../../connection.php");

$first_name = $_POST["first_name"];
$middle_name = $_POST["middle_name"];
$last_name = $_POST["last_name"];
$sex = $_POST["sex"];
$email = $_POST["email"];
$password = $_POST["password"];
$password_hash = password_hash($password, PASSWORD_DEFAULT);

if (
    !empty($first_name) &&
    !empty($middle_name) &&
    !empty($last_name) &&
    !empty($sex) &&
    !empty($email) &&
    !empty($password_hash)
) {
    $stmt = $conn->prepare("INSERT INTO instructors(first_name, middle_name, last_name, sex, email, password) VALUES(:first_name, :middle_name, :last_name, :sex, :email, :password_hash)");
    $stmt->execute([
        ":first_name" => $first_name,
        ":middle_name" => $middle_name,
        ":last_name" => $last_name,
        ":sex" => $sex,
        ":email" => $email,
        ":password_hash" => $password_hash
        
    ]);

    echo "ok";
} else {
    echo "err";
}

?>