<?php

/*
Authors: Benjamin Berg, Rachel Harris, Conrad Haynes, Jack Zhang, Brett Cadigan
This php script submits handles all photo-based applications within the app. Specifically, it allows the user (UUID) to
access the phones camera and upload profile pictures for themselves (and possibly for students).
*/

include("initialize.php");
if (!empty($_FILES))
{
echo $_FILES['photo2']['error'].": ";
$table="`test`.`users`";
$fileExtension=$_SESSION["UUID"];
    // PATH TO THE DIRECTORY WHERE FILES UPLOADS
    $file_src   =   'uploads/'.$fileExtension.$_FILES['photo2']['name'];
    // FUNCTION TO UPLOAD THE FILE
    if(move_uploaded_file($_FILES['photo2']['tmp_name'], $file_src)):
    // SHOW THE SUCCESS MESSAGE AFTER THE MOVE - NO VISIBLE CHANGE
    echo 'Your file has been uploaded successfully';
    else:
    // SHOW ERROR MESSAGE
    echo 'Error';
    endif;
    
$sql = "UPDATE $table SET `photo`='$file_src' WHERE `UUID`='$fileExtension';";
$result=$db->query($sql);
chmod($file_src,0766);
$exif=exif_read_data($file_src,0,true);
$orient=$exif["IFD0"]["Orientation"];
switch($orient){
	case 3:
	     shell_exec("bash uploads/rotate.sh $file_src 180");
	break;
	case 6:
	     shell_exec("bash uploads/rotate.sh $file_src 90");
	break;
	}
}
?>
<!DOCTYPE html>
<html>
<script>
	function goback(){
	window.history.back();
}
</script>
<body>
<button onclick="goback()">Back</button>
</body>
</html>
