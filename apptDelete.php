<?php
include('initialize.php');
$AUID=$_POST["AUID"];
$sqlA="DELETE FROM `test`.`appointments` WHERE `AUID`='$AUID' LIMIT 1;";
$db->query($sqlA);
header("Location: appointments.php");
exit;
?>
