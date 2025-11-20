<?php
session_start();
include_once "../../connection.php";
date_default_timezone_set('Asia/Singapore');
$current_date = date("Y-m-d");
$current_time = date("H:i:s");

$retrieve = $conn->prepare("SELECT session_id FROM sessions WHERE date_issued < :current_date AND archived = 0");
$retrieve->execute([
    ":current_date" => $current_date
]);
$row = $retrieve->rowCount();
$session_id = $retrieve->fetchAll(PDO::FETCH_COLUMN);

if ($row > 0) {
    foreach ($session_id as $sessions) {
        $record = $conn -> prepare("INSERT INTO session_history(session_id) VALUES(:sessions)");
        $record -> execute([
            ":sessions" => $sessions
        ]);

        $archive = $conn->prepare("UPDATE sessions SET archived = 1 WHERE session_id =:sessions");
        $archive->execute([
            ":sessions" => $sessions
        ]);
    }
    
} else {
    exit;
}

?>