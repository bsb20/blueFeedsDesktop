<?php

include("initialize.php");
if (!empty($_FILES))
{
echo $_FILES['photo']['error'].": ";
$table="`test`.`students`";
$fileExtension=$_SESSION["SUID"];
    // PATH TO THE DIRECTORY WHERE FILES UPLOADS
    $file_src   =   'uploads/'.$_FILES['photo']['name'];
    // FUNCTION TO UPLOAD THE FILE
    if(move_uploaded_file($_FILES['photo']['tmp_name'], "uploads/$fileExtension.jpg")):
    // SHOW THE SUCCESS MESSAGE AFTER THE MOVE - NO VISIBLE CHANGE
    echo 'Your file has been uploaded successfully';
    else:
    // SHOW ERROR MESSAGE
    echo 'Error';
    endif;
    
$sql = "UPDATE $table SET `photo`='uploads/$fileExtension.jpg' WHERE `SUID`='$fileExtension';";
$result=$db->query($sql);
chmod("uploads/$fileExtension.jpg",0766);
$exif=exif_read_data("uploads/$fileExtension.jpg",0,true);
$orient=$exif["IFD0"]["Orientation"];
switch($orient){
	case 3:
	     shell_exec("bash uploads/rotate.sh uploads/$fileExtension.jpg 180");
	break;
	case 6:
	     shell_exec("bash uploads/rotate.sh uploads/$fileExtension.jpg 90");
	break;
	}
}
?>
