<?php
  
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
require_once 'config.php';
  
if (isset($_POST['register'])) {
    $message='';
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $sql = "SELECT * FROM users WHERE email='$email'";
      $result = $conn->query($sql);

      if ($result->num_rows >= 1) {
          $row = $result->fetch_assoc();
          if($row['is_active']=='1'){
              $message='Email is already registered and active for receiving comics.';
          }
          else{
              $hash = md5( rand(0,1000) );
              $sql = "UPDATE users SET hash = '$hash' WHERE email = '$email'";
              $result = $conn->query($sql);
              $mail = new PHPMailer(true); 
              $mail->isHTML(true);								
              $mail->Subject = 'Please verify your account!';
              try {
                  $mail->SMTPDebug = -1;									
                  $mail->isSMTP();											
                  $mail->Host	 = 'smtp.gmail.com;';					
                  $mail->SMTPAuth = true;							
                  $mail->Username = $from_email;				
                  $mail->Password = $email_pass;					
                  $mail->SMTPSecure = 'tls';							
                  $mail->Port	 = 587;
          
                  $mail->setFrom($from_email, 'Mayur Agarwal');	
          
                  $mail->addAddress($email);
                  
                  $emessage = '
                      
                  <html>
                  <head>
                    <meta name="viewport" content="width=device-width" />
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                    <style>
                      img {
                        border: none;
                        -ms-interpolation-mode: bicubic;
                        max-width: 100%; }
                      body {
                        background-color: #f6f6f6;
                        font-family: sans-serif;
                        -webkit-font-smoothing: antialiased;
                        font-size: 14px;
                        line-height: 1.4;
                        margin: 0;
                        padding: 0; 
                        -ms-text-size-adjust: 100%;
                        -webkit-text-size-adjust: 100%; }
                      table {
                        border-collapse: separate;
                        mso-table-lspace: 0pt;
                        mso-table-rspace: 0pt;
                        width: 100%; }
                        table td {
                          font-family: sans-serif;
                          font-size: 14px;
                          vertical-align: top; }
                      .body {
                        background-color: #f6f6f6;
                        width: 100%; }
                      .container {
                        display: block;
                        Margin: 0 auto !important;
                        max-width: 580px;
                        padding: 10px;
                        width: 580px; }
                      .content {
                        box-sizing: border-box;
                        display: block;
                        Margin: 0 auto;
                        max-width: 580px;
                        padding: 10px; }
                      .main {
                        background: #fff;
                        border-radius: 3px;
                        width: 100%; }
                      .wrapper {
                        box-sizing: border-box;
                        padding: 20px; }
                      .footer {
                        clear: both;
                        padding-top: 10px;
                        text-align: center;
                        width: 100%; }
                        .footer td,
                        .footer p,
                        .footer span,
                        .footer a {
                          color: #999999;
                          font-size: 12px;
                          text-align: center; }
                      h1,
                      h2,
                      h3,
                      h4 {
                        color: #000000;
                        font-family: sans-serif;
                        font-weight: 400;
                        line-height: 1.4;
                        margin: 0;
                        Margin-bottom: 30px; }
                      h1 {
                        font-size: 35px;
                        font-weight: 300;
                        text-align: center;
                        text-transform: capitalize; }
                      p,
                      ul,
                      ol {
                        font-family: sans-serif;
                        font-size: 14px;
                        font-weight: normal;
                        margin: 0;
                        Margin-bottom: 15px; }
                        p li,
                        ul li,
                        ol li {
                          list-style-position: inside;
                          margin-left: 5px; }
                      a {
                        color: #3498db;
                        text-decoration: underline; }
                      .btn {
                        box-sizing: border-box;
                        width: 100%; }
                        .btn > tbody > tr > td {
                          padding-bottom: 15px; }
                        .btn table {
                          width: auto; }
                        .btn table td {
                          background-color: #ffffff;
                          border-radius: 5px;
                          text-align: center; }
                        .btn a {
                          background-color: #ffffff;
                          border: solid 1px #3498db;
                          border-radius: 5px;
                          box-sizing: border-box;
                          color: #3498db;
                          cursor: pointer;
                          display: inline-block;
                          font-size: 14px;
                          font-weight: bold;
                          margin: 0;
                          padding: 12px 25px;
                          text-decoration: none;
                          text-transform: capitalize; }
                      .btn-primary table td {
                        background-color: #3498db; }
                      .btn-primary a {
                        background-color: #3498db;
                        border-color: #3498db;
                        color: #ffffff; }
                      .last {
                        margin-bottom: 0; }
                      .first {
                        margin-top: 0; }
                      .align-center {
                        text-align: center; }
                      .align-right {
                        text-align: right; }
                      .align-left {
                        text-align: left; }
                      .clear {
                        clear: both; }
                      .mt0 {
                        margin-top: 0; }
                      .mb0 {
                        margin-bottom: 0; }
                      .preheader {
                        color: transparent;
                        display: none;
                        height: 0;
                        max-height: 0;
                        max-width: 0;
                        opacity: 0;
                        overflow: hidden;
                        mso-hide: all;
                        visibility: hidden;
                        width: 0; }
                      .powered-by a {
                        text-decoration: none; }
                      hr {
                        border: 0;
                        border-bottom: 1px solid #f6f6f6;
                        Margin: 20px 0; }
                      @media only screen and (max-width: 620px) {
                        table[class=body] h1 {
                          font-size: 28px !important;
                          margin-bottom: 10px !important; }
                        table[class=body] p,
                        table[class=body] ul,
                        table[class=body] ol,
                        table[class=body] td,
                        table[class=body] span,
                        table[class=body] a {
                          font-size: 16px !important; }
                        table[class=body] .wrapper,
                        table[class=body] .article {
                          padding: 10px !important; }
                        table[class=body] .content {
                          padding: 0 !important; }
                        table[class=body] .container {
                          padding: 0 !important;
                          width: 100% !important; }
                        table[class=body] .main {
                          border-left-width: 0 !important;
                          border-radius: 0 !important;
                          border-right-width: 0 !important; }
                        table[class=body] .btn table {
                          width: 100% !important; }
                        table[class=body] .btn a {
                          width: 100% !important; }
                        table[class=body] .img-responsive {
                          height: auto !important;
                          max-width: 100% !important;
                          width: auto !important; }}
                      @media all {
                        .ExternalClass {
                          width: 100%; }
                        .ExternalClass,
                        .ExternalClass p,
                        .ExternalClass span,
                        .ExternalClass font,
                        .ExternalClass td,
                        .ExternalClass div {
                          line-height: 100%; }
                        .apple-link a {
                          color: inherit !important;
                          font-family: inherit !important;
                          font-size: inherit !important;
                          font-weight: inherit !important;
                          line-height: inherit !important;
                          text-decoration: none !important; } 
                        .btn-primary table td:hover {
                          background-color: #34495e !important; }
                        .btn-primary a:hover {
                          background-color: #34495e !important;
                          border-color: #34495e !important; } }
                    </style>
                  </head>
                  <body class="">
                    <table border="0" cellpadding="0" cellspacing="0" class="body">
                      <tr>
                        <td>&nbsp;</td>
                        <td class="container">
                          <div class="content">
                            <table class="main">
                              <tr>
                                <td class="wrapper">
                                  <table border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                      <td>
                                        <h1>Confirm your email</h1>
                                        <h2 align="center">You are just one step away</h2>
                                        <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                                          <tbody>
                                            <tr>
                                              <td align="center">
                                                <table border="0" cellpadding="0" cellspacing="0">
                                                  <tbody>
                                                    <tr>
                                                      <td> <a href="https://'.$_SERVER['HTTP_HOST'].'/emailverify.php?email='.$email.'&hash='.$hash.'" target="_blank">confirm email</a> </td>
                                                    </tr>
                                                  </tbody>
                                                </table>
                                              </td>
                                            </tr>
                                          </tbody>
                                        </table>
                                        <p>If you received this email by mistake, simply delete it. You will not be subscribed if you do not click the confirmation link above.</p>
                      
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                
                            </table>
                          </div>
                        </td>
                        <td>&nbsp;</td>
                      </tr>
                    </table>
                  </body>
                </html>

                  ';
          
                  $mail->Body = $emessage;
                  $mail->send();
                  $mail->clearAttachments();
                  $mail->ClearAllRecipients();
              } catch (Exception $e) {
                  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
              }
              $message = 'For receiving comics, please click on the link received on your email.';
          }
      } 

      else {
          $hash = md5( rand(0,1000) );
          $sql = "INSERT INTO users(`email`, `hash`) VALUES ('$email','$hash')";
          $result = $conn->query($sql);
          if($result){
            $mail = new PHPMailer(true); 
            $mail->isHTML(true);								
            $mail->Subject = 'Confirm your Email';
            try {
                $mail->SMTPDebug = -1;									
                $mail->isSMTP();											
                $mail->Host	 = 'smtp.gmail.com;';					
                $mail->SMTPAuth = true;							
                $mail->Username = $from_email;				
                $mail->Password = $email_pass;					
                $mail->SMTPSecure = 'tls';							
                $mail->Port	 = 587;
        
                $mail->setFrom($from_email, 'Mayur Agarwal');	
        
                $mail->addAddress($email);
                
                $emessage = '
                <html>
                  <head>
                    <meta name="viewport" content="width=device-width" />
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                    <style>
                      img {
                        border: none;
                        -ms-interpolation-mode: bicubic;
                        max-width: 100%; }
                      body {
                        background-color: #f6f6f6;
                        font-family: sans-serif;
                        -webkit-font-smoothing: antialiased;
                        font-size: 14px;
                        line-height: 1.4;
                        margin: 0;
                        padding: 0; 
                        -ms-text-size-adjust: 100%;
                        -webkit-text-size-adjust: 100%; }
                      table {
                        border-collapse: separate;
                        mso-table-lspace: 0pt;
                        mso-table-rspace: 0pt;
                        width: 100%; }
                        table td {
                          font-family: sans-serif;
                          font-size: 14px;
                          vertical-align: top; }
                      .body {
                        background-color: #f6f6f6;
                        width: 100%; }
                      .container {
                        display: block;
                        Margin: 0 auto !important;
                        max-width: 580px;
                        padding: 10px;
                        width: 580px; }
                      .content {
                        box-sizing: border-box;
                        display: block;
                        Margin: 0 auto;
                        max-width: 580px;
                        padding: 10px; }
                      .main {
                        background: #fff;
                        border-radius: 3px;
                        width: 100%; }
                      .wrapper {
                        box-sizing: border-box;
                        padding: 20px; }
                      .footer {
                        clear: both;
                        padding-top: 10px;
                        text-align: center;
                        width: 100%; }
                        .footer td,
                        .footer p,
                        .footer span,
                        .footer a {
                          color: #999999;
                          font-size: 12px;
                          text-align: center; }
                      h1,
                      h2,
                      h3,
                      h4 {
                        color: #000000;
                        font-family: sans-serif;
                        font-weight: 400;
                        line-height: 1.4;
                        margin: 0;
                        Margin-bottom: 30px; }
                      h1 {
                        font-size: 35px;
                        font-weight: 300;
                        text-align: center;
                        text-transform: capitalize; }
                      p,
                      ul,
                      ol {
                        font-family: sans-serif;
                        font-size: 14px;
                        font-weight: normal;
                        margin: 0;
                        Margin-bottom: 15px; }
                        p li,
                        ul li,
                        ol li {
                          list-style-position: inside;
                          margin-left: 5px; }
                      a {
                        color: #3498db;
                        text-decoration: underline; }
                      .btn {
                        box-sizing: border-box;
                        width: 100%; }
                        .btn > tbody > tr > td {
                          padding-bottom: 15px; }
                        .btn table {
                          width: auto; }
                        .btn table td {
                          background-color: #ffffff;
                          border-radius: 5px;
                          text-align: center; }
                        .btn a {
                          background-color: #ffffff;
                          border: solid 1px #3498db;
                          border-radius: 5px;
                          box-sizing: border-box;
                          color: #3498db;
                          cursor: pointer;
                          display: inline-block;
                          font-size: 14px;
                          font-weight: bold;
                          margin: 0;
                          padding: 12px 25px;
                          text-decoration: none;
                          text-transform: capitalize; }
                      .btn-primary table td {
                        background-color: #3498db; }
                      .btn-primary a {
                        background-color: #3498db;
                        border-color: #3498db;
                        color: #ffffff; }
                      .last {
                        margin-bottom: 0; }
                      .first {
                        margin-top: 0; }
                      .align-center {
                        text-align: center; }
                      .align-right {
                        text-align: right; }
                      .align-left {
                        text-align: left; }
                      .clear {
                        clear: both; }
                      .mt0 {
                        margin-top: 0; }
                      .mb0 {
                        margin-bottom: 0; }
                      .preheader {
                        color: transparent;
                        display: none;
                        height: 0;
                        max-height: 0;
                        max-width: 0;
                        opacity: 0;
                        overflow: hidden;
                        mso-hide: all;
                        visibility: hidden;
                        width: 0; }
                      .powered-by a {
                        text-decoration: none; }
                      hr {
                        border: 0;
                        border-bottom: 1px solid #f6f6f6;
                        Margin: 20px 0; }
                      @media only screen and (max-width: 620px) {
                        table[class=body] h1 {
                          font-size: 28px !important;
                          margin-bottom: 10px !important; }
                        table[class=body] p,
                        table[class=body] ul,
                        table[class=body] ol,
                        table[class=body] td,
                        table[class=body] span,
                        table[class=body] a {
                          font-size: 16px !important; }
                        table[class=body] .wrapper,
                        table[class=body] .article {
                          padding: 10px !important; }
                        table[class=body] .content {
                          padding: 0 !important; }
                        table[class=body] .container {
                          padding: 0 !important;
                          width: 100% !important; }
                        table[class=body] .main {
                          border-left-width: 0 !important;
                          border-radius: 0 !important;
                          border-right-width: 0 !important; }
                        table[class=body] .btn table {
                          width: 100% !important; }
                        table[class=body] .btn a {
                          width: 100% !important; }
                        table[class=body] .img-responsive {
                          height: auto !important;
                          max-width: 100% !important;
                          width: auto !important; }}
                      @media all {
                        .ExternalClass {
                          width: 100%; }
                        .ExternalClass,
                        .ExternalClass p,
                        .ExternalClass span,
                        .ExternalClass font,
                        .ExternalClass td,
                        .ExternalClass div {
                          line-height: 100%; }
                        .apple-link a {
                          color: inherit !important;
                          font-family: inherit !important;
                          font-size: inherit !important;
                          font-weight: inherit !important;
                          line-height: inherit !important;
                          text-decoration: none !important; } 
                        .btn-primary table td:hover {
                          background-color: #34495e !important; }
                        .btn-primary a:hover {
                          background-color: #34495e !important;
                          border-color: #34495e !important; } }
                    </style>
                  </head>
                  <body class="">
                    <table border="0" cellpadding="0" cellspacing="0" class="body">
                      <tr>
                        <td>&nbsp;</td>
                        <td class="container">
                          <div class="content">
                            <table class="main">
                              <tr>
                                <td class="wrapper">
                                  <table border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                      <td>
                                        <h1>Confirm your email</h1>
                                        <h2 align="center">You are just one step away</h2>
                                        <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                                          <tbody>
                                            <tr>
                                              <td align="center">
                                                <table border="0" cellpadding="0" cellspacing="0">
                                                  <tbody>
                                                    <tr>
                                                      <td> <a href="https://'.$_SERVER['HTTP_HOST'].'/emailverify.php?email='.$email.'&hash='.$hash.'" target="_blank">confirm email</a> </td>
                                                    </tr>
                                                  </tbody>
                                                </table>
                                              </td>
                                            </tr>
                                          </tbody>
                                        </table>
                                        <p>If you received this email by mistake, simply delete it. You will not be subscribed if you do not click the confirmation link above.</p>
                      
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                
                            </table>
                          </div>
                        </td>
                        <td>&nbsp;</td>
                      </tr>
                    </table>
                  </body>
                </html>
                ';
        
                $mail->Body = $emessage;
                $mail->send();
                $mail->clearAttachments();
                $mail->ClearAllRecipients();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            $message='Thank you for registering, please click on the link received on your email for verification.';
          }
          else{
            $message='SQL Error!';
          }
      }
    }
    else{
      $message='Please enter a valid email';
    }
  }
?>
<html>
    <head>
        <title>Registartion Form</title>
        <link rel="stylesheet" href="style.css">
        
    </head>
    <body onload="errormessage()">
        <div class="container">
            <form method="post">
            <div class="container">
            <h1>Register</h1>
            <p>Registration for getting different comics every 5 minutes.</p>
            <hr>
            <input type="email" placeholder="Enter Email" name="email" id="email" required>
            <hr>
            <button type="submit" class="registerbtn" name="register">Register</button>
            </form>
        </div>

        <div id="snackbar">
            <?php if(!empty($message)) {
                echo $message;
             }
             ?>
        </div>

        <script>
            function errormessage() {
                // Get the snackbar DIV
                var x = document.getElementById("snackbar");
                if(x.textContent.length!=21){
                // Add the "show" class to DIV
                x.className = "show";

                // After 3 seconds, remove the show class from DIV
                setTimeout(function(){ x.className = x.className.replace("show", "") }, 5000);
                }
            }
        </script>

    </body>
</html>
