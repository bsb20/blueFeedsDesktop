<?php
session_start();
date_default_timezone_set("America/New_York");
$table="`test`.`students`";
$table2="`test`.`appointments`";
$db=new mysqli("127.0.0.1","root","devils","test",8889);
if($db->connect_errno){
    echo "FAILURE";
}
$GUID=$_SESSION["GUID"];
$UUID=$_SESSION["UUID"];
$final="";
$sql = "SELECT * FROM $table,$table2 WHERE $table.`SUID`=$table2.`SUID` AND $table2.`UUID`='$UUID' ORDER BY `start`;";
$result=$db->query($sql);
$recentAppt = "";
for($i=0; $i<mysqli_num_rows($result); $i++){
    if($row=mysqli_fetch_array($result)){
            $name=$row["user"];
            $photo=$row["photo"];
            $title=$row["title"];
            $spec=$row["speciality"];
			$past=strtotime($row['start'])>time() || $row['isWeekly'] ? "a" : "d";
			$pastMessage= strtotime($row['start'])>time() || $row['isWeekly'] ? "":"Past Meeting Time";
			$duration=$row['duration'];
			$start=strtotime($row['start']);
			$formattedStart=date("g:i A",$start);
			$formattedDate=date("m/d/y",$start);
			$end=date("g:i", strtotime($row['end']));
			$weekly= $row['isWeekly'] ? "Weekly: ".date("l",$start) : date("l, M j", $start);
			$title=$row['title'];
			$loc=$row['location'];
			$AUID=$row["AUID"];
			$today=getDate();
			$testday = $today['mday'];
			$day=intval(date("j",$start));
			$month=intval(date("n",$start));
			$year=intval(date("Y",$start));
			$beginweek = $today['mday'] - $today['mday']%7;
			$endweek = $today['mday']+7 - ($today['mday']+7)%7;			
			if($beginweek <= $day and $day <= $endweek and $today['mon']==$month and $today['year']==$year)
			{
				$recentAppt.="								<li class='landing-appointment'>$name at $formattedStart on $formattedDate</li>";								
			}
	}
}
$_SESSION['appointments'] = $recentAppt;
			
$table="`test`.`comments`";
$sql = "SELECT * FROM ".$table."WHERE `UUID`='$UUID' AND `GUID`='$GUID' ORDER BY date DESC";
$result=$db->query($sql);
$recentcomment2="";
$formattedDate;
for($i=0; $i<mysqli_num_rows($result); $i++){
	if($row=mysqli_fetch_array($result)){
		$title=$row["title"];
		$text=$row["text"];
		$CUID=$row["CUID"];
		$SUID=$row["SUID"];		
		$date=$row["date"];
		$time=strtotime($date);
		$formattedDate=date("m/d/y",$time);
	}
	$recentComment1="<h2>Most Recent Comment:</h2>
					<br>
					<div>
						<h3>Description: </h3>					
						<br>
						<p id='RecentCommentText'>
							$text
						</p>
					</div>";
	break;
}
$_SESSION["recentComment1"]=$recentComment1;	

$table="`test`.`students`";
$sql = "SELECT * FROM ".$table." WHERE `SUID`='$SUID';";
$result=$db->query($sql);
$recentcomment1="";
if($row=mysqli_fetch_array($result)){
	$student=$row["user"];
	if($recentComment1 !== "")
	{
		$recentComment2="
						<div id='RecentCommentDiv'>
							<h3>To: </h3>
							<br>
							<p id='RecentCommentText'>
								$student
							</p>
						</div>
						<div id='RecentCommentDiv'>					
							<h3>On: </h3>
							<br>						
							<p id='RecentCommentText'>
								$formattedDate
							</p>	
						</div>";		
	}
}
$_SESSION["recentComment2"]=$recentComment2;

/* Populates the rss with the links from the xml file */
$filepath = "/home/htdocs/desktop/bluefeedsTest.xml";
$xml = simplexml_load_file($_SERVER['DOCUMENT_ROOT'].$filepath);
$rss = "";
foreach($xml->channel->item as $item)
{
	$title = $item->title;
	$link = $item->link;
	$date = $item->date;
	$desc = $item->description;
	
	$rss.="			<li>
						<div>
							<p class='landing-news-title'><a href=$link target='_blank'>$title</a></p>			
						</div>
					</li>";
}
$_SESSION['rss'] = $rss;

$table="`test`.`groups`";
$table1="`test`.`courses`";
$sql="SELECT * FROM $table1, ".$table." WHERE $table.`UUID`='".$UUID."' AND $table1.`GUID`=$table.`GUID`;";
$result=$db->query($sql);

$buttons = "";
$buttons.="<a href='./HelpPage.php'><button id='courseButton'><i class='icon-help'></i>Help</button></a>";
for($i=0; $i<mysqli_num_rows($result); $i++){
	if($row=mysqli_fetch_array($result)){
		$info=$row["info"];
		$title=$row['title'];
		$BUTTONGUID=$row['GUID'];
		$link = "./setGUID.php?course=" . $BUTTONGUID;
		if($GUID !== '' && $BUTTONGUID==$GUID)
		{
			$buttons.="<a href=$link><button id='courseButton' class='bg-color-blueDark'><i class='icon-bookmark'></i>$title</button></a>";			
		}
		else
		{
			$buttons.="<a href=$link><button id='courseButton'><i class='icon-bookmark'></i>$title</button></a>";			
		}
	}
}
$_SESSION['buttons'] = $buttons;
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
				$('#navbar-Home').css('background-color','rgba(38,65,108,1)');
			});
		</script>
	</head>
	<body>
		<div id="title-bar">
			<h1>BlueFeeds</h1>
		</div>
		<div id="page-title">
			<h2>BlueFeeds Lobby</h2>
		</div>
		<div id="container">
			<div id="navbar">
				<ul>
					<li id="navbar-Home">
						Home
					</li>
					<li id="navbar-Appointments">
						<a href="appointments.php">Appointments</a>
					</li>
					<li id="navbar-Courses">
						<a href="courses.php">Courses</a>
					</li>
					<li id="navbar-NewsFeed">
						<a href="newsfeed.php">News Feed</a>
					</li>
				</ul>
			</div>
			<div id="appointments">
				<h3>This Week's Appointments</h3>
				<ul>
					<?php
						if($_SESSION['appointments']=="")
						{
							echo "<p>You have no appointments this week.</p>";
						}
						else
						{
							echo $_SESSION['appointments'];
						}
					?>							
				</ul>		
				<p class="more-link">
					<a href="appointments.php">Appointments &rarr;</a>
				</p>
			</div>
			<div id="recentNews">
				<h3>Recent News</h3>
				<ul class="landing-news" data-role="accordion">
					<?php
						echo $_SESSION['rss'];
					?>                    
                </ul>
				<p class="more-link">
					<a href="newsfeed.php">News Feed &rarr;</a>
				</p>
			</div>
			<div id="appointments">
				<h3>Your Feedback</h3>
				<p>Feedback goes here</p>
			</div>
		</div>
	</body>
</html>

