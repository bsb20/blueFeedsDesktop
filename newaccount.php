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
			<h2>Create an Account</h2>
		</div>
		<div id="newaccount-container">
			<div id="create-instructor">
				<h3 class="large">Create Instructor Account</h3><br />
				<p>
					<form>
						<div class="input-fields">
							<p class="form">Username: <input type="text" name="username"></p>
							<p class="form">Password: <input type="password" name="password"></p>
							<p class="form">Confirm Password: <input type="password" name="confpassword"></p>
							<p class="form">E-mail Address: <input type="text" name="email"></p>
							<p class="form">Title: <input type="text" name="title" placeholder="(e.g. Resident)"></p>
							<p class="form">Specialty: <input type="text" name="email"></p>
						</div>
						<div class="add-button">
							<button type="button" class="darkblue-button" value="">Create Account</button>
						</div>
					</form>
				</p>
			</div>
			<div id="create-student">
				<h3 class="large">Create Student Account</h3><br />
				<p>
					<form>
						<div class="input-fields">
							<p class="form">First Name: <input type="text" name="firstname"></p>
							<p class="form">Last Name: <input type="text" name="lastname"></p>
							<p class="form">Username: <input type="text" name="username"></p>
							<p class="form">Password: <input type="password" name="password"></p>
							<p class="form">Confirm Password: <input type="password" name="confpassword"></p>
							<p class="form">E-mail Address: <input type="text" name="email"></p>
							<p class="form">Title: <input type="text" name="title" placeholder="(e.g. Resident)"></p>
							<p class="form">Area of Study: <input type="text" name="area"></p>
						</div>
						<div class="add-button">
							<button type="button" class="darkblue-button" value="">Create Account</button>
						</div>
					</form>
				</p>
			</div>
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