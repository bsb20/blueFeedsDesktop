<?
include("initialize.php");

$table="`test`.`feeds`";
$url=$_POST["link"];
$title=$_POST["title"];
$user=$_POST["UUID"];
$FUID=uniqid("",FALSE);
$date=date("Y-m-d H:i:s");
$db->real_query("INSERT INTO ".$table." (`UUID`, `date`, `url`, `FUID`, `title`) VALUES ('$user', '$date', '$url', '$FUID','$title');");
header("Location: newsfeed.php");
exit;
?>
