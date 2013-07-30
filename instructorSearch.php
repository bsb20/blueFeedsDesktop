<?php
include("initialize.php");
$terms=$_POST['query'];
$words= explode(" ", $terms);
$final="";
for($i=0; $i<count($words); $i++){
$sql="SELECT * FROM `test`.`users` WHERE `user` LIKE '%$words[$i]%' OR `email` LIKE '%$words[$i]%'";
$result=$db->query($sql);
$name;
$photo;
$title;
$spec;
$html="";
$repeated=array();
    for($i=0; $i<mysqli_num_rows($result); $i++){
        if($row=mysqli_fetch_array($result)){
            if(!in_array($row["UUID"],$repeated)){
                array_push($repeated, $row["UUID"]);
                 $name=$row["user"];
                 $title=$row["title"];
                 $spec=$row["speciality"];
                 $UUID=$row["UUID"];
                 $final.="<li class='dynamicSelection' data-dynamicContent='selection'>
                    <a>
                    <h1>$name</h1>
                    <p>$title, $spec</p>
                    </a>
                    <input type='text' class='uuid' style='display:none' value='$UUID'>
                    </li>";
                }
             }
         }
}
echo $final;
?>