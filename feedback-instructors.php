<!DOCTYPE html>
<?php
include('initialize.php');
$SUID=$_GET['id'];
$TUID=$_GET["filter"];
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
if(!isset($_GET["filter"])){
$sql = "SELECT `test`.`comments`.`title`, `test`.`comments`.`text`, `test`.`comments`.`CUID`, `test`.`users`.`user` FROM `test`.`comments`, `test`.`users` WHERE `test`.`comments`.`SUID`='$SUID' AND `test`.`comments`.`GUID`='$GUID' AND `test`.`users`.`UUID`=`test`.`comments`.`UUID` AND (`test`.`comments`.`UUID`='$UUID' OR `test`.`comments`.`instructors`='1') ORDER BY `test`.`comments`.`date` DESC";
}
else{
$sql = "SELECT * FROM `test`.`tu` INNER JOIN `test`.`comments` ON `test`.`tu`.`CUID` = `test`.`comments`.`CUID` WHERE `test`.`comments`.`SUID` ='".$SUID."' AND `test`.`tu`.`TUID` ='".$TUID."' AND `comments`.`GUID`='$GUID' ORDER BY `test`.`comments`.`date` DESC";
}
$result=$db->query($sql);
$comments="";
for($i=0; $i<mysqli_num_rows($result); $i++){
	if($row = mysqli_fetch_array($result)){
		$title=$row["title"];
		$comment=$row["text"];
		$author=$row["user"];
		$CUID=$row["CUID"];
		$comments.= "			<li>
							<p class='title'>$title</p>
							<p class='comment'>$comment</p>
							<p class='author'>- $author</p>
						<form action='commentEdit.php?course=$GUID&id=$SUID' method='POST'>
						    <input class='lightblue-button' type='submit' value='Edit'/>
                                                    <input type='text' name='CUID' value='$CUID' class='hiddenForm' style='display: none;'>
                                                    <input type='text' name='title' value='$title' id='hiddenForm4' style='display: none;'>
                                                    <input type='text' name='comment' value='$comment' id='hiddenForm5' style='display: none;'>
						</form>		
						</li>
				";
	}
}
$tags="";
$tags2="";
$sql = "SELECT * FROM `test`.`tags` WHERE `UUID`='$UUID'";
$result=$db->query($sql);
for($i=0; $i<mysqli_num_rows($result); $i++){
	if($row = mysqli_fetch_array($result)){
		$tag=$row["TUID"];
		$text=$row["text"];
	    if($tag==$_GET["filter"]){
		$tags.=	"<a href='./feedback-instructors.php?course=$GUID&id=$SUID&filter=$tag'>																															
				<button class='darkblue-button filter-button'>
					<span class='label' style='text-align: center;'>$text</span>
				</button>
			</a>";
	    }else{
		$tags.=	"<a href='./feedback-instructors.php?course=$GUID&id=$SUID&filter=$tag'>																															
				<button class='white-button filter-button'>
					<span class='label' style='text-align: center;'>$text</span>
				</button>
			</a>";
		}
		$tags2.="<input type='checkbox' name='tag[]' id='$tag' value='$tag'/><label for='$TUID'>$text</label>";
	}
}
if($_GET["filter"]==""){
	$tags.=	"<a href='./feedback-instructors.php?course=$GUID&id=$SUID'>
		<button class='darkblue-button filter-button'>
		<span class='label' style='text-align: center;'>All Comments</span>
		</button>
		</a>";
}else{
	$tags.=	"<a href='./feedback-instructors.php?course=$GUID&id=$SUID'>
		<button class='white-button filter-button'>
		<span class='label' style='text-align: center;'>All Comments</span>
		</button>
		</a>";
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
						<a href="feedback.php">&larr; Back to Course List</a>
					</li>
				</ul>
			</div>
			<div id="tabs">
				<ul class="tabs">
					<li><a href="#tab-previousfeedback"><span>Previous Feedback</span></a></li>
					<li><a href="#tab-leavefeedback"><span>Leave Feedback</span></a></li>
<!--					<li><a href="#tab-forms"><span>Complete Forms</span></a></li>-->
					<li><a href="#tab-appointment"><span>Add Appointment</span></a></li>
				</ul>
			 	<div id="tab-previousfeedback">
					<h3><?php echo "$name"?>'s Previous Feedback for <?php echo $course ?></h3>
					<div id="feedback-students-filters">
							<p>Filter feedback by tag:</p>
							<?php echo $tags?>
					</div>
					<ul id="previous-feedback-list">
						<?php echo $comments ?>
					</ul>
			  	</div>
			  	<div id="tab-leavefeedback">
					<h3>Leave <?php echo "$name"?> feedback for <?php echo $course ?></h3>
					<div id="feedback-form">
						<form action="commentSubmit.php" method="post">			
							<p>
								<label>Title: </label>
								<input class="feedback-input" type="text" name="title" placeholder="Needs improvement on a certain topic"/>
							</p>
							<p>
								<textarea class="feedback-textarea" name="comment" placeholder="Type your comment here"></textarea>
							</p>
							<input style="display: none" type="text" name="GUID" value="<?php echo $GUID ?>"/>
							<input style="display: none" type="text" name="SUID" value="<?php echo $SUID ?>"/>
							<div class="add-button">
								<label>Released to Students? <input type="checkbox" name="students" value="1" checked/></label>
							</div>
							<div class="add-button">
								<label>Released to Instructors? <input type="checkbox" name="instructors" value="1" checked/></label>
							</div>
							<div id=tagList>
								<h3>Tags:</h3>
								<p><?php echo $tags2 ?></p>
							</div>
							<div class="add-button">
								<button type="submit" class="darkblue-button" value="">Leave feedback</button>
							</div>
						</form>
					</div>
			  	</div>
<!--			  	<div id="tab-forms">
			  		<h3>Complete printable forms for <?php echo "$name"?> for <?php echo $course ?></h3>
					<div id="pdfs">
						<iframe class="embedded-doc" src="https://docs.google.com/document/d/1guj99J1rP7jXL0wPH5IDPbSrVIrl6Wv3t6N2lAqes-M/pub?embedded=true"></iframe>
					</div>
					<div id="forms-feedback">
						<p><?php echo "$name"?>'s Previous Feedback for <?php echo $course ?></p>
						<div id="feedback-students-filters">
							<p>Filter feedback by tag:</p>
							<?php echo $tags ?>
						</div>
						<ul id="previous-feedback-list">
							<?php echo $comments ?>
						</ul>
					</div>
			  	</div>-->
			  	<div id="tab-appointment">
			  		<h3>Make an appointment with <?php echo "$name"?></h3>
			  		<div id="tab-appointment-container">
						<h3 class="centered">Appointment Information</h3>
						<form id="add-appointments-form" action="addAppointments.php" method="post">
							<div class="input-fields">
								<label for="title">Title: </label>					
								<input type="text" name="title" placeholder="(i.e. Coffee with Joe)"/>
							</div>
							<div class="input-fields appt-add-student">
								<label for="studentname">Student: </label>					
								<input type="text" class="appt-enter-student" name="studentname" placeholder="John Smith"/>
							</div>
							<ul id="sresults">
						
							</ul>
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
							<div style="padding-top: 3%" class="add-button">								
								<label for="submitAppt"></label>
								<input type="submit" name="submitAppt" value="Add Appointment" class="lightblue-button">	
							</div>
						</form>	
					</div>
			  	</div>
			</div>
		</div>​
	<?php include('footer.php'); ?>

