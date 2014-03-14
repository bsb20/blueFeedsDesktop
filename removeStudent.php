<?php
include("initialize.php");
$GUID=$_POST["GUID"];
$SUID=$_POST["SUID"];
$sql="DELETE FROM `gs` WHERE `SUID`='$SUID' AND `GUID`='$GUID' LIMIT 1;";
$db->query($sql);
echo $sql;
header("Location: feedback.php");
exit;
?>
