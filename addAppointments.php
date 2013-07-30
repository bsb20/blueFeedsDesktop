<?php
include("initialize.php");
$table="`test`.`appointments`";
$user=$_SESSION["UUID"];
$student=$_SESSION["SUID"];
$day=$_POST['day'];
$month=$_POST['month'];
$year=$_POST['year'];
$sHour=$_POST["sHour"];
$sMin=$_POST["sMin"];
$sampm=$_POST["sampm"];
$eHour=$_POST["eHour"];
$eMin=$_POST["eMin"];
$eampm=$_POST["eampm"];
$sDate="$day $month $year $sHour:$sMin:00 $sampm";
$eDate="$day $month $year $eHour:$eMin $eampm";
$sDateTime=date("Y-m-d H:i:s",strtotime($sDate));
$eDateTime=date("Y-m-d H:i:s",strtotime($eDate));
$location=$_POST["location"];
$title=$_POST["title"];
$AUID=uniqid("",FALSE);
$_SESSION['AUID']=$AUID;
$db->real_query("INSERT INTO ".$table." (`UUID`, `SUID`, `start`, `end`, `title`, `location`, `AUID`) VALUES ('$user', '$student', '$sDateTime', '$eDateTime', '$title', '$location', '$AUID');");
?>
