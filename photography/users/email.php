<?php


$to ='mangi.patrick@yahoo.fr';
$subject='This is a test email';
$message='<h1> hi there,</h1> <p> Thanks for joining</p>';
$headers="From: The sender Name <sender@patrick.com>\r\n";
$headers .="Reply-to: mangi.patrick@yahoo.fr\r\n";
//$headers .="Content-type:text/html\r\n";

//send email
$result=mail($to,$subject,$message,$headers);
if($result==true){
    echo "mail sent";
}
else{
    echo" mail failed";
}

//echo "mail($to,$subject,$message,$headers)";

?>

