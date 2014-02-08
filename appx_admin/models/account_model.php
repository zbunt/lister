<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function create($first_name="",$last_name="",$email="",$username="",$password="")
	{
            
            $first_name=sqlesc($first_name);
            $last_name=sqlesc($last_name);
            $email=sqlesc($email);
            $username=sqlesc($username);

            $passhash=sha1(SALT.$password);
            $passhash=sqlesc($passhash);
  
            
            $sql="INSERT INTO admins (first_name,last_name,email,username,password) VALUES($first_name,$last_name,$email,$username,$passhash)";
            $this->db->query($sql);

            $id=0+$this->db->insert_id();


            return $id;
	}
        
        
        
        
	function logged_in()
	{
 
            global $admins;
            
            $admins['id']=0+$admins['id'];
            
            if ($admins['id']!=0)
            {
                    return TRUE;
            }
            return FALSE;
	}
        
	function login($username='',$password='',$remember_me=false)
	{
                    global $admins;
                    
                    $passhash=sha1(SALT.$password);

                    $query=$this->db->query("SELECT * FROM admins WHERE username='$username' AND active=1" );

                    if($query->num_rows()==1)
                    {
                            $result=$query->row_array();

                            if($result['password']==$passhash)
                            {
                                    $_SESSION[COOKIE_PREFIX.'admin_username']=$username;
                                    $_SESSION[COOKIE_PREFIX.'admin_passhash']=$passhash;
                                    $admins['id'] = $result['id'];
                                    
                                    if($remember_me){
                                        setcookie(COOKIE_PREFIX."admin_username", $username, time()+60*60*24);
                                        setcookie(COOKIE_PREFIX."admin_passhash", $passhash, time()+60*60*24);
                                    }else{
                                        setcookie(COOKIE_PREFIX.'admin_username', "",0x7fffffff, "/");
                                        setcookie(COOKIE_PREFIX.'admin_passhash', "",0x7fffffff, "/");
                                    }
                                    return true;
                            }
                    }
                
                return false;
  
                
	}
        
        
        function logout()
        {
            setcookie(COOKIE_PREFIX.'admin_username', "",0x7fffffff, "/");
            setcookie(COOKIE_PREFIX.'admin_passhash', "",0x7fffffff, "/");
            session_destroy();
        }
        
        
        function change_password($admin_id,$new_pass,$old_pass){
            
            $admin_id = 0+$admin_id;
            
            $old_pass = sqlesc($old_pass);
            
            $pashas_old = sqlesc(sha1(SALT . $old_pass));
            $sqll = "SELECT * FROM admins WHERE id=$admin_id AND password=$pashas_old";
            $result_old = $this->db->query($sqll);
            
            if($result_old !== FALSE){
                
                $pashas_new = sqlesc(sha1(SALT . $new_pass));
                
                $sql="UPDATE admins SET password=$pashas_new WHERE id=$admin_id";
                return $this->db->query($sql);
                
            }else{
                return FALSE;
            }
                
            
            
            
            
            
            
            
            
        }
        
        
        
        
        
        
        
        
        
}
?>