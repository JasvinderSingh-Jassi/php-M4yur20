<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$conn = new mysqli('remotemysql.com', 'qGNCPDYwWb', '9OlCyEROxy', 'qGNCPDYwWb');
 
if ($conn->connect_errno) {
    echo "Error: " . $conn->connect_error;
}

$from_email = 'mayuragarwalrtcampassignment@gmail.com';
$email_pass = '8879493968';

$mail = new PHPMailer(true);
$mail->isHTML(true);
$mail->SMTPDebug = -1;									
$mail->isSMTP();											
$mail->Host	 = 'smtp.gmail.com;';					
$mail->SMTPAuth = true;							
$mail->Username = $from_email;				
$mail->Password = $email_pass;						
$mail->SMTPSecure = 'tls';							
$mail->Port	 = 587;
$mail->setFrom($from_email, 'Mayur Agarwal');	

?>