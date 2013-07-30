<?php
/* Logs the user into the Bluefeeds website and sets up a few session variables */
$table="`test`.`users`";
$db=new mysqli("127.0.0.1","root","devils","test",3306);
if($db->connect_errno){
    echo "FAILURE";
}
$user=$_POST["username"];
$pass=$_POST["password"];
if(strlen($user)==0 || strlen($pass)==0){
    echo "Please enter a username or password";
    return;
}
$sql = "SELECT * FROM ".$table." WHERE `user`='".$user."';";
$result=$db->query($sql);
if($row=mysqli_fetch_array($result) and $row["pass"]==md5($pass,FALSE)){
        session_start();
        $_SESSION["UUID"]=$row["UUID"];
        $_SESSION["GUID"]= NULL;
	$_SESSION['alert'] = FALSE;		
	header('Location: home.php');
    }
else{
	echo "Username/Password combo was incorrect!";
}
?>
