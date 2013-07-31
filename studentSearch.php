<?php
include("initialize.php");
$terms=$_POST['query'];
$words= explode(" ", $terms);
$final="";
for($i=0; $i<count($words); $i++){
$sql="SELECT * FROM `test`.`students` WHERE `user` LIKE '%$words[$i]%' OR `id` LIKE '%$words[$i]%'";
$result=$db->query($sql);
$name;
$photo;
$title;
$spec;
$html="";
$repeated=array();
    for($i=0; $i<mysqli_num_rows($result); $i++){
        if($row=mysqli_fetch_array($result)){
            if(!in_array($row["SUID"],$repeated)){
                array_push($repeated, $row["SUID"]);
                 $name=$row["user"];
                 $photo=$row["photo"];
                 $title=$row["title"];
                 $spec=$row["speciality"];
                 $SUID=$row["SUID"];
                 $final.="<li class='dynamicSelection' data-dynamicContent='selection'>
                    <a>
                    <h1 class='user'>$name</h1>
                    <img src='$photo' class='imgTile'alt='getarealphone'/>
                    <p>$title, $spec</p>
                    </a>
                    <input type='text' class='suid' style='display:none' value='$SUID'>
                    </li>";
                }
             }
         }
}
echo $final;
?>