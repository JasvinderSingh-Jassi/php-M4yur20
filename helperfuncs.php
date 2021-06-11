<?php

    function getRandomComicId($url, $specificTags=0){
        $doc = new DOMDocument();
        @$doc->loadHTML(file_get_contents($url));
        $res['title'] = $doc->getElementsByTagName('title')->item(0)->nodeValue;
        foreach ($doc->getElementsByTagName('meta') as $m){
            $tag = $m->getAttribute('name') ?: $m->getAttribute('property');
            if(in_array($tag,['description','keywords']) || strpos($tag,'og:')===0) $res[str_replace('og:','',$tag)] = $m->getAttribute('content');
        }

        $urldata = $specificTags? array_intersect_key( $res, array_flip($specificTags) ) : $res;
        $url = $urldata['url'];
        $urlpath = parse_url($url);
        $comic_id = str_replace('/', '', $urlpath['path']);
        return $comic_id;
    }

    function getLink(){
        if(isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
            $protocol = 'https';
        }
        else{
            $protocol = 'http';
        }

        // for cron
        if(!isset($_SERVER['HTTP_HOST'])){
            if(isset($_SERVER['PORT'])){
                $link = 'https://calm-journey-40539.herokuapp.com';             // for executing : heroku run -a calm-journey-40539 php email.php
            }
            else{
                $link = 'http://127.0.0.1:8000';                                // for locally executing : php email.php
            }
        }
        else{
            $link = $protocol.'://'.$_SERVER['HTTP_HOST'];
        }
        return $link;
    }

?>