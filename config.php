<?php
require __DIR__.'/vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$mail = new PHPMailer(true);
$mail->isHTML(true);
$mail->SMTPDebug = -1;									
$mail->isSMTP();											
$mail->Host	 = 'smtp.gmail.com;';					
$mail->SMTPAuth = true;							
$mail->Username = ''; // from email			
$mail->Password = ''; // email password						
$mail->SMTPSecure = 'tls';							
$mail->Port	 = 587;
$mail->setFrom('from_email', 'from_name');
$conn = new mysqli('db_host', 'db_username', 'db_password', 'db_name');
 
if ($conn->connect_errno) {
    echo "Error: " . $conn->connect_error;
}
?>