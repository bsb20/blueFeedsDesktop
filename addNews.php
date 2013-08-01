<?php
	/* RSS Feed split with the publishing form on the right */
	session_start();
	$filepath = "/home/htdocs/desktop/bluefeedsTest.xml";
	$xml = simplexml_load_file($_SERVER['DOCUMENT_ROOT'].$filepath);
	$rss = "";
	foreach($xml->channel->item as $item)
	{
		$title = $item->title;
		$link = $item->link;
		$date = $item->date;
		$desc = $item->description;
		
		/* Populates rss feed split html with links and buttons */
		$rss.="						<li>
						<a>$title</a>
						<div>
							<h3>$title</h3>
							$desc
							<p>
								$date
							</p>
							<a href=$link><button class='bg-color-blueLight'> Link </button></a>	
							<a href='#'><button class='bg-color-red'> Delete </button></a>							
						</div>
					</li>";
	}
	$_SESSION['rss'] = $rss;
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
				$('#subnav-addNews').css('background-color','rgba(38,65,108,1)');
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
						<a href="newsfeed.php">News Feed</a>
					</li>
					<li id="subnav-addNews">
						Add New Article
					</li>
				</ul>
			</div>
			<div id="addNews-container">
				<h3 class="centered">Article Information</h3>
				<form id="add-article-form" action="articleSubmit.php" method="post">
					<div class="input-fields">
						<label for="title">Title: </label>					
						<input class="addNews-input" type="text" name="title" placeholder="New Methods in Teaching Medical Students"/>
					</div>
					<div class="input-fields">
						<label for="studentname">Description: </label>					
						<input class="addNews-input" type="text" name="desc" />
					</div>					
					<div class="input-fields">
						<label for="location">Link: </label>					
						<input class="addNews-input" type="text" name="link" placeholder="http://" />
					</div>
					<div class="add-button">
						<input type="submit" name="addNews" value="Add New Article" class="darkblue-button">	
					</div>
				</form>
			</div>
		</div>
	<?php include('footer.php'); ?>
