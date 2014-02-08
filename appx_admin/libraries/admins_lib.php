<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admins_lib {

    private $value = NULL;

    public function __construct() {
    }

    public function Set() {
            $this->Data();
    }

    private function Data() {
        
        $CI = & get_instance();
        
        $this->value['id']=0;

        
        $TF_logged_in=false;
        /********************CLASIC LOGIN**************************/
        $username="";
        $passhash="";
            
         if (isset($_SESSION[COOKIE_PREFIX."admin_username"]) && isset($_SESSION[COOKIE_PREFIX."admin_passhash"])){
            $username= $_SESSION[COOKIE_PREFIX."admin_username"];
            $passhash=$_SESSION[COOKIE_PREFIX."admin_passhash"];
         }else{
             if (isset($_COOKIE[COOKIE_PREFIX."admin_username"]) && isset($_COOKIE[COOKIE_PREFIX."admin_passhash"])){
                $username = $_COOKIE[COOKIE_PREFIX."admin_username"];
                $passhash = $_COOKIE[COOKIE_PREFIX."admin_passhash"];
             }
         }
         

         
         if($username!=""){

              
             
                $username=sqlesc($username,false);
                $sql="SELECT * FROM admins WHERE username='$username'";
                $query = $CI->db->query($sql);
	        if ($query->num_rows() == 1) {

                        $row=$query->row_array();
                        $passhash=sqlesc($passhash,false);
			if($row['password']==$passhash)
			{
                            $this->value=$row;
                            $query = $CI->db->query($sql);
                            $_SESSION[COOKIE_PREFIX."admin_username"]=$username;
                            $_SESSION[COOKIE_PREFIX."admin_passhash"]=$passhash;
                            
                           $TF_logged_in=true;
			}else{
                            setcookie(COOKIE_PREFIX.'admin_username', "",0x7fffffff, "/");
                            setcookie(COOKIE_PREFIX.'admin_passhash', "",0x7fffffff, "/");
                        }
	        }  
        }
        /*****************END CLASIC LOGIN**************************/
        
        

        
    }

    public function Get() {
        $this->Set();
        return $this->value;
    }

}

?>
