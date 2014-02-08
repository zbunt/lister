<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');








    function format_text($text = '', $strip_html = true) {
        $browser = $_SERVER['HTTP_USER_AGENT'];

        $s = $text;
        if ($strip_html)
            $s = strip_tags($s);


            $s = preg_replace("/\[video=[^\s'\"<>]*youtube.com.*v=(.{11}).*?\]/i", '<iframe title="YouTube video player" width="610" height="400" src="http://www.youtube.com/embed/\\1" frameborder="0" allowfullscreen></iframe>', $s);

        return $s;
    }















    function thumb_from_video_link($link = "", $hq = ""){
        
        $img = "";
        if (strpos($link, 'youtube')) {
            if (!preg_match("/.*?youtu.be\/(.{11}).*?/i", $link, $matches)){            
                preg_match("/.*?youtube.com.*?v=(.{11}).*?/i", $link, $matches);
            }
            if(isset($matches[1])){
                $img = format_ytpic_short($matches[1]);
            }
        } elseif (strpos($link, 'vimeo')) {
            $pos = strrpos($link, "/");
            $id = substr($link, $pos + 1);
            $url='http://vimeo.com/api/v2/video/'.$id.'.xml';
            $xml = simplexml_load_file($url);
            if (isset($xml->video->thumbnail_medium)){
                 $img = (string) $xml->video->thumbnail_medium;
            }
        }
        
        return $img;

    }
    
    
    
    function format_ytpic_short($sta, $hq = "hq") {
        $s = '.ytimg.com/vi/'. $sta .'/' . $hq . 'default.jpg';
        $url = 'http://i1' . $s;
        $s = $url;
        return $s;
    }
    
    

    function format_ytpic($text, $hq = "") {
        $s = $text;
        $s = preg_replace("/\[videosmallpic=[^\s'\"<>]*youtube.com.*v=([^\s'\"<>]+)\]/ims", '.ytimg.com/vi/\\1/' . $hq . 'default.jpg', $s);
        //http://i1

        $url = 'http://i1' . $s;

        $i = 0;
        $doit = true;
        while ($doit) {
            $i++;
            $url = 'http://i' . $i . $s;

            //if (fopen($url, "r"))
            $doit = false;

            if ($i > 10)
                break;

            $doit = false;
        }

        $s = $url;

        return $s;
    }

    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
    

/* End of file format_helper.php */
?>