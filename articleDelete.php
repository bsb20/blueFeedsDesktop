<?php
include('initialize.php');
$FUID=$_POST["FUID"];
$sqlF="DELETE FROM `test`.`feeds` WHERE `FUID`='$FUID' LIMIT 1;";
$db->query($sqlF);
header("Location: newsfeed.php");
exit;
?>
