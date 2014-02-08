<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

abstract class User_login_abstract_lib {

    protected $_logged_in = FALSE;
    protected $_user = array();
    protected $_user_created = FALSE;
    
    public function __construct() {
    }
    
    abstract public function login();
    abstract public function create_user();

    public function get_user() {
        return $this->_user;
    }
    public function get_logged_in() {
        return $this->_logged_in;
    }
    public function get_user_created() {
        return $this->_user_created;
    }
    
    public function check_user() {

        if(isset($this->_user['id'])){
            if ($this->_user['id']>0){
                return TRUE;
            }
        }
        return FALSE;

    }

}

?>
