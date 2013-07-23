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
				$('#navbar-Courses').css('background-color','rgba(38,65,108,1)');
				
				$("#tabs").tabs();
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
						<a href="appointments.php">Appointments
					</li>
					<li id="navbar-Courses">
						Courses
					</li>
					<li id="navbar-NewsFeed">
						<a href="newsfeed.php">News Feed</a>
					</li>
				</ul>
			</div>
			<div id="tabs">
				<ul class="tabs">
					<li><a href="#tab-previousfeedback"><span>Previous Feedback</span></a></li>
					<li><a href="#tab-leavefeedback"><span>Leave Feedback</span></a></li>
					<li><a href="#tab-forms"><span>Complete Forms</span></a></li>
				</ul>
			 	<div id="tab-previousfeedback">
					<h3>[Student's Name]'s Previous Feedback for [course name]</h3>
					<div id="previous-feedback-list">
						feedback
					</div>
			  	</div>
			  	<div id="tab-leavefeedback">
					<h3>Leave [Student's Name] feedback for [course name]</h3>
					<div id="feedback-form">
					</div>
			  	</div>
			  	<div id="tab-forms">
			  		<h3>Complete printable forms for [Student's Name] for [course name]</h3>
					<div id="pdfs">
					</div>
			  	</div>
			</div>
		</div>​
	</body>
</html>

