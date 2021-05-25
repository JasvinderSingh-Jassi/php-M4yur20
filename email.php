
<?php
require_once __DIR__.'/config.php';
$sql = "SELECT * FROM users WHERE is_active=1";
$result = $conn->query($sql);
$emails = array();
$hashes = array();
while ($row = $result->fetch_assoc()) {
    array_push($emails,$row['email']);
    array_push($hashes,$row['hash']);
}

function getSiteOG( $url, $specificTags=0 ){
    $doc = new DOMDocument();
    @$doc->loadHTML(file_get_contents($url));
    $res['title'] = $doc->getElementsByTagName('title')->item(0)->nodeValue;

    foreach ($doc->getElementsByTagName('meta') as $m){
        $tag = $m->getAttribute('name') ?: $m->getAttribute('property');
        if(in_array($tag,['description','keywords']) || strpos($tag,'og:')===0) $res[str_replace('og:','',$tag)] = $m->getAttribute('content');
    }
    return $specificTags? array_intersect_key( $res, array_flip($specificTags) ) : $res;
}


$urldata = getSiteOG("https://c.xkcd.com/random/comic/");
$url = $urldata['url'];

$urlpath = parse_url($url);
$comic_id = str_replace('/', '', $urlpath['path']);

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

for($i=0; $i<count($emails); $i++){ 
    try {
        $mail->setFrom('mayuragarwalrtcampassignment@gmail.com', 'Mayur Agarwal');		

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
        <a href="https://'.$_SERVER['HTTP_HOST'].'/unsubscribe.php?email='.$emails[$i].'&token='.$hashes[$i].'" style="color:red">unsubscribe here.</a></div>
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