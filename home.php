<?php
include("initialize.php");
$table="`test`.`students`";
$table2="`test`.`appointments`";
$GUID=$_SESSION["GUID"];
$UUID=$_SESSION["UUID"];
$isStudent=$_SESSION["isStudent"];
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
				$recentAppt.="<li class='landing-appointment'>
								<p>
									<strong>$title</strong>
								</p>
								<p>
									<em>with $name</em>
								</p>
								<p>
									Date:&nbsp;&nbsp;$date
								</p>
								<p>
									Time: $formattedStart - $end
								</p>
								<p>
									Location: $loc
								</p>
							</li>";								
			}
	}
}
$_SESSION['appointments'] = $recentAppt;
			
$table="`test`.`comments`";
$sql = "SELECT * FROM ".$table."WHERE `UUID`='$UUID' ORDER BY date DESC";
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
	$recentComment1="<li>
						<p class='title'>$title</p>
						<p class='comment'>$text</p>
						<p class='author'>- $instructor</p>
					</li>";
	break;
}
//$_SESSION["recentComment1"]=$recentComment1;	

$table="`test`.`students`";
$sql = "SELECT * FROM ".$table." WHERE `SUID`='$SUID';";
$result=$db->query($sql);
$recentcomment1="";
if($row=mysqli_fetch_array($result)){
	$student=$row["user"];
	if($recentComment1 !== "")
	{
		$recentComment2="
						<li>
							<p class='title'>$title</p>
							<p class='comment'>$text</p>
							<p class='author'>- $instructor</p>
						</li>";		
	}
}
$_SESSION["recentComment2"]=$recentComment2;

/* Populates the rss with the links from the xml file */
$table="`test`.`feeds`";
$UUID=$_SESSION["UUID"];
$sql = "SELECT * FROM `test`.`feeds` WHERE `UUID`='$UUID' OR `UUID`='a'";
$result=$db->query($sql);
$rss = "";
for($i=0; $i<mysqli_num_rows($result); $i++){
    if($row=mysqli_fetch_array($result)){
	$url=$row["url"];
    }
$xml =simplexml_load_file($url);
$limit=0;
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
    $limit++;
    if($limit>5){
        break;
    }
}
}


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
					<li id="navbar-Feedback">
						<a href="feedback.php">Feedback</a>
					</li>
					<?php if(!$isStudent){echo '<li id="navbar-NewsFeed">
						<a href="newsfeed.php">News Feed</a>
					</li>';}?>
				</ul>
			</div>
			<div id="home" class="clearfix">
				<div id="home-container" class="clearfix">
					<div id="home-left">
						<div id="appointments">
							<h3>This Week's Appointments</h3>
							<ul>
								<?php
						
									if($recentAppt=="")
									{
										echo "<p>You have no appointments this week.</p>";
									}
									else
									{
										echo $recentAppt;
									}
								?>							
							</ul>		
							<p class="more-link">
								<a href="appointments.php">Appointments &rarr;</a>
							</p>
						</div>
						<div id="home-feedback">
							<h3>Recent Feedback</h3>
							<ul id="previous-feedback-list">
								<?php echo $recentComment1?>
							</ul>
							<p class="more-link">
								<a href="feedback.php">All Feedback &rarr;</a>
							</p>
						</div>
					</div>
					<?php if(!$isStudent){echo '<div id="recentNews">
						<h3>Recent News</h3>
						<ul class="landing-news" data-role="accordion">'.$rss.'
						</ul>
						<p class="more-link">
							<a href="newsfeed.php">News Feed &rarr;</a>
						</p>
					</div>';}?>
				</div>
			</div>
		</div>
	<?php include('footer.php'); ?>
