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
					<form action="newInstructor.php" method="post">
						<div class="input-fields">
							<p class="form">Username: <input type="text" name="usr"></p>
							<p class="form">Password: <input type="password" name="pass"></p>
							<p class="form">Confirm Password: <input type="password" name="passc"></p>
							<p class="form">E-mail Address: <input type="text" name="email"></p>
							<p class="form">Title: <input type="text" name="title" placeholder="(e.g. Resident)"></p>
							<p class="form">Specialty: <input type="text" name="speciality"></p>
						</div>
						<div class="add-button">
							<button id="go-button" type="submit" class="darkblue-button" value="">Create Account</button>
						</div>
					</form>
				</p>
			</div>
			<div id="create-student">
				<h3 class="large">Create Student Account</h3><br />
				<p>
					<form action="newStudent.php" method="post">
						<div class="input-fields">
							<p class="form">First Name: <input type="text" name="first"></p>
							<p class="form">Last Name: <input type="text" name="last"></p>
							<p class="form">Username: <input type="text" name="id"></p>
							<p class="form">Password: <input type="password" name="pass"></p>
							<p class="form">Confirm Password: <input type="password" name="passc"></p>
							<p class="form">E-mail Address: <input type="text" name="email"></p>
							<p class="form">Title: <input type="text" name="title" placeholder="(e.g. Resident)"></p>
							<p class="form">Area of Study: <input type="study" name="area"></p>
						</div>
						<div class="add-button">
							<button id="newStudent" type="submit" class="darkblue-button" value="">Create Account</button>
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