<?php
$idpass_err=false;
if(defined('STDIN')){
    if(isset($argv[1]) and isset($argv[2])){
        $id = $argv[1];
        $password = $argv[2];
    }
    else{
        $idpass_err=true;
        echo 'Enter id and password then try again.';
    }
} 
else{
    $id = $_GET['id'];
    $password = $_GET['password'];
}

if(isset($id) and isset($password))
{
    // only when the user knows the id and password this script will execute.
    // otherwise any other user will not be able to access this script.
    // this id and password will be private to the owner only.
    // for running the cron job : php -f email.php (id here) (password here)
    // for executing through web browser http://127.0.0.1:800/email.php?(id here)&(password here)
    if($id==='test' and $password==='password'){    // for testing purpose (id = 'test' and password = 'password')
        require_once __DIR__.'/config.php';
        require __DIR__.'/helperfuncs.php';
        $sql = 'SELECT * FROM users WHERE is_active=1';
        $result = $conn->query($sql);
        $emails = array();
        $hashes = array();
        while ($row = $result->fetch_assoc()) {
            array_push($emails,$row['email']);
            array_push($hashes,$row['hash']);
        }

        $link = getLink();
        $comic_id = getRandomComicId('https://c.xkcd.com/random/comic/');
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
        $release_date=date('Y-m-d',$release_date_ts);

        $date=date_create($release_date);
        $rel_date=date_format($date,'l, F jS, Y');

        for($i=0; $i<count($emails); $i++){ 
            try {		

                $mail->addAddress($emails[$i]);
                
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
                <h4>Hi '.$emails[$i].',</h4><br>
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
                <a href="'.$link.'/unsubscribe.php?email='.$emails[$i].'&token='.$hashes[$i].'" style="color:red">unsubscribe here.</a></div>
                </body>
                </html>
                
                ';

                $mail->Body = $message;
                $mail->send();
                $mail->clearAttachments();
                $mail->ClearAllRecipients();
                echo 'Mail has been sent successfully!';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }
    else{
        echo 'Access Denied';
    }
}
else{
    if(!$idpass_err){
        echo 'Access Denied';
    }
}
?>
