<?php
include('initialize.php');
$CUID=$_POST["CUID"];
$GUID=$_POST["GUID"];
$SUID=$_POST["SUID"];
$sqlD="DELETE FROM `test`.`comments` WHERE `CUID`='$CUID' LIMIT 1;";
$db->query($sqlD);
header("Location: feedback-instructors.php?course=$GUID&id=$SUID");
exit;
?>
