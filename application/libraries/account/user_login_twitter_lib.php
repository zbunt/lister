<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


require_once( 'user_login_abstract_lib.php' );
class User_login_twitter_lib extends User_login_abstract_lib {

    
    public function __construct() { 
    }

    public function login() {

        $CI = & get_instance();

            if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {

            }else{
          
                $access_token = $_SESSION['access_token'];
                $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
                $content = $connection->get('account/verify_credentials');
                
                $twitter_user_id=0;
                if(isset($content->id_str)){
                    $twitter_user_id=$content->id_str;
                    $twitter_user_id=sqlesc($twitter_user_id,false);
                }else{
                    
                }
                
                if($twitter_user_id){

                    $row = $CI->account_model->get_user_twitter($twitter_user_id);
                    if ($row) {
                        $this->_user=$row;
                        $this->_logged_in=TRUE;
                    }else{//kreiramo useera preko twitter-a
                        $this->_logged_in=TRUE;
                    }

                }
 
            }      
       
    }
    
    public function create_user() {
        
        $CI = & get_instance();
    
                        $access_token = $_SESSION['access_token'];
                        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
                        $content = $connection->get('account/verify_credentials');

                        $twitter_user_id=0;
                        if(isset($content->id_str)){
                            $twitter_user_id=$content->id_str;
                            $twitter_user_id=sqlesc($twitter_user_id,false);
                        }else{

                        }

                        $twitter_user_id = sqlesc($twitter_user_id, false);

                        $fb_user_id='';

                        $full_name=trim($content->name);

                        $arr_name=explode(" ", $full_name);


                        $first_name=$arr_name[0];

                        $last_name="";
                        if (isset($arr_name[1])){
                            $last_name=$arr_name[1];
                        }

                        $email="";

                        $password="";

                        

                        $city=trim($content->time_zone);

                        $file_name=rand_sha1(32);

                        $folder = substr($file_name, -2);
                        if(!is_dir(FCPATH.'/uploads/users/'.$folder)){
                            mkdir(FCPATH.'/uploads/users/'.$folder,0755);
                        }

                        //uzimanje slike ako je sa twitter-a
                        $img_url=trim($content->profile_image_url_https);
                        $img_url=str_replace("_normal", "", $img_url);
                        $img = file_get_contents($img_url);
                        $file = FCPATH.'/uploads/users/'.$folder.'/'.$file_name.'.jpg';
                        file_put_contents($file, $img);
                        $confirmed=1;
                        $active=1;    
                        $registration_type = "twitter";

                        $TF=$CI->account_model->create($first_name,$last_name,$email,$password,$city,$file_name,"jpg",$fb_user_id,$twitter_user_id,$confirmed,$active,$registration_type);
                        
                        if($TF){
                            $this->_user_created = TRUE;  
                        }

    }
 
    
    
}

?>
