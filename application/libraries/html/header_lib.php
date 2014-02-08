<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Header_lib {


    protected $_menu = NULL;

    public function __construct() {

    }

    public function show_header() {
        
            $CI = & get_instance();
            echo base_url();
            $logo='
                <div id="logo" onClick="window.location = \''.base_url().'\'">

                </div> 
            ';
        
        
        
        
        
        
        global $user;

        if ($CI->account_model->logged_in())
        {
            
            $ext=$user['ext'];
            $img=$user['img'];
            $folder = substr($img, -2); 

            if($img!=""){
                $image_pom=  base_url()."uploads/users/".$folder."/".$img.".".$ext;
            }else{
                $image_pom=  base_url()."img/account/no_image.jpg";
            }

            $first_name=$user['first_name'];
            $last_name=$user['last_name'];

            $value='

                <div id="profile_menu_holder">

                    <ul id="profile_menu_ul">
                        <li class="profile_menu_item">
                            <div id="profile_img" >
                                <img src="'.$image_pom.'" style="width:31px;height:31px;" />
                            </div>
                        </li>
                        <li class="profile_menu_item">
                            <div id="profile_izmeni" >
                                <!--<a href="'.base_url().'account/edit" >Izmeni profil</a>-->
                                '.$first_name.' '.$last_name.'
                            </div>
                        </li>  
                        <li class="profile_menu_item">
                            <div id="profile_logout" >
                                <a href="'. base_url().'account/logout" >Logout</a>
                            </div>
                        </li>  

                    </ul>

                </div>

            ';
                  
                                                
        }else{//not logedin
              
            
            $value="";
            

            
            $value.='
                <div class="link_holder" onClick="show_popup(\'#register_popup\');" style="background-color:#74e3ba;">
                        Register
                </div> 
                <div class="link_holder" onClick="show_popup(\'#login_popup\');">
                    LogIn
                </div> 
                
            ';
            
 
            
       }//end if loged in
                       
                       
       $con="";

        $con.='
            <div id="profile_bar" >
                <div id="profile_bar_inner" >
                    '.$logo.'
                    '.$value.'
                </div>
                <div class="mainClear"></div>
            </div>
        ';
        
        return $con;
    }



}

?>
