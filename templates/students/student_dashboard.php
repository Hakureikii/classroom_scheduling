<?php
session_start();
if (!isset($_SESSION["studentID"]) && !isset($_SESSION["studentName"])) {
    header("Location: ../index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Dashboard </title>
    <h1> <?php echo $_SESSION["studentName"]?> </h1>
    <a href="../../auth/php/logout.php"> Logout </a>
</head>

<body>

</body>

</html>