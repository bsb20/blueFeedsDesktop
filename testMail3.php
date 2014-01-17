<?php
//include('Mail.php');
function mailer($address,$content){
require_once "Mail.php";
 
 $from = "Brett Cadigan <bluefeedsmail@gmail.com>";
 $to = $address;
//Brett Cadigan <bluefeedsmail@gmail.com>;
 $subject = "Notification from BlueFeeds!";
 $body = $content;
 
 $host = "smtp.gmail.com";
 $username = "bluefeedsmail";
 $password = "dukebluedevils";
 
 $headers = array ('From' => $from,
   'To' => $to,
   'Subject' => $subject);

 $smtp =& Mail::factory('smtp',
   array ('host' => $host,
     'auth' => true,
     'username' => $username,
     'password' => $password,
  ));

$mail = $smtp->send($to, $headers, $body);

 if (PEAR::isError($mail)) {
   echo("<p>" . $mail->getMessage() . "</p>");
  } else {
   echo("<p>Message successfully sent!</p>");
  }
}
 ?>
