<?php
	/* Rss feed display page */
include('initialize.php');
	/* Set this variable to the location of the xml file */
	/* Note: the xml file has to have read and write privileges which can be changed with chmod */
	//$filepath = "/home/htdocs/desktop/bluefeedsTest.xml";
	//$xml = simplexml_load_file($_SERVER['DOCUMENT_ROOT'].$filepath);
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
foreach($xml->channel->item as $item)
	{
		$title = $item->title;
		$link = $item->link;
		$date = $item->date;
		$desc = $item->description;
		
		
		$rss.="<a href=$link>
				<li style='margin-top: 20px;' class='newsfeed-item'>
					<div class='clearfix'>
						<a href='./deleterss.php?title=$title'><button style='float:right;' class='lightblue-button delete-button'>x</button></a>
						<h3>$title</h3>
						<p class='news-description'>
							$desc
						</p>
						<p>
							$date
						</p>							
					</div>
				</li>
			</a>";
	}
	$_SESSION['rss'] = $rss;
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
				$('#navbar-NewsFeed').css('background-color','rgba(38,65,108,1)');
				$('#subnav-NewsFeed').css('background-color','rgba(38,65,108,1)');
			});
		</script>
	</head>
	<body>
		<div id="title-bar">
			<h1>BlueFeeds</h1>
		</div>
		<div id="page-title">
			<h2>News Feed</h2>
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
						<a href="feedback.php">Feedback
					</li>
					<li id="navbar-NewsFeed">
						News Feed
					</li>
				</ul>
			</div>
			<div id="subnav">
				<ul>
					<li id="subnav-NewsFeed">
						News Feed
					</li>
					<li id="subnav-addNews">
						<a href="addNews.php">Add New Article</a>
					</li>
				</ul>
			</div>
			<div id="newsfeed-container">
				<h3>News Articles</h3>
				<ul id="newsfeed-list">
					<?php
						echo $_SESSION['rss'];
					?>
				</ul>
				<div class="add-button">
				<a href="addNews.php"><button class="darkblue-button">Add New Article</button></a>
        		</div>
        	</div>
		</div>​
	<?php include('footer.php'); ?>

