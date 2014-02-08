<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');




//session_start();





        
        $agent = strtolower($_SERVER["HTTP_USER_AGENT"]);

        
        if (
                strpos($agent, "mobile") !== false
                || strpos($agent, "iphone") !== false
                || strpos($agent, "android") !== false
                || strpos($agent, "opeara mini") !== false
        ) {
            define('MOBILE',true);
        } else {
            define('MOBILE',false);
        }
        
//define('MOBILE',true);









global $login_conf_arr;
$login_conf_arr = array(
    "classic",
    "fb",
    "twitter"
);


$fb_file= FCPATH.APPPATH."third_party/facebook/src/facebook.php";

include_once $fb_file;


define('FB_APP_ID','1455858791304657');
define('FB_SECRET','fe25e175f8a022416c8a2926e98d6b36');
global $facebook;
$facebook = new Facebook(array(
    'appId' => FB_APP_ID,
    'secret' => FB_SECRET
));

$_REQUEST+=$_GET;









$twitter_file= FCPATH.APPPATH."third_party/twitter/twitteroauth/twitteroauth.php";
include_once $twitter_file;
 $twitter_file= FCPATH.APPPATH."third_party/twitter/config.php";
include_once $twitter_file; 













define('SESS_PREFIX',"lstr_");
define('PREFIX',"");
define('SITE', 'lister');



define('CACHEDIR',FCPATH.'cache/');


define('SALT','$%h#y5d5@3kg|b2G^d');


global $user;//array
$user=array();



























function sqlesc($x, $quote = true, $strip = true) {
    $x = mysql_real_escape_string($x);
    if ($strip)
        $x = strip_tags($x);

    if ($quote)
        $x = "'" . $x . "'";

    return $x;
}

function rand_sha1($length) {
    $max = ceil($length / 40);
    $random = '';
    for ($i = 0; $i < $max; $i ++) {
        $random .= sha1(microtime(true).mt_rand(10000,90000));
    }
    return substr($random, 0, $length);
}






/* End of file common.php */
?>