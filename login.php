<!-- <?php
/* Logs the user into the Bluefeeds website and sets up a few session variables */
$table="`test`.`users`";
$db=new mysqli("127.0.0.1","root","devils","test",8889);
if($db->connect_errno){
    echo "FAILURE";
}
$user=$_POST["usr"];
$pass=$_POST["pass"];
$sql = "SELECT * FROM ".$table." WHERE `user`='".$user."';";
$result=$db->query($sql);
if($row=mysqli_fetch_array($result) and $row["pass"]==md5($pass,FALSE)){
        session_start();
        $_SESSION["UUID"]=$row["UUID"];
        $_SESSION["GUID"]= NULL;
		$_SESSION['alert'] = FALSE;		
		header('Location: http://bluefeeds.cs.duke.edu/home/htdocs/desktop/LandingPage.php');
    }
else{
	echo "Username/Password combo was incorrect!";
}
?> --!>
<!DOCTYPE html>
<html>
	<head>
		<title>BlueFeeds</title>
		<link rel="stylesheet" type="text/css" href="css/reset.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<style>
		
		</style>
	</head>
	<body class="login-page">
		<div id="title-bar">
			<h1>BlueFeeds</h1>
		</div>
		<div id="page-title">
			<h2>Login</h2>
		</div>
		<div id="login-form">
			<form>
				<div id="login-input-fields">
					<p class="form">Username: <input type="text" name="username"></p>
					<p class="form">Password: <input type="password" name="password"></p>
				</div>
				<div id="login-buttons">
					<button id="go-button" type="submit" class="darkblue-button" value="">Go</button>
					<a href="newaccount.php"><button id="newAccount-button" type="button" class="darkblue-button" value="">New Account?</button></a>
				</div>
			</form>
		</div>
		<div id="footer">
			<p class="footer">
				The BlueFeeds application was built by Ben Berg, Rachel blahblah.
			</p>
			<p class="footer">
				Website designed and built by <a href="mailto:org.glennon@gmail.com">Olivia Glennon</a>
			</p>
		</div>
	</body>
</html>