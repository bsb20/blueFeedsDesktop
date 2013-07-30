<?php
	include("initialize.php");
	$UUID=$_SESSION["UUID"];
	$final="";
	$sql = "SELECT * FROM `test`.`courses`, `test`.`groups` WHERE `test`.`groups`.`UUID`='$UUID' AND `test`.`courses`.`GUID`=`test`.`groups`.`GUID`";
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
			$instruct.=$row2["user"].", ";
		}
	}
	$sql3="SELECT * FROM `test`.`gs`, `test`.`students` WHERE `test`.`gs`.`SUID`=`test`.`students`.`SUID` AND `test`.`gs`.`GUID`='$GUID';";
	$result3=$db->query($sql3);
	$student="";
	$duplicates=array();
	for($j=0; $j<mysqli_num_rows($result3); $j++){
		if($row2=mysqli_fetch_array($result3)){
			if(!in_array($row2["user"],$duplicates)){
			$student.="<a class='courses-instructors-studentlink' href=studentPage.php?id=".$row2["SUID"].">".$row2["user"]."</a>, ";
			array_push($duplicates,$row2["user"]);
			}
		}
	}
$instruct=substr($instruct,0,strlen($instruct)-2);
$student=substr($student,0,strlen($student)-2);
if(isset($_SESSION["isStudent"])){
 $finally.=                       "<a class='courses-students-courselink' href='coursePage.php?course=$GUID'>
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
	$finally.="<div id='courses-instructors'>
					<p>
						Click on a student's name to give them feedback in that course
					</p>
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
						<div class='courses-instructors-addStudents'>
							<form>
								<input class='courses-add-input studentAdd' id='me' type='text' name='students' placeholder='Type students you would like to add here, separated by commas'> <button type='submit' class='lightblue-button courses-addStuInsButton value=''>Add</button>
							</form>
						</div>
						<ul class='results'>
							
						</ul>
						<div class='courses-instructors-addInstructors'>
							<form>
								<input class='courses-add-input instructorAdd' type='text' width='300' name='students' placeholder='Type instructors you would like to add here, separated by commas'> <button type='submit' class='lightblue-button courses-addStuInsButton' value=''>Add</button>
							</form>
						</div>
						<ul class='iresults'>
							
						</ul>
					</div>
				</div>";
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
		<script src="./desktopScript.js"></script>
		<script>
			$(document).ready(function() {
				$('#navbar-Courses').css('background-color','rgba(38,65,108,1)');
			});
		</script>
	</head>
	<body>
		<div id="title-bar">
			<h1>BlueFeeds</h1>
		</div>
		<div id="page-title">
			<h2>Courses</h2>
		</div>
		<div id="container">
			<div id="navbar">
				<ul>
					<li id="navbar-Home">
						<a href="home.php">Home</a>
					</li>
					<li id="navbar-Appointments">
						<a href="appointments.php">Appointments
					</li>
					<li id="navbar-Feedback">
						Feedback
					</li>
					<li id="navbar-NewsFeed">
						<a href="newsfeed.php">News Feed</a>
					</li>
				</ul>
			</div>
			<div id="courses-container">
				<div id="courses-students">
					<p>
						Click on one of your courses below to view your feedback
					</p>
					<?php
					echo $finally;
					?>
				</div>
				<div id="courses-instructors">
					<p>
						Click on a student's name to view his/her previous feedback or to give them feedback in that course
					</p>
					<div class="courses-instructors-course" id="id">
						<p class="courses-instructors-instructors">
						<em>Instructor1, Instructor2</em>
						</p>
						<h3>Course Name</h3>
						<p>
						<em>Course description blah blah blah</em>
						</p>
						<p class="courses-instructors-students">
						<h3>Students</h3>
						<a class="courses-instructors-studentlink" href="#">Ben Berg</a>, <a class="courses-instructors-studentlink" href="#">Niko Kesten</a>
						</p>
						<div class="courses-instructors-addStudents">
							<form>
<input class="courses-add-input studentAdd" id="me" type="text" name="students" placeholder="Type students you would like to add here, separated by commas"> <button type="submit" class="lightblue-button courses-addStuInsButton" value="">Add</button>
							</form>
							<div class="courses-instructors-addStudents-results">
								<a class="result-link" href="#">
									<div class="result clearfix">
										<img class="result-icon" />
										<p class="result-name">Ben Berg</p>
									</div>
								</a>
								<a class="result-link" href="#">
									<div class="result clearfix">
										<img class="result-icon" />
										<p class="result-name">Niko Kesten</p>
									</div>
								</a>
							</div>
						</div>
						<ul id="results">
							
						</ul>
						<div class="courses-instructors-addInstructors">
							<form>
								<input class="courses-add-input instructorAdd" type="text" width="300" name="students" placeholder="Type instructors you would like to add here, separated by commas"> <button type="submit" class="lightblue-button courses-addStuInsButton" value="">Add</button>
							</form>
							<div class="courses-instructors-addInstructors-results">
								<a class="result-link" href="#">
									<div class="result clearfix">
										<img class="result-icon" />
										<p class="result-name">The Professor</p>
									</div>
								</a>
							</div>
						</div>
						<ul id="iresults">
							
						</ul>
					</div>
					<div class="add-button">
						<a href="addCourse.php"><button type="button" class="darkblue-button" value="">Add a New Course</button></a>
					</div>
				</div>
			</div>		
		</div>​
	</body>
</html>

