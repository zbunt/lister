<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profile_lib {


    private $value = null;

    public function __construct() {
    }

    public function Set() {
            $this->Data();
    }

    private function Data() {
        
        $CI = & get_instance();
        
        global $user;

        if ($CI->account_model->logged_in())
        {
                      
                           
            $ext=$user['ext'];
            $img=$user['img'];
            $folder = substr($img, -2); 

            if($img!=""){
            $image_pom=  base_url()."/uploads/users/".$folder."/".$img.".".$ext;
            }else{
            $image_pom=  base_url()."img/account/no_image.jpg";
            }

            $first_name=$user['first_name'];
            $last_name=$user['last_name'];


            
            

            $value='

                <div id="glavni_menu_plus">

                    <ul id="navigacija_plus">

                        <li>
                            <div id="logo_plus" >
                                <a href="'. site_url().'proba" title="Smedia plus"><img src="'. base_url().'img/account/logo_plus.png" /></a>
                            </div>
                        </li>

                        <li>
                            <div id="profill_header" >
                                <img src="'.$image_pom.'" style="width:31px;height:31px;" />
                                <div id="profill_header_title" >
                                    <a href="javascript:togle_selector(\'#profill_header_items\');" >profil</a>
                                </div>
                                <div id="profill_header_arrow" >
                                    <a href="javascript:togle_selector(\'#profill_header_items\');" title="Smedia plus"><img src="'. base_url().'img/account/arrow_down.png" /></a>
                                </div>

                                <div id="profill_header_items">
                                    <div class="profill_header_item">
                                        <img src="'. base_url().'img/account/izmeni_prof.png"  />
                                        <div class="profill_header_item_title" >
                                            <a href="'.base_url().'account/edit" >Izmeni profil</a>
                                        </div>
                                    </div>
                                    <div class="profill_header_item">
                                        <img src="'. base_url().'img/account/logout.png"  />
                                        <div class="profill_header_item_title" >
                                            <a href="'. base_url().'/account/logout" >Logout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                    </ul>

                </div>

            ';
                  
                                                
        }else{//not logedin
              
            $value='
                <div id="form_login_holder">
                    <form id="form_login" name="form_login"  >
                        <input type="text" id="username" name="username" value="" size="28" class="defText" title="Korisničko ime" rel="login" autocomplete="off" />
                        <input type="password" id="password" name="password" value="" size="28"  class="defText" title="Lozinka"  rel="login" autocomplete="off" />
                        <div id="form_login_remember_me">
                            <input type="checkbox" id="remember_me" name="remember_me" value="1">Zapamti me
                        </div>
                        <div id="form_login_btn"  onClick="validate_login();" >Prijavi se</div>
                    </form>
                </div>
            ';


            global $facebook; 
        /*
            $fb_login_url = $facebook->getLoginUrl(array(
            'scope'=>'email,user_about_me,user_likes,user_photos,friends_likes,friends_photos,read_stream,read_friendlists,user_birthday,user_location',
            'redirect_uri' => base_url()."account/fb_redirect_url"//current_url()
            ));
        */
            $fb_login_url = $facebook->getLoginUrl(array(
                'scope'=>'email,user_birthday,user_location',
                'redirect_uri' => base_url()."account/fb_redirect_url"//current_url()
            ));
                                                    
                                                    
            $value.='
                <div id="fb_button_holder">
                    <a href="' . $fb_login_url . '"><img src="'.base_url().'img/account/fb_button.png" alt="Login in app by facebook"/></a>
                </div>
            '; 

            
            /* Build an image link to start the redirect process. */
            $value.= '
                <div id="twitter_button_holder">
                    <a href="'.base_url().'account/twitter_redirect"><img src="'.base_url().'img/account/twitter_button.png" alt="Sign in with Twitter"/></a>
                </div>
            '; 


            $value.='
                <div id="registrujse_holder">
                    <!--<div id="registrujse_title1">
                        Nemate nalog?
                    </div>-->
                    <div id="registrujse_title2">'
                        .anchor('account/register_homepage','Registrujte se').'
                    </div>
                </div> 
            ';
  
       }//end if loged in
                       
                       
       $con="";

        $con.='
            <div id="profile_bar" >
                <div id="profile_bar_inner" >
                    '.$value.'
                </div>
                <div class="mainClear"></div>
            </div>
        ';
        
        $this->value =$con;
    }

    public function Get() {
        $this->Set();
        return $this->value;
    }

}

?>
