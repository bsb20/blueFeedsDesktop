<?php
	session_start();
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
				
			});
		</script>
	</head>
	<body>
		<div id="title-bar">
			<h1>BlueFeeds</h1>
		</div>
		<div id="page-title">
			<h2>Add a New Course</h2>
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
						<a href="feedback.php">Feedback</a>
					</li>
					<li id="navbar-NewsFeed">
						<a href="newsfeed.php">News Feed</a>
					</li>
				</ul>
			</div>
			<div id="courses-container">
        		<div id="courses-instructors">
					<h3>Course Information</h3>
					<div class="courses-instructors-course clearfix">
						<form>
							<div class="addCourse-courseInfo">
								<div class="input-fields">
									<p class="form">Course Name: <input type="text" name="courseName"></p>
									<p class="form">Description: <input type="text" name="courseDesc"></p>
								</div>
							</div>
							<div class="courses-instructors-addStudents">
								<h3 class="addCourse-subhead">Students</h3>
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
								<h3 class="addCourse-subhead">Instructors</h3>
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
					</form>
				</div>
        	</div>
    	</div>​
	</body>
</html>

