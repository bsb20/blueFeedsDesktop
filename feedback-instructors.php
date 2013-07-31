<!DOCTYPE html>
<?php
include('initialize.php');
$SUID=$_GET['id'];
$UUID=$_SESSION["UUID"];
$GUID=$_GET["course"];
$sql="SELECT * FROM `test`.`students` WHERE `SUID`='$SUID'";
$result=$db->query($sql);
if($row = mysqli_fetch_array($result)){
	$name=$row["user"];
}
$sql="SELECT * FROM `test`.`courses` WHERE `GUID`='$GUID'";
$result=$db->query($sql);
if($row = mysqli_fetch_array($result)){
	$course=$row["title"];
}
$sql = "SELECT `test`.`comments`.`title`, `test`.`comments`.`text`, `test`.`users`.`user` FROM `test`.`comments`, `test`.`users` WHERE `test`.`comments`.`SUID`='$SUID' AND `test`.`comments`.`GUID`='$GUID' AND `test`.`users`.`UUID`=`test`.`comments`.`UUID` AND (`test`.`comments`.`UUID`='$UUID' OR `test`.`comments`.`instructors`='1') ORDER BY `test`.`comments`.`date` DESC";
$result=$db->query($sql);
$comments="";
for($i=0; $i<mysqli_num_rows($result); $i++){
	if($row = mysqli_fetch_array($result)){
		$title=$row["title"];
		$comment=$row["text"];
		$author=$row["user"];
		$comments.= "			<li>
							<p class='title'>$title</p>
							<p class='comment'>$comment</p>
							<p class='author'>- $author</p>
						</li>";
	}
}
?>

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
				$('#navbar-Feedback').css('background-color','rgba(38,65,108,1)');
				
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
					<li id="navbar-Feedback">
						Feedback
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
					<h3><?php echo "$name"?>'s Previous Feedback for <?php echo $course ?></h3>
					<ul id="previous-feedback-list">
						<?php echo $comments ?>
					</ul>
			  	</div>
			  	<div id="tab-leavefeedback">
					<h3>Leave <?php echo "$name"?> feedback for <?php echo $course ?></h3>
					<div id="feedback-form">
						<form>			
							<p>
								<label>Title: </label>
								<input class="feedback-input" type="text" name="title" placeholder="Needs improvement on a certain topic"/>
							</p>
							<p>
								<textarea class="feedback-textarea" placeholder="Type your comment here"></textarea>
							</p>
							<div class="add-button">
								<button type="button" class="darkblue-button" value="">Leave feedback</button>
							</div>
						</form>
					</div>
			  	</div>
			  	<div id="tab-forms">
			  		<h3>Complete printable forms for <?php echo "$name"?> for <?php echo $course ?></h3>
					<div id="pdfs">
					</div>
			  	</div>
			</div>
		</div>​
	</body>
</html>

