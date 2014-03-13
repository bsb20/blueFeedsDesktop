<!DOCTYPE html>
<?php
include('initialize.php');
$SUID=$_GET['id'];
//$TUID=$_POST["filter"];
//$UUID=$_POST["UUID"];
$GUID=$_GET["course"];
$title=$_POST["title"];
$comment=$_POST["comment"];
$students=$_POST["students"];
$instructors=$_POST["instructors"];
$CUID=$_POST["CUID"];
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
$sql="SELECT * FROM `test`.`comments` WHERE `CUID`='$CUID'";
$result=$db->query($sql);
if($row = mysqli_fetch_array($result)){
	$students=$row["students"];
	$instructors=$row["instructors"];
	$comment=$row["text"];
}
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>BlueFeeds</title>
		<link rel="stylesheet" type="text/css" href="css/reset.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		<script>
			$(document).ready(function() {
				$('#navbar-Feedback').css('background-color','rgba(38,65,108,1)');
				$("#tabs").tabs();
				$( "#datepicker" ).datepicker();
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
						<a href="feedback.php">Feedback</a>
					</li>
					<li id="navbar-NewsFeed">
						<a href="newsfeed.php">News Feed</a>
					</li>
				</ul>
			</div>
			<div id="subnav">
				<ul>
					<li id="subnav-NewsFeed">
						<a href="feedback-instructors.php?course=<?php echo $GUID;?>&id=<?php echo $SUID;?>">&larr; Back to Feedback List</a>
					</li>
				</ul>
			</div>
			  	<div id="tab-leavefeedback">
					<h3>Leave <?php echo "$name"?> feedback for <?php echo $course ?></h3>
					<div id="feedback-form">
						<form action="commentEditSubmit.php" method="post">			
							<p>
								<label>Title: </label>
								<input class="feedback-input" type="text" name="title" value="<?php echo $title ?>"/>
							</p>
							<p>
								<textarea class="feedback-textarea" name="comment" ><?php echo $comment ?></textarea>
							</p>
							<input type='text' class='hiddenForm' name='CUID' value="<?php echo $CUID ?>" style='display: none;'>
							<input type='text' class='hiddenForm' name='GUID' value="<?php echo $GUID ?>" style='display: none;'>
							<input type='text' class='hiddenForm' name='SUID' value="<?php echo $SUID ?>" style='display: none;'>
							<div class="add-button">
								<label>Released to Student? <input type="checkbox" name="students" value="1" checked /></label>
							</div>
							<div class="add-button">
								<label>Released to Co-Instructors? <input type="checkbox" name="instructors" value="1" checked /></label>
							</div>
							<div class="add-button">
								<button type="submit" class="lightblue-button" value="">Leave Reply</button>
							</div>
						</form>
						<div>
						<form action="commentDelete.php" method="post">
							<input type='text' class='hiddenForm' name='CUID' value="<?php echo $CUID ?>" style='display: none;'>
							<input type='text' class='hiddenForm' name='GUID' value="<?php echo $GUID ?>" style='display: none;'>
							<input type='text' class='hiddenForm' name='SUID' value="<?php echo $SUID ?>" style='display: none;'>
							<button type="submit" class="lightblue-button" id="delete-button" value="">Delete Note</button>
						</form>
						</div>
					</div>
			  	</div>
		</div>​
	<?php include('footer.php'); ?>

