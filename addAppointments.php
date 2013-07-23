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
				$('#navbar-Appointments').css('background-color','rgba(38,65,108,1)');
				$('#subnav-addAppointments').css('background-color','rgba(38,65,108,1)');
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
					<li id="navbar-Courses">
						<a href="courses.php">Courses</a>
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
					<div class="subform">
						<fieldset>					
							<p><legend>Meeting Date</legend></p>
							<label for="month">Month: </label>
							<select name="month" id="month">
								<option value="jan">Jan</option>
								<option value="feb">Feb</option>
								<option value="mar">Mar</option>
								<option value="apr">Apr</option>
								<option value="may">May</option>
								<option value="jun">Jun</option>
								<option value="jul">Jul</option>
								<option value="aug">Aug</option>
								<option value="sep">Sep</option>
								<option value="oct">Oct</option>
								<option value="nov">Nov</option>
								<option value="dec">Dec</option>
							</select>

							<label for="day">Day: </label>
							<select name="day" id="day">
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
								<option value="13">13</option>
								<option value="14">14</option>
								<option value="15">15</option>
								<option value="16">16</option>
								<option value="17">17</option>
								<option value="18">18</option>
								<option value="19">19</option>
								<option value="20">20</option>
								<option value="21">21</option>
								<option value="22">22</option>
								<option value="23">23</option>
								<option value="24">24</option>
								<option value="25">25</option>
								<option value="26">26</option>
								<option value="27">27</option>
								<option value="28">28</option>
								<option value="29">29</option>
								<option value="30">30</option>
								<option value="31">31</option>
							</select>
							<label for="year">Year: </label>
							<select name="year" id="year">
								<option value="2013">13</option>
								<option value="2014">14</option>
								<option value="2015">15</option>
								<option value="2016">16</option>
								<option value="2017">17</option>
							</select>
						</fieldset>
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
