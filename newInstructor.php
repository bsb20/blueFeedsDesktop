<?php
function create(){
include("initialize.php");    
$table="`test`.`users`";
if($_POST["pass"]!=$_POST["passc"]){
    return 1;
}
$user=$_POST['usr'];
$password=md5($_POST['pass'],FALSE);
$email=$_POST['email'];
$photo=$_FILES['photo']['tmp_name'];
$title=$_POST['title'];
$spec=$_POST['speciality'];
$UUID=uniqid("",FALSE);
$_SESSION["UUID"]=$UUID;
$sql = "SELECT * FROM ".$table." WHERE `user`='".$user."';";
$hasDuplicatesResult=$db->query($sql);
if(mysqli_fetch_array($hasDuplicatesResult)){
    return 2;
}
$db->real_query("INSERT INTO ".$table." (`user`, `pass`, `email`, `UUID`, `photo`, `title`, `speciality`) VALUES ('$user', '$password', '$email', '$UUID', '$photo', '$title', '$spec');");
return 0;
}
switch(create()){
    case(1):
        echo "passwords did not match!";
        break;
    case(2):
        echo "username is already in use, try again!";
        break;
    default:
        header("Location: login.html");
    }
?>