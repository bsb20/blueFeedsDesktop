<?php
function create(){
include("initialize.php");
$table="`test`.`students`";
$joinTable="`test`.`su`";
if($_POST["pass"]!=$_POST["passc"]){
    return 1;
}

$UUID=$_SESSION["UUID"];
$user=$_POST['first']." ".$_POST["last"];
$email=$_POST['email'];
$photo="./uploads/nophoto.gif";
$title=$_POST['title'];
$spec=$_POST['study'];
$SUID=uniqid("",FALSE);
$_SESSION["SUID"]=$SUID;
$id=$_POST["id"];
$pass=md5($_POST["password"],FALSE);
$sql = "SELECT * FROM ".$table." WHERE `user`='".$user."' OR `id`='$id';";
$hasDuplicatesResult=$db->query($sql);
if(mysqli_fetch_array($hasDuplicatesResult)){
    return 2;
}
$db->real_query("INSERT INTO ".$table." (`user`, `email`, `SUID`, `photo`, `title`, `speciality`, `id`, `pass`) VALUES ('$user','$email', '$SUID', '$photo', '$title', '$spec', '$id', '$pass');");
return 0;
}
switch(create()){
    case(1):
        echo "passwords did not match!";
        break;
    case(2):
        echo "student is already in system, try again!";
        break;
    default:
	    header("Location: login.html");
    }
?>
