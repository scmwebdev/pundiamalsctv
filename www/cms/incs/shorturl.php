<?php

    function bitly_url($url, $format='json', $version='2.0.1'){

        $login = "liputan6"; //username login bit.ly
        $appkey = "R_2ed178bfc2323a0b20a2fb5051b8a5aa"; //API key

        //create the URL
        $bitly = 'http://api.bit.ly/shorten?version='.$version.'&longUrl='.urlencode($url). '&login='.$login.'&apiKey='.$appkey.'&format='.$format;

        //could also use cURL here
        $response = file_get_contents($bitly);

        //parse depending on desired format
        if(strtolower($format) == 'json') {
            $json = @json_decode($response,true);
            return $json['results'][$url]['shortUrl'];
        } else { //xml
            $xml = simplexml_load_string($response);
            return 'http://bit.ly/'.$xml->results->nodeKeyVal->hash;
        }

    }

    function tiny_url($url){
        return file_get_contents('http://tinyurl.com/api-create.php?url='.$url);
    }

    function lp6co_url($url){
        return file_get_contents('http://lp6.co/api.php?signature=895019037b&format=simple&action=shorturl&url='.urlencode($url));
    }