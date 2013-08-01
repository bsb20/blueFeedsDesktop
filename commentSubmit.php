<?php

/*
Authors: Benjamin Berg, Rachel Harris, Conrad Haynes, Jack Zhang
This php script submits comments for a given user (UUID) and student (SUID) to our online database for retrieval later.
As parameters it taked the comments text, comments tags, and the student and user information.
*/


include("initialize.php");
$table="`test`.`comments`";
$tag_table="`test`.`tu`";
$text=$_POST["comment"];
$title=$_POST["title"];
$instructors=$_POST["instructors"];
$students=$_POST["students"];
$user=$_SESSION["UUID"];
$GUID=$_POST["GUID"];
$student=$_POST["SUID"];
$CUID=uniqid("",false);
$newTag=$_POST["new"];
$tags=$_POST["tag"];
if(!isset($tags)){
$tags=array();
}
if(strlen(trim($newTag)) !=0){
	$newTUID=uniqid("",FALSE);
	array_push($tags,$newTUID);
	$db->real_query("INSERT INTO `test`.`tags` (`text`, `TUID`, `UUID`) VALUES ('$newTag', '$newTUID', '$user');");
}
$date=date("Y-m-d H:i:s");
$db->real_query("INSERT INTO ".$table." (`UUID`, `SUID`, `date`, `text`, `CUID`, `title`, `instructors`, `students`, `GUID`) VALUES ('$user', '$student', '$date', '$text', '$CUID','$title', '$instructors','$students', '$GUID');");
foreach ($tags as $TUID){
	$db->real_query("INSERT INTO ".$tag_table." (`TUID`, `CUID`) VALUES ('$TUID', '$CUID');");
}
header("Location: feedback-instructors.php?course=$GUID&id=$student")
?>
