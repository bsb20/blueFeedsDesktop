<?php
	include("initialize.php");
	$UUID=$_SESSION["UUID"];
	$isStudent=$_SESSION["isStudent"];
	$final="";
	if($isStudent){
	$SUID=$_SESSION["SUID"];
	$sql="SELECT * FROM `test`.`gs`, `test`.`courses` WHERE `test`.`gs`.`SUID`='$SUID' AND `test`.`courses`.`GUID`=`test`.`gs`.`GUID`;";
	$UUID="-";
	}
	else{
	$sql = "SELECT * FROM `test`.`courses`, `test`.`groups` WHERE `test`.`groups`.`UUID`='$UUID' AND `test`.`courses`.`GUID`=`test`.`groups`.`GUID`";
	}
	$result=$db->query($sql);
$finally="";
for($i=0; $i<mysqli_num_rows($result); $i++){
if($row=mysqli_fetch_array($result)){
    $info=$row["info"];
    $title=$row["title"];
    $GUID=$row["GUID"];
}

	$sql2="SELECT * FROM `test`.`groups`, `test`.`users` WHERE `test`.`groups`.`UUID`=`test`.`users`.`UUID` AND `test`.`groups`.`GUID`='$GUID' AND `test`.`groups`.`UUID`!='$UUID';";
	$result2=$db->query($sql2);
	$instruct="";
	for($j=0; $j<mysqli_num_rows($result2); $j++){
		if($row2=mysqli_fetch_array($result2)){
			$email="";
			if ($row2["email"]){
				$email=" (".$row2["email"].")";
			}
			$instruct.=$row2["user"]."$email, ";
		}
	}
	$sql3="SELECT * FROM `test`.`gs`, `test`.`students` WHERE `test`.`gs`.`SUID`=`test`.`students`.`SUID` AND `test`.`gs`.`GUID`='$GUID';";
	$result3=$db->query($sql3);
	$student="";
	$duplicates=array();
	for($j=0; $j<mysqli_num_rows($result3); $j++){
		if($row2=mysqli_fetch_array($result3)){
			if(!in_array($row2["user"],$duplicates)){
				if($isStudent){
					$student.=$row2["user"];
				}else{
					$student.="<a class='courses-instructors-studentlink' href=feedback-instructors.php?course=$GUID&id=".$row2["SUID"].">".$row2["user"]."</a>, ";
				}
			array_push($duplicates,$row2["user"]);
			}
		}
	}
$instruct=substr($instruct,0,strlen($instruct)-2);
if(!$isStudent){
	$student=substr($student,0,strlen($student)-2);
}
if(isset($_SESSION["isStudent"])){
 $finally.=                       "<a class='courses-students-courselink' href='feedback-students.php?course=$GUID'>
						<div class='courses-students-course'>
							<p class='courses-students-instructors'>
							<em>$instruct</em>
							</p>
							<h3>$title</h3>
							<p>
							<em>$info</em>
							</p>
							<p class='courses-students-students'>
							<h3>Students</h3>
							$student
							</p>
						</div>
					</a>";}
else{
	$finally.="
					<div class='courses-instructors-course' id='$GUID'>
						<p class='courses-instructors-instructors'>
						<em>$instruct</em>
						</p>
						<h3>$title</h3>
						<p>
						<em>$info</em>
						</p>
						<p class='courses-instructors-students'>
						<h3>Students</h3>
						$student
						</p>
						<div class='search'>
						<p class='searchHead'>Add Students and Instructors</p>
						<div>
							<div class='courses-instructors-addStudents'>
								<form>
									<input class='courses-add-input studentAdd' id='me' type='text' name='students' placeholder='Start typing an student&apos;s name, then click it to add them'>
								</form>
							</div>
							<ul class='results'>
							
							</ul>
							<div class='courses-instructors-addInstructors'>
								<form>
									<input class='courses-add-input instructorAdd' type='text' width='300' name='students' placeholder='Start typing an instructor&apos;s name, then click it to add them'>
								</form>
							</div>
							<ul class='iresults'>
							
							</ul>
							</div>
						</div>
					</div>
				";
}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>BlueFeeds</title>
		<link rel="stylesheet" type="text/css" href="css/reset.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
		<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		<script src="./desktopScript.js"></script>
		<script>
			$(document).ready(function() {
				$('#navbar-Feedback').css('background-color','rgba(38,65,108,1)');
				$(".search").accordion({ header: ".searchHead", collapsible: true, active: false, heightStyle: "content" });
			});
		</script>
	</head>
	<body>
		<div id="title-bar">
			<h1>BlueFeeds</h1>
		</div>
		<div id="page-title">
			<h2>Feedback</h2>
		</div>
		<div id="container">
			<div id="navbar">
				<ul>
					<li id="navbar-Home">
						<a href="home.php">Home</a>
					</li>
					<li id="navbar-Appointments">
						<a href="appointments.php">Appointments</a>
					</li>
					<li id="navbar-Feedback">
						Feedback
					</li>
					<?php if(!$isStudent){echo '<li id="navbar-NewsFeed">
						<a href="newsfeed.php">News Feed</a>
					</li>';}?>
				</ul>
			</div>
			<div id="courses-container">
				<div id="courses-students">
					<p>
						Click on one of your courses below to view your feedback
					</p>
				</div>
				<div id="courses-instructors">
					<p>
						Click on a student's name to view his/her previous feedback or to give them feedback in that course
					</p>
					<?php
					echo $finally;
					?>
					<!--<div class="add-button">
						<a href="addCourse.php"><button type="button" class="darkblue-button" value="">Add a New Course</button></a>
					</div>-->
				</div>
			</div>		
		</div>​
	<?php include('footer.php'); ?>

