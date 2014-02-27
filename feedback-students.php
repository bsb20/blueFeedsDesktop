<?php
	include('initialize.php');
	$SUID=$_SESSION["SUID"];
	$GUID=$_GET["course"];
	$sql=$sql="SELECT * FROM `test`.`comments` WHERE `SUID`='$SUID' AND `GUID`='$GUID' AND `students`='1' ORDER BY `date` DESC";
	$result=$db->query($sql);
$finally="";
for($i=0; $i<mysqli_num_rows($result); $i++){
if($row=mysqli_fetch_array($result)){
    $title=$row["title"];
    $text=$row["text"];
    $CUID=$row["CUID"];
    $UUID=$row["UUID"];
    $date=$row["date"];
    $students=$row["students"];
    $instructors=$row["instructors"];
    $time=strtotime($date);
    $formattedDate=date("m/d/y",$time);
    //$_SESSION["tempUUID"]=$row["UUID"];
    }
            $finally.=                       "<li data-theme='d' class='listNote dynamicComment' style='margin: 1%; overflow: visible; white-space: normal;'>
						<p class='title'>$title</p>
						<p class='comment'>$text</p>
						<p class='author'> - $instructor</p>
						<form action='feedback-students-reply2.php?course=$GUID&id=$SUID' method='POST'><input type='submit' class=lightblue-button value='Reply'>
                                                    <input type='text' name='CUID' value='$CUID' class='hiddenForm' style='display: none;'>
                                                    <input type='text' name='students' value='$students' id='hiddenForm2' style='display: none;'>
                                                    <input type='text' name='instructors' value='$instructors' id='hiddenForm3' style='display: none;'>
                                                    <input type='text' name='UUID' value='$UUID' id='hiddenForm4' style='display: none;'>
						</form>
					</li>";}
	$sql="SELECT * FROM `test`.`courses` WHERE `GUID`='$GUID'";
	$result=$db->query($sql);
	if($row=mysqli_fetch_array($result)){
		$name=$row["title"];
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
			<h2>Your Feedback</h2>
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
			<div id="feedback-container">
				<div id="feedback-students">
					<h3>
						Your feedback for <?php echo $name ?>
					</h3>
					<div id="feedback-students-filters">
						<p>Filter feedback by tag:</p>
						<a href="./feedback-students.php?filter=$tag">																															
							<button class="white-button filter-button">
								<span class="label" style="text-align: center;">$tag</span>
							</button>
						</a>
					</div>
					<ul id="previous-feedback-list">
						<?php echo $finally ?>
					</ul>
				</div>
			</div>		
		</div>
		<?php include('footer.php'); ?>

