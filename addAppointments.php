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
		<script src="js/jquery-ui-1.10.3.custom.min.js"></script>
		<script>
			$(document).ready(function() {
				$('#navbar-Appointments').css('background-color','rgba(38,65,108,1)');
				$('#subnav-addAppointments').css('background-color','rgba(38,65,108,1)');
    			$( "#datepicker" ).datepicker();
			});
		</script>
	</head>
	<body>
		<div id="title-bar">
			<h1>BlueFeeds</h1>
		</div>
		<div id="page-title">
			<h2>Add Appointment</h2>
		</div>
		<div id="container">
			<div id="navbar">
				<ul>
					<li id="navbar-Home">
						<a href="home.php">Home</a>
					</li>
					<li id="navbar-Appointments">
						Appointments
					</li>
					<li id="navbar-Feedback">
						<a href="feedback.php">Feedback</a>
					</li>
					<li id="navbar-NewsFeed">
						<a href="newsfeed.php">News Feed</a>
					</li>
				</ul>
			</div>
			<div id="subnav">
				<ul>
					<li id="subnav-Appointments">
						<a href="appointments.php">View Appointments</a>
					</li>
					<li id="subnav-addAppointments">
						Add Appointments
					</li>
				</ul>
			</div>
			<div id="add-appointments-container">
				<h3 class="centered">Appointment Information</h3>
				<form id="add-appointments-form" action="apptSubmit.php" method="post">
					<div class="input-fields">
						<label for="title">Title: </label>					
						<input type="text" name="title" placeholder="(i.e. Coffee with Joe)"/>
					</div>
					<div class="input-fields">
						<label for="studentname">Student: </label>					
						<input type="text" name="studentname" placeholder="John Smith"/>
					</div>					
					<div class="input-fields">
						<label for="location">Location: </label>					
						<input type="text" name="location" placeholder="(i.e. Office)"/>
					</div>
					<div class="input-fields">			
						<label for="date">Date: </label>
						<input type="text" id="datepicker" />
					</div>
					<div class="subform">
						<fieldset>
							<legend>Start and End Times</legend>
								From
								<select name="sHour" id="sHour">
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
									<option value="10">10</option>
									<option value="11">11</option>
									<option value="12">12</option>
								</select>
								<select name="sMin" id="sMin">
									<option value="00">00</option>
									<option value="15">15</option>
									<option value="30">30</option>
									<option value="45">45</option>
								</select>

								<select name="sampm" id="sampm">
									<option value="pm">pm</option>
									<option value="am">am</option>
								</select>
								</br>
								until
								<select name="eHour" id="eHour">
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
									<option value="10">10</option>
									<option value="11">11</option>
									<option value="12">12</option>
								</select>
								<select name="eMin" id="eMin">
									<option value="00">00</option>
									<option value="15">15</option>
									<option value="30">30</option>
									<option value="45">45</option>
								</select>
								<select name="eampm" id="eampm">
									<option value="pm">pm</option>
									<option value="am">am</option>
								</select>							
						</fieldset>
					</div>
					<div class="subform">
						<label for="flip-1">Weekly Meeting? </label>
						<select name="flip-1" id="flip-1">
							<option value="off">Off</option>
							<option value="on">On</option>
						</select>
					</div>
					<div style="padding-top: 3%" class="add-button">								
						<label for="submitAppt"></label>
						<input type="submit" name="submitAppt" value="Add Appointment" class="darkblue-button">	
					</div>
				</form>				
			</div>
        </div>
		<?php
			include 'menu.php';
		?>
    </div>​
</body>
</html>

