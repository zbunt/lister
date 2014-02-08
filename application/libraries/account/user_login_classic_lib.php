<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


require_once( 'user_login_abstract_lib.php' );
class User_login_classic_lib extends User_login_abstract_lib {
    
    public function __construct() {
    }

    public function login() {
        $CI = & get_instance();

        /********************CLASIC LOGIN**************************/
        $email="";
        $passhash="";
            
         if (isset($_SESSION[SESS_PREFIX . "email"]) && isset($_SESSION[SESS_PREFIX . "passhash"])){
            $email= $_SESSION[SESS_PREFIX . "email"];
            $passhash= $_SESSION[SESS_PREFIX . "passhash"];
         }else{
             if (isset($_COOKIE[SESS_PREFIX . "email"]) && isset($_COOKIE[SESS_PREFIX . "passhash"])){
                $email = $_COOKIE[SESS_PREFIX . "email"];
                $passhash = $_COOKIE[SESS_PREFIX . "passhash"];
             }
         }
         if($email!=""){

                $email=sqlesc($email,false);
                $row = $CI->account_model->get_user_classic($email);
                if ($row) {
                        $passhash=sqlesc($passhash,false);
                        $passdb=sha1(SALT.$passhash.$email);
                        $passdb=sqlesc($passdb,false);

			if($row['password']==$passdb)
			{
                            //echo "SUCCESS";
                            

                            $_SESSION[SESS_PREFIX . "email"]=$email;
                            $_SESSION[SESS_PREFIX . "passhash"]=$passhash;
                            $this->_user=$row;
                            $this->_logged_in=TRUE;
			}else{
                            setcookie(SESS_PREFIX . "email", "",0x7fffffff, "/");
                            setcookie(SESS_PREFIX . "passhash", "",0x7fffffff, "/");
                        }
	        }  
        }
    }
    
    public function create_user() {
    }

    
    
    

}

?>
