<!DOCTYPE html>
<?php
include('initialize.php');
//$SUID=$_GET['id'];
$SUID=$_SESSION["SUID"];
$TUID=$_POST["filter"];
$UUID=$_POST["UUID"];
$_SESSION["tempUUID"]=$UUID;
$_SESSION["tempGUID"]=$_GET["course"];
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
}/*
if(!isset($_GET["filter"])){
$sql = "SELECT `test`.`comments`.`title`, `test`.`comments`.`text`, `test`.`users`.`user` FROM `test`.`comments`, `test`.`users` WHERE `test`.`comments`.`SUID`='$SUID' AND `test`.`comments`.`GUID`='$GUID' AND `test`.`users`.`UUID`=`test`.`comments`.`UUID` AND (`test`.`comments`.`UUID`='$UUID' OR `test`.`comments`.`instructors`='1') ORDER BY `test`.`comments`.`date` DESC";
}
else{
$sql = "SELECT * FROM `test`.`tu` INNER JOIN `test`.`comments` ON `test`.`tu`.`CUID` = `test`.`comments`.`CUID` WHERE `test`.`comments`.`SUID` ='".$SUID."' AND `test`.`tu`.`TUID` ='".$TUID."' AND `comments`.`GUID`='$GUID';";
}
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
$tags="";
$sql = "SELECT * FROM `test`.`tags` WHERE `UUID`='$UUID'";
$result=$db->query($sql);
for($i=0; $i<mysqli_num_rows($result); $i++){
	if($row = mysqli_fetch_array($result)){
		$tag=$row["TUID"];
		$text=$row["text"];
		$tags.=	"<a href='./feedback-instructors.php?course=$GUID&id=$SUID&filter=$tag'>																															
				<button class='white-button filter-button'>
					<span class='label' style='text-align: center;'>$text</span>
				</button>
			</a>";
	}
}*/
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
						<a href="feedback-students.php">&larr; Back to Feedback List</a>
					</li>
				</ul>
			</div>
			  	<div id="tab-leavefeedback">
					<h3>Leave <?php echo "$name"?> feedback for <?php echo $course ?></h3>
					<div id="feedback-form">
						<form action="commentSubmitStudent.php" method="post">			
							<p>
								<label>Title: </label>
								<input class="feedback-input" type="text" name="title" placeholder="Student Response"/>
							</p>
							<p>
								<textarea class="feedback-textarea" name="comment" placeholder="Type your reply  here"></textarea>
							</p>
							<input style="display: none" type="text" name="GUID" value="<?php echo $GUID ?>"/>
							<input style="display: none" type="text" name="SUID" value="<?php echo $SUID ?>"/>
							<input style="display: none" type="text" name="UUID" value="<?php echo $UUID ?>"/>
							<div class="add-button">
								<label>Released to Co-Instructors? <input type="checkbox" name="instructors" value="1" checked/></label>
							</div>
							<div class="add-button">
								<button type="submit" class="darkblue-button" value="">Leave Reply</button>
							</div>
						</form>
					</div>
			  	</div>
		</div>​
	<?php include('footer.php'); ?>

