<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Popup_lib {


    private $value = null;

    public function __construct() {
    }

    public function Set() {
            $this->Data();
    }

    private function Data() {
        
        $CI = & get_instance();
        
        
        //echo "aaa";
        
$popup="";
                if(isset($_SESSION['popup'])){
                    //echo "xxx";
                    $num=$_SESSION['popup'];
                    unset($_SESSION['popup']);
                    //echo $num;
                    if($num==1){
                        $tekst1="Uspešno ste se registrovali.";
                        $tekst2="Aktivirajte nalog klikom na link koji smo poslali na vašu e-mail adresu.";
                    }elseif($num==2){
                        $tekst1="Uspešno ste aktivirali nalog.";
                        $tekst2="";
                    }elseif($num==3){
                        $tekst1="Zbog promene e-mail adrese potrebno je da aktivirate vaš nalog klikom na link koji smo poslali na vašu novu adresu.";
                        $tekst2="";
                    }elseif($num==4){
                        $tekst1="Došlo je do greške pri registraciji.";
                        $tekst2="";
                    }elseif($num==5){
                        $tekst1="Uspešno ste izmenili vaše podatke.";
                        $tekst2="";
                    }elseif($num==6){
                        $tekst1="Podaci profila nisu promenjeni.";
                        $tekst2="";
                    }elseif($num==7){
                        $tekst1="Uspešno ste se registrovali.";
                        $tekst2="";
                    }
                    
 
                     
     
                    
      
                    
                    
                    
                        
                        $popup='  
                            <div id="popup_normal">

                                <div id="popup_normal_text">
                                    '.$tekst1.'
                                </div>
                                <div id="popup_normal_text2">
                                    '.$tekst2.'
                                </div>
                                <div id="popup_normal_btn">
                                </div>
                            </div>
                            <script>
                                $(document).ready(function(){
                                    popup_show("account_message",1);
                                });
                            </script>
                        ';
                    
                       

   
                }
        
        
        
        $this->value =$popup;

    }

    public function Get() {
        $this->Set();
        return $this->value;
    }

}

?>
