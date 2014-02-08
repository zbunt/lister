<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_lib {

    protected $_user = array();
    protected $_logged_in_type = '';
    
    public function __construct() {
    }
    
    public function login() {

        $CI = & get_instance();

        global $login_conf_arr;
        foreach ($login_conf_arr as $type) {//classic, fb, twitter
            $user_obj = & $this->factory_user_login($type);
            $user_obj->login();
            if($user_obj->get_logged_in()){
                if($user_obj->check_user()){
                    $this->_user = $user_obj->get_user();
                    $this->_logged_in_type = $type;
                    break;
                }else{
                    $user_obj->create_user();
                    if($user_obj->get_user_created()){
                        $user_obj->login();
                        if($user_obj->get_logged_in()){
                            if($user_obj->check_user()){
                                $this->_user = $user_obj->get_user();
                                $this->_logged_in_type = $type;
                                break;
                            } 
                        }
                    }
                }
            } 
        }
        
    }
    
    
    

    public function get_user() {
        return $this->_user;
    }//get user

    public function check_user() {
        $CI = & get_instance();
        if(isset($this->_user['id'])){
            if ($this->_user['id']>0){
                return TRUE;
            }
        }
        return FALSE;
    }

    public function & factory_user_login($type="classic") {
        $CI = & get_instance();
        $class = "user_login_".$type."_lib";
        $class_path = "account/user_login_".$type."_lib";
        $CI->load->library($class_path);
        return $CI->$class; 
    }

}

?>
