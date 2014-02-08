<?php
class Account_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function create($first_name='',$last_name='',$email='',$pass='',$city='',$img='',$ext='',$fb_user_id='',$twitter_user_id='',$confirmed=0,$active=0, $registration_type='')
	{
            $first_name=sqlesc($first_name);
            $last_name=sqlesc($last_name);


            $email=sqlesc($email,false);
            $pass=sqlesc($pass,false);
            $passdb="";
            if($pass!=""){
                $passhash=sha1(SALT.$pass);
                $passhash=sqlesc($passhash,false);
                $passdb=sha1(SALT.$passhash.$email);
            }
            
            
            $passdb=sqlesc($passdb);

            
            $email=sqlesc($email);

            $city=sqlesc($city);
            $img=sqlesc($img);
            $ext=sqlesc($ext);
            

            $fb_user_id=sqlesc($fb_user_id,false);
            $twitter_user_id=sqlesc($twitter_user_id,false);
            $confirmed+=0;
            $active+=0;
            
            $registration_type = sqlesc($registration_type, false);

            $sql="INSERT INTO " . PREFIX . "user (first_name,last_name,email,password,city,img,ext,fb_user_id,twitter_user_id,confirmed,active,registration_type) VALUES($first_name,$last_name,$email,$passdb,$city,$img,$ext,'$fb_user_id','$twitter_user_id',$confirmed,$active,'$registration_type')";
            $this->db->query($sql);

            $id=0+$this->db->insert_id();

            return $id;
	}
        
        
        

	function edit($first_name='',$last_name='',$username='',$email='',$day='',$month='',$year='',$gender=0,$country=0,$city='',$fb_user_id="",$ext='',$img='',$twitter_user_id="",$active=0)
	{
            
            
            
            
		if (!$this->logged_in())
		{	
			return 0;
		}
                
                global $user;
                $id=0+$user["id"];
                
            
            
                $first_name=sqlesc($first_name);
                $last_name=sqlesc($last_name);
            
            
                $username=sqlesc($username,false);
                $email=sqlesc($email);
                
                
                
                /*
                $passhash=sha1(SALT.$pass);
                $passhash=sqlesc($passhash,false);
                $passdb=sha1(SALT.$passhash.$username);
                $passdb=sqlesc($passdb,true);
                */
                

                
                
                
                $username=sqlesc($username);
                
                
                
                
                
                
                $date_of_birth=sqlesc($year."-".$month."-".$day);
                $gender+=0;
                $country+=0;
                $city=sqlesc($city);
                $ext=sqlesc($ext);
                $img=sqlesc($img,false);
                
                $fb_user_id=sqlesc($fb_user_id,false);
                $twitter_user_id=sqlesc($twitter_user_id,false);
                
                $active+=0;
                
                
                if($img!=""){
                    $sql="update " . PREFIX . "user SET first_name=$first_name,last_name=$last_name,username=$username,email=$email,birthday=$date_of_birth,gender=$gender,country=$country,city=$city,fb_user_id='$fb_user_id',ext=$ext,img='$img',twitter_user_id='$twitter_user_id',active=$active WHERE id=$id";
                }else{
                    $sql="update " . PREFIX . "user SET first_name=$first_name,last_name=$last_name,username=$username,email=$email,birthday=$date_of_birth,gender=$gender,country=$country,city=$city,fb_user_id='$fb_user_id',twitter_user_id='$twitter_user_id',active=$active WHERE id=$id";    
                }
                
		$this->db->query($sql);
                
                $id=0+$this->db->affected_rows();
               
                
                return $id;
	}
        
        
        
        
        
        
        
	function update_fb($first_name='',$last_name='',$username='',$email='',$pass='',$day='',$month='',$year='',$gender=0,$country=0,$city='',$fb_user_id='',$ext='',$img='',$twitter_user_id='',$active=0)
	{
            
            $first_name=sqlesc($first_name);
            $last_name=sqlesc($last_name);
            
            
                $username=sqlesc($username,false);
                $email=sqlesc($email);
                
                
                
                
                $passhash=sha1(SALT.$pass);
                $passhash=sqlesc($passhash,false);
                $passdb=sha1(SALT.$passhash.$username);
                $passdb=sqlesc($passdb,true);
                
                

                
                
                
                $username=sqlesc($username);
                
                
                
                
                
                
                $date_of_birth=sqlesc($year."-".$month."-".$day);
                $gender+=0;
                $country+=0;
                $city=sqlesc($city);
                $ext=sqlesc($ext);
                $img=sqlesc($img);
                
                $fb_user_id=sqlesc($fb_user_id,false);
                $twitter_user_id=sqlesc($twitter_user_id,false);
                
                $active+=0;
                
                
                
                $sql="UPDATE " . PREFIX . "user SET fb_user_id='$fb_user_id',active=1 WHERE email=$email";
		$this->db->query($sql);
                
                //$id=0+$this->db->insert_id();
                $id=0+$this->db->affected_rows();
               
                
                return $id;
	}  
        
        
        
        
        
        
	function get_user_fb($fb_user_id='')
	{
            
            //$this->load->database();
            
                    $fb_user_id=sqlesc($fb_user_id,false);
        
                    $row = FALSE;
                    $sql="SELECT * FROM " . PREFIX . "user WHERE fb_user_id='$fb_user_id' and registration_type='fb'";
                    $query = $this->db->query($sql);
                    if ($query->num_rows() == 1) {
                        $row=$query->row_array();
                    }
                    return $row;
        }
        
	function get_user_classic($email='')
	{
                    $email=sqlesc($email,false);
        
                    $row = FALSE;
                    $sql="SELECT * FROM " . PREFIX . "user WHERE email='$email' and registration_type='classic'";
                    $query = $this->db->query($sql);
                    if ($query->num_rows() == 1) {
                        $row=$query->row_array();
                    }
                    return $row;
        }
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
	function registration_confirm($email='',$hash='')
	{

            $email=sqlesc($email,false);

                    $query=$this->db->query("SELECT * FROM " . PREFIX . "user WHERE email='$email'");

                    if($query->num_rows()==1)
                    {
                            $res=$query->row_array();
                            
                            $email=$res['email'];
                            
                            $hash2=sha1(SALT.$email);
                            
                            if($hash==$hash2)
                            {
                                    
                                    $this->db->query("UPDATE " . PREFIX . "user SET confirmed=1 WHERE email='$email'");
                                    return true;
                            }
                    }
                return false;
	}
        
        
        
        
        
        
        
        
        
        
        
        
        
        
	function logged_in()
	{
 
            global $user;
            
            if(isset($user['id'])){
                if ($user['id']>0){
                    return TRUE;
                }
            }
            return FALSE;

        
	}
        
	function login($email='',$password='',$remember_me=false)
	{
            
            $email=sqlesc($email,false);
            $password=sqlesc($password,false);
            if($email=="" || $password==""){
                return false;
            }
            
            if(!valid_email($email)){
                    return false;
            }
            
            
            
                    $passhash=sha1(SALT.$password);
                    $passhash=sqlesc($passhash,false);
                    $passdb=sha1(SALT.$passhash.$email);
                    $passdb=sqlesc($passdb,false);

                    $query=$this->db->query("SELECT * FROM " . PREFIX . "user WHERE email='$email' and active=1 and confirmed=1");

                    if($query->num_rows()==1)
                    {
                            $result=$query->row_array();

                            if($result['password']==$passdb)
                            {
                                    $_SESSION[SESS_PREFIX . "email"]=$email;
                                    $_SESSION[SESS_PREFIX . "passhash"]=$passhash;
                                    
                                    if($remember_me){
                                        setcookie(SESS_PREFIX . "email", $email, time()+60*60*24,"/");
                                        setcookie(SESS_PREFIX . "passhash", $passhash, time()+60*60*24,"/");
                                    }else{
                                        setcookie(SESS_PREFIX . "email", "",0x7fffffff, "/");
                                        setcookie(SESS_PREFIX . "passhash", "",0x7fffffff, "/");
                                    }
                                    return true;
                            }
                    }
                
                return false;
      
	}
        
        
	function is_unconfirmed_user($email='')
	{
            if($email==""){
                return false;
            }

                    $email=sqlesc($email);

                    $query=$this->db->query("SELECT * FROM " . PREFIX . "user WHERE email=$email");

                    if($query->num_rows()==1)
                    {
                            $result=$query->row_array();

                            if($result['confirmed']==0)
                            {
                                    return true;
                            }
                    }
                
                return false;
	}
        
        
        
        /*
	function login_via_mail($email='')
	{
            
            
            if($email==""){
                return false;
            }
 
                    $email=sqlesc($email);

                    
                    
                    
                    
                    $query=$this->db->query("SELECT * FROM fb_users WHERE email=$email and active=1");

                    if($query->num_rows()==1)
                    {
                            $result=$query->row_array();


                            $_SESSION['smp_username']=$username;
                            $_SESSION['smp_passhash']=$passhash;

                            if($remember_me){
                                setcookie("smp_username", $username, time()+60*60*24);
                                setcookie("smp_passhash", $passhash, time()+60*60*24);
                            }else{
                                setcookie('smp_username', "",0x7fffffff, "/");
                                setcookie('smp_passhash', "",0x7fffffff, "/");
                            }
                            return true;
                            
                    }
                
                return false;
      
	}
        
        */
        
        
        
        
        
        
        /*
        function logout()
        {
            setcookie(SESS_PREFIX . "email", "",0x7fffffff, "/");
            setcookie(SESS_PREFIX . "passhash", "",0x7fffffff, "/");
            session_destroy();
        }
        */
        
        
        
        
       
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        

	function email_exists($email)//koristi se
	{
                $email=sqlesc($email);
            
                $sql="SELECT * from " . PREFIX . "user where email=$email";

		$query=$this->db->query($sql);
		if($query->num_rows()>0)
		{
			return TRUE;
		}
		
		return FALSE;
	}
        
	function username_exists($username)
	{
            
                $username=sqlesc($username);
            
                $sql="SELECT * from " . PREFIX . "user where username=$username";

		$query=$this->db->query($sql);
		
		if($query->num_rows()>0)
		{
			return true;
		}
		return false;
	}
        
        
	function fix_username($username)
	{
            
            $username=sqlesc($username,false);
            $username_pom=$username;
            $i=0;
            while (true) {
                $i++;
                                
                $sql="SELECT * from " . PREFIX . "user where username='$username_pom'";

		$query=$this->db->query($sql);
		
		if($query->num_rows()>0){
                    $username_pom=$username.$i;     
		}else{
                    break;
                }
            }
            
            return $username_pom;

	}
        
        
        /*
	function set_users2sections($id_users=0,$id_sections=0,$zaprati=0)
	{
            
            
            
            $id_users+=0;
            $id_sections+=0;
            $zaprati+=0;
            
            if($zaprati==1){
                    $query=$this->db->query("SELECT * FROM fb_users2teme WHERE id_users=$id_users AND id_teme=$id_sections");
                    if($query->num_rows()==0)
                    {
                        $query=$this->db->query("INSERT INTO fb_users2teme (id_users,id_teme) values($id_users,$id_sections)");
                    }
            }else{
                    $query=$this->db->query("DELETE FROM fb_users2teme WHERE id_users=$id_users AND id_teme=$id_sections");
            }

	}
        
        
        
	function check_users2sections($id_users=0)
	{

            $id_users+=0;

            $query=$this->db->query("SELECT * FROM fb_users2teme WHERE id_users=$id_users");
            if($query->num_rows()>0)
            {
                return true;
            }
            
            echo false;
            
            
	}
        
        
	function get_users2sections($id_users=0,$id_sections=0)
	{
            $id_users+=0;
            $id_sections+=0;

            

                    $query=$this->db->query("SELECT * FROM fb_users2teme WHERE id_users=$id_users AND id_teme=$id_sections");
                    if($query->num_rows()==0)
                    {
                        return false;
                    }else{
                        return true;
                    }
            

	}
        
        function get_users2sections_all($id_users=0)
	{
            $id_users+=0;
            

            

                    $query=$this->db->query("SELECT * FROM fb_users2teme WHERE id_users=$id_users");
                    if($query->num_rows()==0)
                    {
                        return false;
                    }else{
                        foreach ($query->result() as $row)
                        {
                            $all_sections_for_user[] = $row->id_teme;
                        }
                        
                        return $all_sections_for_user;
                    }
            

	}
        */
        
        
	function get_user($id_users=0)
	{

            $id_users+=0;

                    $query=$this->db->query("SELECT * FROM " . PREFIX . "user WHERE id=$id_users");
                    if($query->num_rows()==1)
                    {
                        $row=$query->row_array();
                        return $row;
                        
                    }
                    return;
	}
        

        
        
        
        
        
        
        
        
        
        
        
}
?>