
<?php
require_once 'config.php';

$sql = "SELECT * FROM users WHERE is_active=1";
$result = $conn->query($sql);
$emails = array();

while ($row = $result->fetch_assoc()) {
    array_push($emails,$row['email']);
}

$comic_id=rand(1,2462);
$api_url = 'https://xkcd.com/'.$comic_id.'/info.0.json';

// GET Request
$json_data = file_get_contents($api_url);

// Decode JSON data into PHP array
$comic_data = json_decode($json_data);

$comic_body = str_replace(array( '(', ')', '[[', ']]', '{{', '}}', 'alt', '"..."', '...' ), '', $comic_data->transcript);							
$mail->Subject = 'Your Comic ['.$comic_data->safe_title.'] is here!';
$month = $comic_data->month;
$day = $comic_data->day;
$year = $comic_data->year;

$release_date_ts=strtotime("$year-$month-$day");
$release_date=date("Y-m-d",$release_date_ts);

$date=date_create($release_date);
$rel_date=date_format($date,"l, F jS, Y");
if(!$_SERVER['HTTP_HOST']){
    $_SERVER['HTTP_HOST'] = 'calm-journey-40539.herokuapp.com';
}


foreach($emails as $email){ 
    try {
        $mail->setFrom('mayuragarwalrtcampassignment@gmail.com', 'Mayur Agarwal');		

        $mail->addAddress($email);
        
        $message = '

        <html>
        <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
            .container {
            width: 500px;
            margin: 10px;
            border: 1px solid #fff;
            background-color: #ffffff;
            box-shadow: 0px 2px 7px #292929;
            -moz-box-shadow: 0px 2px 7px #292929;
            -webkit-box-shadow: 0px 2px 7px #292929;
            border-radius: 10px;
            -moz-border-radius: 10px;
            -webkit-border-radius: 10px;
        }
        .mainbody,
        .header,
        .footer {
            padding: 5px;
        }
        .mainbody {
            margin-top: 5px;
        }
        .header {
            text-align:center;
            min-height: 40px;
            height: auto;
            width: 100%;
            resize: both;
            overflow: auto;
            background-color: whiteSmoke;
            border-bottom: 1px solid #DDD;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
        }
        .footer {
            height: 40px;
            background-color: whiteSmoke;
            border-top: 1px solid #DDD;
            -webkit-border-bottom-left-radius: 5px;
            -webkit-border-bottom-right-radius: 5px;
            -moz-border-radius-bottomleft: 5px;
            -moz-border-radius-bottomright: 5px;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
        }
        </style>
        </head>
        <body>
        <h4>Hi '.$email.',</h4><br>
        <div class="container">
        <div class="header">
        <span style="position:relative;top:4px;font-size: 25px;"><strong>'.$comic_data->safe_title.'<strong></span>
        </div>
        <div class="mainbody" style="margin-top:5px;margin-left: 7px;">
            <img src='.$comic_data->img.' style="height:400px;width:96%;">
            <p>'.$comic_body.'</p>
        </div>
        <div class="footer">
            <h3>This Comic was released on '.$rel_date.'</h3>
        </div>
        </div>
        <div style="margin-left:13px;">If you would prefer not to receive comics in future from us
        <a href="https://'.$_SERVER['HTTP_HOST'].'/unsubscribe.php?email='.$email.'" style="color:red">unsubscribe here.</a></div>
        </body>
        </html>
        
        ';

        $mail->Body = $message;
        $mail->send();
        $mail->clearAttachments();
        $mail->ClearAllRecipients();
        echo "Mail has been sent successfully!";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

?>