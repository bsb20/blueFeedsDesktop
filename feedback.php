<?php
	session_start();
	date_default_timezone_set("America/New_York");
	$table="`test`.`students`";
	$table2="`test`.`appointments`";
	$db=new mysqli("127.0.0.1","root","devils","test",8889);
	if($db->connect_errno){
		echo "FAILURE";
	}
	$UUID=$_SESSION["UUID"];
	$final="";
	$sql = "SELECT * FROM $table,$table2 WHERE $table.`SUID`=$table2.`SUID` AND $table2.`UUID`='$UUID' ORDER BY `start`;";
	$result=$db->query($sql);
	$table = "";
	
	$numAppt = 0;
	$apptToday = 0;
	/* Time Filtering */
	for($i=0; $i<mysqli_num_rows($result); $i++){
		if($row=mysqli_fetch_array($result)){
				$name=$row["user"];
				$photo=$row["photo"];
				$title=$row["title"];
				$spec=$row["speciality"];
				$past=strtotime($row['start'])>time() || $row['isWeekly'] ? "a" : "d";
				$pastMessage= strtotime($row['start'])>time() || $row['isWeekly'] ? "":"Past Meeting Time";
				$duration=$row['duration'];
				$start=strtotime($row['start']);
				$formattedStart=date("g:i A",$start);
				$end=date("g:i A", strtotime($row['end']));
				$weekly= $row['isWeekly'] ? "Weekly: ".date("l",$start) : date("l, M j", $start);
				$title=$row['title'];
				$loc=$row['location'];
				$AUID=$row["AUID"];
				
				$today=getDate();
				$testday = $today['mday'];
				$day=intval(date("j",$start));
				$month=intval(date("n",$start));
				$year=intval(date("Y",$start));	

				if(empty($_GET))
				{
					$timeframe="thisweek";
				}
				else
				{
					$timeframe=$_GET["filter"];
				}
				
				if($today['mday']==$day and $today['mon']==$month and $today['year']==$year)
				{
					$apptToday++;
				}
				
				switch ($timeframe)
				{
					case "today":
						if($today['mday']==$day and $today['mon']==$month and $today['year']==$year)
						{
							$table.="<div class='appointments-appointment'>
						<p>
						<strong>$title</strong>
						</p>
						<p>
						<em>with $name</em>
						</p>
						<p>
						Date: $??
						</p>
						<p>
						Time: $formattedStart - $end
						</p>
						<p>
						Location: $loc
						</p>
					</div>
					";		
							$numAppt++;
						}		
						break;
						
					case "thisweek":
						$beginweek = $today['mday'] - $today['mday']%7;
						$endweek = $today['mday']+7 - ($today['mday']+7)%7;						
						if($beginweek <= $day and $day <= $endweek and $today['mon']==$month and $today['year']==$year)
						{
							$table.="							<div class='appointments-appointment'>
						<p>
						<strong>$title</strong>
						</p>
						<p>
						<em>with $name</em>
						</p>
						<p>
						Date: $??
						</p>
						<p>
						Time: $formattedStart - $end
						</p>
						<p>
						Location: $loc
						</p>
					</div>";				
							$numAppt++;
						}				
						break;

					case "month":
						if($today['mon']==$month and $today['year']==$year)
						{
							$table.="							<div class='appointments-appointment'>
						<p>
						<strong>$title</strong>
						</p>
						<p>
						<em>with $name</em>
						</p>
						<p>
						Date: $??
						</p>
						<p>
						Time: $formattedStart - $end
						</p>
						<p>
						Location: $loc
						</p>
					</div>";	
							$numAppt++;
						}				
						break;
						
					case "all":
						if($today['year']==$year)
						{
							$table.="						<div class='appointments-appointment'>
						<p>
						<strong>$title</strong>
						</p>
						<p>
						<em>with $name</em>
						</p>
						<p>
						Date: $??
						</p>
						<p>
						Time: $formattedStart - $end
						</p>
						<p>
						Location: $loc
						</p>
					</div>";				
							$numAppt++;
						}				
						break;						
				}
		}
	}
	switch($timeframe)
	{
		case "today":
			$_SESSION['message'] = "Here are your appointments for today:";	
			break;
		case "thisweek":
			$_SESSION['message'] = "Here are your appointments for this week:";
			break;
		case "month":
			$_SESSION['message'] = "Here are your appointments for this month:";
			break;
		case "all":
			$_SESSION['message'] = "Here is your history of appointments:";
			break;
	}
	$_SESSION['apptToday'] = $apptToday;
	$_SESSION['numAppt'] = $numAppt;
	$_SESSION['appointments'] = $table;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>BlueFeeds</title>
		<link rel="stylesheet" type="text/css" href="css/reset.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
		<script>
			$(document).ready(function() {
				$('#navbar-Feedback').css('background-color','rgba(38,65,108,1)');
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
					<a class="courses-students-courselink" href="#">
						<div class="courses-students-course">
							<p class="courses-students-instructors">
							<em>Instructor1, Instructor2</em>
							</p>
							<h3>Course Name</h3>
							<p>
							<em>Course description blah blah blah</em>
							</p>
							<p class="courses-students-students">
							<h3>Students</h3>
							Ben Berg, Niko Kesten
							</p>
						</div>
					</a>
					<a class="courses-students-courselink" href="#">
						<div class="courses-students-course">
							<p class="courses-students-instructors">
							<em>Instructor1, Instructor2</em>
							</p>
							<h3>Course Name</h3>
							<p>
							<em>Course description blah blah blah</em>
							</p>
							<p class="courses-students-students">
							<h3>Students</h3>
							Ben Berg, Niko Kesten
							</p>
						</div>
					</a>
				</div>
				<div id="courses-instructors">
					<p>
						Click on a student's name to view his/her previous feedback or to give them feedback in that course
					</p>
					<div class="courses-instructors-course">
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
								<input class="courses-add-input" type="text" name="students" placeholder="Type students you would like to add here, separated by commas"> <button type="submit" class="lightblue-button courses-addStuInsButton" value=""><img src="images/search.png"></button>
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
						<div class="courses-instructors-addInstructors">
							<form>
								<input class="courses-add-input" type="text" width="300" name="students" placeholder="Type instructors you would like to add here, separated by commas"> <button type="submit" class="lightblue-button courses-addStuInsButton" value=""><img src="images/search.png"></button>
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
					</div>
					<div class="add-button">
						<a href="addCourse.php"><button type="button" class="darkblue-button" value="">Add a New Course</button></a>
					</div>
				</div>
			</div>		
		</div>​
	</body>
</html>

