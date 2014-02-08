<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Head_lib {

    //private $value;
    //private $filecache;
    private $value = null;

    public function __construct() {
        $CI = & get_instance();
        //$CI->load->model('common_model');
    }

    public function Set() {
        //$this->Data($desc,$title,$section_id,$id,$type);
        
        
        /*
		global $memcache;
                $key=strtolower(get_class($this).$desc.$title.$section_id.$id.$type.$brending);
                $cache=$memcache->get($key);
                if(!$cache){
                    $this->Data($desc,$title,$section_id,$id,$type,$brending);
                    $data = $this->value;
                    $memcache->set($key,$data,false,100);
                }else{
                    $this->value = $cache;
                }
                */
        
        
        $this->Data();
                
                
                
        
    }

    private function Data() {

        $CI = & get_instance();

        $fb_img="";
        
        
    
$title="LISTER";
$desc="desc";
$keyw="keyw";


$css = "desktop";
$js="desktop";
/*
if(MOBILE){
    $css = "mobile";
    $js="mobile";
}
*/

        $con='
            

<title>'. $title .'</title>


<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<meta content="'. $desc .'" name="description">
<meta content="'. $keyw .'" name="keywords">


        
        
        
        <meta name="robots" content="noimageindex, nosnippet">

    
<meta content="'. $title .'" property="og:title">

<meta content="article" property="og:type">

<meta content="'.current_url() . '" property="og:url">

<meta content="'.$fb_img.'" property="og:image">
    
<meta content="Smedia" property="og:site_name">

<meta content="'. $desc .'" property="og:description">
    
<meta content="1455858791304657" property="fb:app_id">




            <!--********************************************************CSS********************************************************************-->

            
            

                <link href="'. base_url() .'css/style.css?i=121" rel="stylesheet" type="text/css">
                <link href="'. base_url() .'css/'.$css.'.css?i=121" rel="stylesheet" type="text/css">

            <!--******************************************************END CSS******************************************************************-->

            <!--*******************************************************FONTS*******************************************************************-->
            <link href="http://fonts.googleapis.com/css?family=Open+Sans:700italic,400,300,700&subset=latin,latin-ext" rel="stylesheet" type="text/css">
            <link href="http://fonts.googleapis.com/css?family=Roboto:400,300&subset=latin,latin-ext" rel="stylesheet" type="text/css">
            <!--*****************************************************END FONTS*****************************************************************-->
            
            <!--*********************************************************JS********************************************************************-->
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
            
                <script src="'. base_url() .'js/script.js?v=131" type="text/JavaScript" language="JavaScript"></script>
                <script src="'. base_url() .'js/'.$js.'.js?v=131" type="text/JavaScript" language="JavaScript"></script>
            
                <script language="JavaScript" type="text/JavaScript" src="'. base_url().'js/jquery.isotope.min.js"></script> 
                ';

            
        $con.='   
            <!--*******************************************************END JS******************************************************************-->
        ';

        
        


        $con.='
            <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
            <script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
        ';
        
  
        



        $this->value =$con;

    }

    public function Get() {
        $this->Set();
        return $this->value;
    }

}

?>
