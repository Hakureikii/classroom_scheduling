<?php
include_once("../../connection.php");

$stmt = $conn->prepare("SELECT 
   sch.*,
   rm.room_name,
   CASE 
      WHEN TIME(NOW()) BETWEEN sch.time_start AND sch.time_end THEN 'occupied'
      ELSE 'inactive'
   END AS status
FROM schedules AS sch
INNER JOIN rooms as rm ON sch.room_id = rm.room_id
WHERE DAYNAME(NOW()) = sch.day");
$stmt->execute();
$rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($rooms);
?>
