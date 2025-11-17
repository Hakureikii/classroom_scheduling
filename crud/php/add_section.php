<?php
include_once "../../connection.php";
$section_name = $_POST["section_name"];

if (!isset($section_name)) {
    echo "empty";
} else {
    $stmt = $conn->prepare("INSERT INTO sections(section_name) VALUES(:section_name)");
    $stmt->execute([
        ":section_name" => $section_name
    ]);

    echo "section added";
}


?>