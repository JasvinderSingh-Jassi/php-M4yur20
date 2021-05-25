<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$conn = new mysqli('remotemysql.com', 'qGNCPDYwWb', '9OlCyEROxy', 'qGNCPDYwWb');
 
if ($conn->connect_errno) {
    echo "Error: " . $conn->connect_error;
}

$mail = new PHPMailer(true);
$mail->isHTML(true);
$mail->SMTPDebug = -1;									
$mail->isSMTP();											
$mail->Host	 = 'smtp.gmail.com;';					
$mail->SMTPAuth = true;							
$mail->Username = 'mayuragarwalrtcampassignment@gmail.com';				
$mail->Password = '8879492968';						
$mail->SMTPSecure = 'tls';							
$mail->Port	 = 587;
$mail->setFrom('mayuragarwalrtcampassignment@gmail.com', 'Mayur Agarwal');	

?>