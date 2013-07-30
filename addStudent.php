<?php
/*
Authors: Benjamin Berg, Rachel Harris, Conrad Haynes, Jack Zhang
This php script is by the main page of the blueFeeds application login page to add a user student profile to out database. 
Student profiles are created with a new student id and group id. 
*/
include("initialize.php");
$GUID=$_POST["guid"];
$SUID=$_POST["suid"];
$table="`test`.`gs`";
$sql="INSERT INTO $table (`SUID`,`GUID`) VALUES ('$SUID','$GUID');";
$db->real_query($sql);
echo "Student Was Enrolled";
?>
