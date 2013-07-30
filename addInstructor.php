<?php

/*
Authors: Benjamin Berg, Rachel Harris, Conrad Haynes, Jack Zhang
This php script is by the main page of the blueFeeds application login page to add a user instructor profile to out database. 
User profiles are created with a new user id and group id. 
*/
include("initialize.php");
$table="`test`.`users`";
$GUID=$_POST["guid"];
$UUID=$_POST["uuid"];
$table="`test`.`groups`";
$sql="INSERT INTO $table (`UUID`,`GUID`) VALUES ('$UUID','$GUID');";
$db->real_query($sql);
echo "Instructor Added";
?>
