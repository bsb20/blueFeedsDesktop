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
    $date=$row["date"];
    $students=$row["students"];
    $instructors=$row["instructors"];
    $time=strtotime($date);
    $formattedDate=date("m/d/y",$time);
    }
            $finally.=                       "<li data-theme='d' class='listNote dynamicComment' data-dynamicContent='commentRetrieve' onClick='echoComment()' style='margin: 1%; overflow: visible; white-space: normal;'>
						<h1>$title</h1>
						<p class='note'>$text</p>
                                                <p class='ui-li-aside'><strong>$formattedDate</strong></p>
                                                    <input type='text' name='CUID' value='$CUID' class='hiddenForm' style='display: none;'>
                                                    <input type='text' name='students' value='$students' id='hiddenForm2' style='display: none;'>
                                                    <input type='text' name='instructors' value='$instructors' id='hiddenForm3' style='display: none;'>
					</li>";}
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
						Your feedback for [course name]
					</h3>
					<ul id="previous-feedback-list">
						<?php echo $finally ?>
					</ul>
				</div>
			</div>		
		</div>​
	</body>
</html>

