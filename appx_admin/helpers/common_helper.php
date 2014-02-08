<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

session_start();

define('PICROOT', realpath(FCPATH.'img/profiles/').'/');

define('PICURL', base_url().'img/profiles/');

define('CACHEDIR', FCPATH.'cache/');

define('SALT','$%h#y5d5@3tg|b2G^d');

define('COOKIE_PREFIX','scrv_');

global $allowed_pic_ext;
$allowed_pic_ext = array('jpg','png','gif','jpeg');


global $admins;
$admins['id']=0;





define('WALL_REACTIONS',false);

define('WALL_STATUS_LIKES',false);



function create_thumb($image_url,$width,$height){
    
    if($width==0 || $height==0){
        die("create_thumb width==0 || height==0");
    }
    if(!file_exists($image_url)){
            die("create_thumb file_not_exists");
    }

    if(is_dir($image_url)){
        die("create_thumb is_dir");
    }    

    $CI = & get_instance();
                 
    $pos_dot_last= strrpos($image_url,".");
    $pos_slash_last= strrpos($image_url,"/");
    $dir=substr($image_url, 0,$pos_slash_last+1);
    $img_name=substr($image_url, $pos_slash_last+1,$pos_dot_last-$pos_slash_last-1);
    $img_ext=substr($image_url, $pos_dot_last+1);
                        
    $dir_new=$dir."thumbs/";

    if(!is_dir($dir_new)){
        if(!mkdir($dir_new , 0777))
        {
           echo "Failed to create directory...".$dir_new;
        } 
    }
                                                       
    $new_path=$dir_new.$img_name.'_'.$width.'x'.$height.'.'.$img_ext;
    if (file_exists($new_path)){
        return TRUE;
    }
               
    $arr=getimagesize($image_url);
    $koef=$width/$height;
    if($arr[1]*$koef>$arr[0]){
            $config2['width'] = $width;
            $config2['height'] = 720;	
    }else{
            $config2['width'] = 720;
            $config2['height'] =$height;
    }

    $config2['image_library'] = 'gd2';
    $config2['source_image'] = $image_url;
    $config2['create_thumb'] = TRUE;
    $config2['maintain_ratio'] = TRUE;
    $config2['thumb_marker']='';
    $config2['new_image'] = $new_path;

    $CI->load->library('image_lib');

    $CI->image_lib->initialize($config2);

    if (!$CI->image_lib->resize())
    {

            return FALSE;
    }else{
            $CI->image_lib->clear();				

            $arr=getimagesize($new_path);
            $x_axis=round(($arr[0]-$width)/2, 0);
            $y_axis=round(($arr[1]-$height)/2, 0);


            $config2['image_library'] = 'gd2';
            $config2['source_image'] = $new_path;
            $config2['create_thumb'] = FALSE;
            $config2['maintain_ratio'] = FALSE;
            $config2['width'] = $width;
            $config2['height'] = $height;
            $config2['thumb_marker']='';

            $config2['x_axis'] = $x_axis;
            $config2['y_axis'] = $y_axis;

            $CI->image_lib->initialize($config2);

            if (!$CI->image_lib->crop())
            {

                    return FALSE;
            }
    }

    $CI->image_lib->clear();
    return TRUE;
}

function get_thumb($image_url="",$width=0,$height=0){

    if($width==0 || $height==0){
        die("get_thumb width==0 || height==0");
    }
    
    if(!file_exists($image_url)){
            die("get_thumb file_not_exists");
    }

    if(is_dir($image_url)){
        if(!create_thumb("uploads/no_image.jpg",$width,$height))
        {
            die("eror resize image");
        }
        $image='uploads/thumbs/'."no_image".'_'.$width.'x'.$height.'.'."jpg";
        return $image;
    }
    

    $pos_dot_last= strrpos($image_url,".");
    $pos_slash_last= strrpos($image_url,"/");
    $dir=substr($image_url, 0,$pos_slash_last+1);
    $img_name=substr($image_url, $pos_slash_last+1,$pos_dot_last-$pos_slash_last-1);
    $img_ext=substr($image_url, $pos_dot_last+1);
    
    
    if(!create_thumb($image_url,$width,$height))
    {
        die("eror resize image");
    }
    $image=$dir.'thumbs/'.$img_name.'_'.$width.'x'.$height.'.'.$img_ext;

    return $image;

}










function sqlesc($x, $quote = true, $strip = true) {
    $x = mysql_real_escape_string($x);
    if ($strip)
        $x = strip_tags($x);

    if ($quote)
        $x = "'" . $x . "'";

    return $x;
}

function get_reaction_from_value($value) {
    
   
    $value+=0;
    $con="";
    switch ($value) {
    case 1:
        $con= "Hot";
        break;
    case 2:
        $con= "Sexy";
        break;
    case 3:
        $con= "Beautiful";
        break;
    case 4:
        $con= "Nice";
        break;
    case 5:
        $con= "Wow";
        break;
    case 6:
        $con= "Charming";
        break;
    case 7:
        $con= "Comical";
        break;
    case 8:
        $con= "Cool";
        break;
    case 9:
        $con= "Sweet";
        break;
    case 10:
        $con= "Sensual";
        break;

}

    return $con;
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