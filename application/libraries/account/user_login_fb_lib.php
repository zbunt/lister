<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


require_once( 'user_login_abstract_lib.php' );
class User_login_fb_lib extends User_login_abstract_lib {

    public function __construct() {
    }
    
    public function login() {

        $CI = & get_instance();

            
            global $facebook;

            
            $fb_user = $facebook->getUser();
  
            if($fb_user){
                if(isset($_SESSION['fb_'.FB_APP_ID.'_user_id'])){
                    $fb_user_id=$_SESSION['fb_'.FB_APP_ID.'_user_id'];
                    $fb_user_id=sqlesc($fb_user_id,false);

                    $row = $CI->account_model->get_user_fb($fb_user_id);

                    if ($row) {
                        $this->_user=$row;
                        $this->_logged_in=TRUE;
                    }else{//kreiramo useera preko facebook-a
                        $this->_logged_in=TRUE;
                    }
                }
            }
       
    }
    
    public function create_user() {
        
        $CI = & get_instance();
    
        global $facebook;
    
                        $twitter_user_id='';
                        
                        $user_graph = $facebook->api('/me');                        
                        
                        $first_name=$user_graph['first_name'];
                        $last_name=$user_graph['last_name'];
                        
                        $email=$user_graph['email'];
                        $password="";

                        $location=$user_graph['location']['name'];
                        

                        $arr_location=explode(",", $location);
                        
                        
                        
                        
                        
                        $city=$arr_location[0];
                        $city=trim($city);
                        
                        
                        
                        $fb_user_id = $user_graph['id'];
                        $confirmed=1;
                        $active=1;
                        $registration_type = 'fb';
                        

                        $file_name="";//slika
                        
                        

                            
                        $file_name=rand_sha1(32);

                        $folder = substr($file_name, -2);
                        if(!is_dir(FCPATH.'/uploads/users/'.$folder)){
                          mkdir(FCPATH.'/uploads/users/'.$folder,0755);
                        }

                        /*uzimanje slike ako je sa fejsa*/
                        $img = file_get_contents('https://graph.facebook.com/'.$fb_user_id.'/picture?type=large');
                        $file = FCPATH.'/uploads/users/'.$folder.'/'.$file_name.'.jpg';
                        file_put_contents($file, $img);

                        $TF=$CI->account_model->create($first_name,$last_name,$email,$password,$city,$file_name,"jpg",$fb_user_id,$twitter_user_id,$confirmed,$active,$registration_type);
                        //$TF_novi=true;


                        if($TF){
                            $this->_user_created = TRUE;  
                        }
                        //exit;

    }

    
    
}

?>
