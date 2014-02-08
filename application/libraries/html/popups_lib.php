<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Popups_lib {

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

        $con="";
        
        $CI = & get_instance();
 
                global $user;
		if ($CI->account_model->logged_in())
		{	
  
                    
                    
                    
                    /*
                         $add_picture_popup = '
                            <div id="add_picture_popup" class="login-form popup">
                                <div id="message_popup_title">Dodaj sliku</div>
                                <div id="message_popup_message"></div>
                                
                                <div id="add_picture_popup_message_error" class="popup_message_error"></div>

                                <form id="form_picture" method="post" >
                                    <div class="form-group">
                                      <input type="text" class="form-control login-field" value="" placeholder="Title" id="name" name="name">
                                      <!--<label class="login-field-icon fui-user" for="login-name"></label>-->
                                    </div>

                                    <div class="form-group">
                                      <textarea type="text" class="form-control login-field" value="" placeholder="text" id="text" name="text"></textarea>
                                      <!--<label class="login-field-icon fui-user" for="login-name"></label>-->
                                    </div>

                                    <div class="form-group">
                                      <input type="file" class="form-control" value="" placeholder="Browse" id="file" name="file">
                                      <!--<label class="login-field-icon fui-user" for="login-name"></label>-->
                                    </div>
                                </form>

                                <button class="btn btn-info btn-lg btn-block" onClick="picture_submit();">Submit</button>
                                

                            </div>
                        ';
                         $con.=$add_picture_popup; 
                    
                    
                         
                         $add_video_popup = '
                            <div id="add_video_popup" class="login-form popup">
                                <div id="message_popup_title">Dodaj sliku</div>
                                <div id="message_popup_message"></div>
                                
                                <div id="add_video_popup_message_error" class="popup_message_error"></div>

                                <form id="form_video" method="post" >
                                    <div class="form-group">
                                      <input type="text" class="form-control login-field" value="" placeholder="Title" id="name" name="name">
                                      <!--<label class="login-field-icon fui-user" for="login-name"></label>-->
                                    </div>
                                    <div class="form-group">
                                      <textarea type="text" class="form-control login-field" value="" placeholder="text" id="text" name="text"></textarea>
                                      <!--<label class="login-field-icon fui-user" for="login-name"></label>-->
                                    </div>
                                    <div class="form-group">
                                      <input type="text" class="form-control login-field" value="" placeholder="Video link" id="item" name="item">
                                      <!--<label class="login-field-icon fui-user" for="login-name"></label>-->
                                    </div>


                                </form>

                                <button class="btn btn-info btn-lg btn-block" onClick="video_submit();">Submit</button>
                                

                            </div>
                        ';
                         $con.=$add_video_popup; 
                         
                         */
                         
                         
                         
                         
                         
                         
                         
                         
                         
                    
                    
                    
                    
                    
                    
		}else{//not logged_in
                    
                    
                    
                    global $facebook; 

                    $fb_login_url = $facebook->getLoginUrl(array(
                        'scope'=>'email,user_birthday,user_location',
                        'redirect_uri' => base_url()."account/fb_redirect_url"//current_url()
                    ));
                    
                    
                    $login_popup = '

                        <div id="login_popup" class="login-form popup">
                            <div class="popup_title">Login</div>
                            <div id="login_popup_message_error" class="popup_message_error"></div>
                            <div class="popup_title_small">Connect with a social network</div>

                            <a href="' . $fb_login_url . '">
                            <div id="login_btn_fb" class="login_btn">
                            </div>
                            </a>
                            <div id="login_btn_tw" class="login_btn">
                            </div>
                            <div id="login_btn_gp" class="login_btn">
                            </div>
                            <div class="popup_title_small">Or</div>
                            
                            <div class="form-group">
                              <input type="text" class="form-control login-field" value="" placeholder="Email address" id="email" name="email">
                              <!--<label class="login-field-icon fui-user" for="login-name"></label>-->
                            </div>
                            <div class="form-group">
                              <input type="password" class="form-control login-field" value="" placeholder="Password" id="password" name="password">
                              <!--<label class="login-field-icon fui-lock" for="login-pass"></label>-->
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id="remember_me" name="remember_me" value="1">Remember me
                            </div>
                            
                            <button class="btn btn-primary btn-lg btn-block" onClick="login();">Login</button>
                            <a class="login-link" href="#">Lost your password?</a>
                        </div>

                        ';
                          $con.=$login_popup;   
                          
                          
                          
                          
                    $register_popup = '

                        <div id="register_popup" class="login-form popup">
                            <div class="popup_title">Hey there!</div>
                            <div class="popup_title_small">Connect with a social network</div>
                            <a href="' . $fb_login_url . '">
                            <div id="login_btn_fb" class="login_btn">
                            </div>
                            </a>
                            <div id="login_btn_tw" class="login_btn">
                            </div>
                            <div id="login_btn_gp" class="login_btn">
                            </div>

                            <div class="popup_title_small">Or</div>
                            <button class="btn btn-default btn-block" onClick="javascript:show_popup(\'#signup_popup\');">Sign up with your Email Address</button>
                            <a class="btn btn-primary btn-lg btn-block" href="javascript:show_popup(\'#login_popup\');">Have an account? Login</a>

                        </div>

                        ';
                          $con.=$register_popup;  
                          
                          
                          
                    $signup_popup = '

                        <div id="signup_popup" class="login-form popup">
                            <div class="popup_title">Become a member</div>
                            <div id="signup_popup_message_error" class="popup_message_error"></div>

                            <div class="form-group">
                              <input type="text" class="form-control login-field" value="" placeholder="Full name" id="name" name="name">
                            </div>
                            <div class="form-group">
                              <input type="text" class="form-control login-field" value="" placeholder="Email Address" id="email_signup" name="email">
                            </div>
                            <div class="form-group">
                              <input type="password" class="form-control login-field" value="" placeholder="Password" id="password_signup" name="password">
                            </div>
                            <div class="form-group">
                              <input type="password" class="form-control login-field" value="" placeholder="Password again" id="password_signup2" name="password2">
                            </div>
                            
                            <button class="btn btn-warning btn-lg btn-block" onClick="signup();">Sign up</button>
                        </div>

                        ';
                          $con.=$signup_popup; 
                          
                          
                          
                          
                          
                          
                          
                          
                    $message_popup = '
                        <div id="message_popup" class="login-form popup">
                            <div id="message_popup_title"></div>
                            <div id="message_popup_message"></div>
                            <button class="btn btn-info btn-lg btn-block" onClick="hide_popup(\'#message_popup\');">Close</button>
                        </div>
                        ';
                         $con.=$message_popup; 
                      
                         

                         
                         
                         
                         
                         
                         
                         
      
                }
        
        
                
                
                if(isset($_SESSION['popup'])){
                    switch ($_SESSION['popup']) {
                        case "signup success":
                            $title="Successfully";
                            $message="Check your email and confirm your account!";
                            break;
                        case "confirmation_success":
                            $title="Successfully";
                            $message="You have successfully confirmed your email. Now, you can Login!";
                            break;
                        case "confirmation_error":
                            $title="Error";
                            $message="Error with email confirmation!";
                            break;
                        
                        
                        default:
                            break;
                    }
                    echo 
                    $con.='
                            <script>
                                $(document).ready(function(){
                                    $("#message_popup_title").html("'.$title.'");
                                    $("#message_popup_message").html("'.$message.'");
                                    show_popup("#message_popup");
                                });    
                            </script>
                        ';
                    unset($_SESSION['popup']);
 
                }
        
        
        
        
        
        
        
        $this->value=$con;
        
        
        
        
        

    }

    public function Get() {
        $this->Set();
        return $this->value;
    }

}

?>
