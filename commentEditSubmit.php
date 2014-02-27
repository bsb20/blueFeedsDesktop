<?php
include("initialize.php");
$table="`test`.`comments`";
$text=$_POST["comment"];
$title=$_POST["title"];
$instructors=$_POST["instructors"];
$students=$_POST["students"];
$CUID=$_POST["CUID"];
$GUID=$_POST["GUID"];
$student=$_POST["SUID"];
$db->real_query("UPDATE ".$table." SET `title`='$title', `text`='$text', `students`='$students', `instructors`='$instructors' WHERE `CUID`='$CUID';");
header("Location: feedback-instructors.php?course=$GUID&id=$student");
exit;
?>
