<?php
  
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
require_once('config.php');
  
if (isset($_POST['register'])) {
    $message="";
    $email = $_POST['email'];
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    
    if ($result->num_rows >= 1) {
        $row = $result->fetch_assoc();
        if($row['is_subscribed']=='1'){
            $message="Email Id is already registered and active for receiving comics.";
        }
        else{
            $mail = new PHPMailer(true); 
            $mail->isHTML(true);								
	        $mail->Subject = 'Re-verifify your account!';
            try {
                $mail->SMTPDebug = 2;									
                $mail->isSMTP();											
                $mail->Host	 = 'smtp.gmail.com;';					
                $mail->SMTPAuth = true;							
                $mail->Username = 'mayuragarwalrtcampassignment@gmail.com';				
                $mail->Password = '8879492968';						
                $mail->SMTPSecure = 'tls';							
                $mail->Port	 = 587;
        
                $mail->setFrom('mayuragarwalrtcampassignment@gmail.com', 'Mayur Agarwal');	
        
                $mail->addAddress($email);
                
                $message = '
        
                
                
                ';
        
                $mail->Body = $message;
                $mail->send();
                $mail->clearAttachments();
                $mail->ClearAllRecipients();
                echo "Mail has been sent successfully!";
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            $message = "For re-activation, please click on the link received on your email for re-verification.";
        }
    } 

    else {
        $mail = new PHPMailer(true); 
        $mail->isHTML(true);								
        $mail->Subject = 'Re-verifify your account!';
        try {
            $mail->SMTPDebug = 2;									
            $mail->isSMTP();											
            $mail->Host	 = 'smtp.gmail.com;';					
            $mail->SMTPAuth = true;							
            $mail->Username = 'mayuragarwalrtcampassignment@gmail.com';				
            $mail->Password = '8879492968';						
            $mail->SMTPSecure = 'tls';							
            $mail->Port	 = 587;
    
            $mail->setFrom('mayuragarwalrtcampassignment@gmail.com', 'Mayur Agarwal');	
    
            $mail->addAddress($email);
            
            $message = '
    
            
            
            ';
    
            $mail->Body = $message;
            $mail->send();
            $mail->clearAttachments();
            $mail->ClearAllRecipients();
            echo "Mail has been sent successfully!";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        $message="Thank you for registering, please click on the link received on your email for verification.";
    }
  }
?>
<html>
    <head>
        <title>Registartion Form</title>
        <link rel="stylesheet" href="style.css">
        
    </head>
    <body onload="myFunction()">
        <div class="container">
            <form method="post">
            <div class="container">
            <h1>Register</h1>
            <p>Registration for getting different Comics every 5 minutes.</p>
            <hr>
            <input type="email" placeholder="Enter Email" name="email" id="email" required>
            <hr>
            <button type="submit" class="registerbtn" name="register">Register</button>
            </form>
        </div>

        <p id="snackbar">
            <?php if(!empty($message)) {
                echo $message;
             }
             ?>
        </p>

        <script>
            function myFunction() {
                // Get the snackbar DIV
                var x = document.getElementById("snackbar");
                if(x.textContent.length!=21){
                // Add the "show" class to DIV
                x.className = "show";

                // After 3 seconds, remove the show class from DIV
                setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
                }
            }
        </script>

    </body>
</html>
