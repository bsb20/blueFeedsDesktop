<?php

/*
Authors: Brett Cadigan
This php script submits comments for a given user (UUID) and student (SUID) to our online database for retrieval later.
As parameters it taked the comments text, comments tags, and the student and user information.
*/

include("initialize.php");
include("testMail3.php");
$table="`test`.`comments`";
$tag_table="`test`.`tu`";
$text=$_POST["comment"];
$title=$_POST["title"];
$instructors=$_POST["instructors"];
$students=true;
$user=666;
//$_POST["tempUUID"];
//$GUID="5254bedc65ac9";
$GUID=htmlspecialchars($_GET["course"]);
//$GUID=$_POST["GUID"];
//$GUID=$_SESSION["tempGUID"];
$student=$_SESSION["SUID"];
$CUID=uniqid("",false);
//$_POST["CUID"];
$newTag=$_POST["new"];
$tags=$_POST["tag"];

$mailSql="SELECT `email` FROM `test`.`users` WHERE `UUID`='$user'";
$mailResult=$db->query($mailSql);
if($mailRow=mysqli_fetch_array($mailResult)){
	$mailAddress=$mailRow["email"];
}
$mailContent="Hello! Your have received a new student reply on BlueFeeds.

 ".$title."
".$text."

Please check your BlueFeeds account at http://www.dukebluefeeds.com/ for more details.";
mailer($mailAddress,$mailContent);

/*if(!isset($tags)){
$tags=array();
}
if(strlen(trim($newTag)) !=0){
	$newTUID=uniqid("",FALSE);
	array_push($tags,$newTUID);
	$db->real_query("INSERT INTO `test`.`tags` (`text`, `TUID`, `UUID`) VALUES ('$newTag', '$newTUID', '$user');");
}*/
$date=date("Y-m-d H:i:s");
$db->real_query("INSERT INTO ".$table." (`UUID`, `SUID`, `date`, `text`, `CUID`, `title`, `instructors`, `students`, `GUID`) VALUES ('$user', '$student', '$date', '$text', '$CUID','$title', '$instructors','$students', '$GUID');");
foreach ($tags as $TUID){
	$db->real_query("INSERT INTO ".$tag_table." (`TUID`, `CUID`) VALUES ('$TUID', '$CUID');");
}
echo "true";
?>
