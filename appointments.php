<?php
	session_start();
	date_default_timezone_set("America/New_York");
	$table="`test`.`students`";
	$table2="`test`.`appointments`";
	$db=new mysqli("127.0.0.1","root","devils","test",8889);
	if($db->connect_errno){
		echo "FAILURE";
	}
	$UUID=$_SESSION["UUID"];
	$final="";
	$sql = "SELECT * FROM $table,$table2 WHERE $table.`SUID`=$table2.`SUID` AND $table2.`UUID`='$UUID' ORDER BY `start`;";
	$result=$db->query($sql);
	$table = "";
	
	$numAppt = 0;
	$apptToday = 0;
	/* Time Filtering */
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
				$end=date("g:i A", strtotime($row['end']));
				$weekly= $row['isWeekly'] ? "Weekly: ".date("l",$start) : date("l, M j", $start);
				$title=$row['title'];
				$loc=$row['location'];
				$AUID=$row["AUID"];
				
				$today=getDate();
				$testday = $today['mday'];
				$day=intval(date("j",$start));
				$month=intval(date("n",$start));
				$year=intval(date("Y",$start));	

				if(empty($_GET))
				{
					$timeframe="thisweek";
				}
				else
				{
					$timeframe=$_GET["filter"];
				}
				
				if($today['mday']==$day and $today['mon']==$month and $today['year']==$year)
				{
					$apptToday++;
				}
				
				switch ($timeframe)
				{
					case "today":
						if($today['mday']==$day and $today['mon']==$month and $today['year']==$year)
						{
							$table.="<div class='appointments-appointment'>
						<p>
						<strong>$title</strong>
						</p>
						<p>
						<em>with $name</em>
						</p>
						<p>
						Date: $??
						</p>
						<p>
						Time: $formattedStart - $end
						</p>
						<p>
						Location: $loc
						</p>
					</div>
					";		
							$numAppt++;
						}		
						break;
						
					case "thisweek":
						$beginweek = $today['mday'] - $today['mday']%7;
						$endweek = $today['mday']+7 - ($today['mday']+7)%7;						
						if($beginweek <= $day and $day <= $endweek and $today['mon']==$month and $today['year']==$year)
						{
							$table.="							<div class='appointments-appointment'>
						<p>
						<strong>$title</strong>
						</p>
						<p>
						<em>with $name</em>
						</p>
						<p>
						Date: $??
						</p>
						<p>
						Time: $formattedStart - $end
						</p>
						<p>
						Location: $loc
						</p>
					</div>";				
							$numAppt++;
						}				
						break;

					case "month":
						if($today['mon']==$month and $today['year']==$year)
						{
							$table.="							<div class='appointments-appointment'>
						<p>
						<strong>$title</strong>
						</p>
						<p>
						<em>with $name</em>
						</p>
						<p>
						Date: $??
						</p>
						<p>
						Time: $formattedStart - $end
						</p>
						<p>
						Location: $loc
						</p>
					</div>";	
							$numAppt++;
						}				
						break;
						
					case "all":
						if($today['year']==$year)
						{
							$table.="						<div class='appointments-appointment'>
						<p>
						<strong>$title</strong>
						</p>
						<p>
						<em>with $name</em>
						</p>
						<p>
						Date: $??
						</p>
						<p>
						Time: $formattedStart - $end
						</p>
						<p>
						Location: $loc
						</p>
					</div>";				
							$numAppt++;
						}				
						break;						
				}
		}
	}
	switch($timeframe)
	{
		case "today":
			$_SESSION['message'] = "Here are your appointments for today:";	
			break;
		case "thisweek":
			$_SESSION['message'] = "Here are your appointments for this week:";
			break;
		case "month":
			$_SESSION['message'] = "Here are your appointments for this month:";
			break;
		case "all":
			$_SESSION['message'] = "Here is your history of appointments:";
			break;
	}
	$_SESSION['apptToday'] = $apptToday;
	$_SESSION['numAppt'] = $numAppt;
	$_SESSION['appointments'] = $table;
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
				$('#navbar-Appointments').css('background-color','rgba(38,65,108,1)');
				$('#subnav-Appointments').css('background-color','rgba(38,65,108,1)');
			});
		</script>
	</head>
	<body>
		<div id="title-bar">
			<h1>BlueFeeds</h1>
		</div>
		<div id="page-title">
			<h2>Appointments</h2>
		</div>
		<div id="container">
			<div id="navbar">
				<ul>
					<li id="navbar-Home">
						<a href="home.php">Home</a>
					</li>
					<li id="navbar-Appointments">
						Appointments
					</li>
					<li id="navbar-Courses">
						<a href="courses.php">Courses</a>
					</li>
					<li id="navbar-NewsFeed">
						<a href="newsfeed.php">News Feed</a>
					</li>
				</ul>
			</div>
			<div id="subnav">
				<ul>
					<li id="subnav-Appointments">
						View Appointments
					</li>
					<li id="subnav-addAppointments">
						<a href="addAppointments.php">Add Appointments</a>
					</li>
				</ul>
			</div>
			<div id="appointments-container">
				<div id="appointments-filters">
					<a href="./appointments.php?filter=today">																									
						<button class="white-button">
							<span class="label" style="text-align: center;"> Today
							</span>
						</button>	
					</a>
					<a href="./appointments.php?filter=thisweek">																												
						<button class="white-button">
							<span class="label" style="text-align: center;"> This Week
							</span>
						</button>
					</a>
					<a href="./appointments.php?filter=month">																															
						<button class="white-button">
							<span class="label" style="text-align: center;"> This Month
							</span>
						</button>
					</a>
					<a href="./appointments.php?filter=all">																															
						<button class="white-button">
							<span class="label" style="text-align: center;"> All
							</span>
						</button>
					</a>
				</div>							
				<p>
					<em><?php
						echo "You have " . $_SESSION['apptToday'] . " appointments today.";
					?></em>
				</p>
				<div id="appointments-appointments">
					<table class="striped">
						<?php
							if(!$_SESSION['numAppt']==0)
							{
								echo $_SESSION['appointments'];								
							}
							else
							{
								echo "
					<p>
						You currently have no appointments in this timeframe.
					</p>
					<div class='appointments-appointment'>
						<p>
						<h3>Coffee with Joe</h3>
						</p>
						<p>
						<em>with Joe Shmo</em>
						</p>
						<p>
						Date:&nbsp;&nbsp;6/27/13
						</p>
						<p>
						Time:&nbsp;&nbsp;1:00pm - 4:30pm
						</p>
						<p>
						Location:&nbsp;&nbsp;Starbucks
						</p>
					</div>
					";
							}
						?>						
					</table>
				</div>
			</div>		
		</div>​
	</body>
</html>

