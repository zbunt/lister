<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login_form_lib {


    private $value = null;

    public function __construct() {
    }

    public function Set() {
            $this->Data();
    }

    private function Data() {
        
        $CI = & get_instance();
        

			$con='

					
					<div id="form_login_holder">
						<form id="form_login" name="form_login" >
                                                    <!--<div id="form_login_user">-->
                                                            <input type="text" id="username" name="username" value="" size="28"/>
                                                    <!--</div>

                                                    <div id="form_login_pass">-->
                                                            <input type="password" id="password" name="password" value="" size="28"/>
                                                    <!--</div>-->

                                                    <div id="form_login_remember_me">
                                                            <input type="checkbox" id="remember_me" name="remember_me" value="1">Remember me
                                                    </div>


                                                    <div id="form_login_btn"   onClick="validate_login();" >
                                                        PRIJAVI SE
                                                    </div>
						</form>
					</div>
 
                ';
               	 
                        
        global $facebook; 
        
        $fb_login_url = $facebook->getLoginUrl(array(
        'scope'=>'email,user_about_me,user_likes,user_photos,friends_likes,friends_photos,read_stream,read_friendlists,user_birthday,user_location',
        'redirect_uri' => base_url()."account/fb_redirect_url"//current_url()
        ));
        
        //$fb_login_url = $facebook->getLoginUrl();
        
        $con.='
            <div id="fb_button_holder">

<a href="' . $fb_login_url . '"><img src="'.base_url().'img_new/account/fb_button.png" alt="Login in app by facebook"/></a>
    
</div>'; 

        
        

        /* Build an image link to start the redirect process. */
        $con.= '
            <div id="twitter_button_holder">
<a href="'.base_url().'account/twitter_redirect"><img src="'.base_url().'img_new/account/twitter_button.png" alt="Sign in with Twitter"/></a>
    
</div>'; 

        
        
        
        
        
        
        $con.='
            

<div id="twitter_button_holder">'
        
        
        .anchor('account/register','Registruj se!').'
        
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
