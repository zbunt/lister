<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Head {

    //private $value;
    //private $filecache;
    private $value = null;

    public function __construct() {
        $CI = & get_instance();
    }

    public function Set($desc="",$title="") {
        $this->Data($desc,$title);
    }

    private function Data($desc="",$title="") {
        
        $con='
            
            <title>Control panel</title>
            <meta name="title" content="Control panel" />

            <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
            <meta content="dizajner:Goran Dragic, programer:Boban Djordjevic,Igor Savin" name="author">
            <meta content="Control panel" name="description">
            
            

            <!--********************************************************CSS********************************************************************-->
            <link href="'. base_url() .'css/admin.css" media="screen" type="text/css" rel="stylesheet">
            <link href="'. base_url() .'js/fancybox/jquery.fancybox.css" media="screen" type="text/css" rel="stylesheet">
            
            
                
            <!--******************************************************END CSS******************************************************************-->

            <!--*******************************************************FONTS*******************************************************************-->
            <link href="http://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,latin-ext" rel="stylesheet" type="text/css">
            <!--*****************************************************END FONTS*****************************************************************-->
            
            <!--*********************************************************JS********************************************************************-->
            
            <script src="'. base_url() .'js/jquery-1.9.1.min.js" type="text/JavaScript" language="JavaScript"></script>
            <script src="'. base_url() .'js/admin/script.js" type="text/JavaScript" language="JavaScript"></script>
            <!--<script src="'. base_url() .'js/admin/ckeditor/ckeditor.js" type="text/JavaScript" language="JavaScript"></script>-->
            <script src="'. base_url() .'js/fancybox/jquery.fancybox.js" type="text/JavaScript" language="JavaScript"></script>
            <script src="'. base_url() .'js/jquery.mousewheel-3.0.6.pack.js" type="text/JavaScript" language="JavaScript"></script>
                

            <script>
            $(document).ready(function() {
                $(".menuitem").click(function() {
                    $(this).next("ul").animate({
                        opacity: 1,
                        left: "+=50",
                        height: "toggle"
                    }, 1000, function() {
                        // Animation complete.
                    });
                });
            });

            </script>


                ';
        $con.='
            <!--*******************************************************END JS******************************************************************-->
        ';

        
                      
        
        
        $this->value =$con;

    }

    public function Get($desc="",$title="") {
        $this->Set($desc,$title);
        return $this->value;
    }

}

?>
