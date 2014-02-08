<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Account extends CI_Controller
{
       function __construct()
       {
            	parent::__construct();

                
                global $user;
                $user_obj = $this->user_lib;
                $user_obj->login();
                if($user_obj->check_user()){
                    $user = $user_obj->get_user();
                }
	}
	

	function login()
	{
            

            
            global $user;
            
            
            
            if ($this->account_model->logged_in())
            {
                echo 'error logged in 567!';
                exit;  
            }
            
        $con='';


        if($_POST){

            foreach ($_POST as $key => $value) {
                    ${$key} = $value;
            }



            $email=sqlesc($email,false);//
            $password=sqlesc($password,false);//


            if($email=='' ){
                echo "Email is required!";
                exit;
            } 
            if($password=='' ){
                echo "Password is required!";
                exit;
            } 
            
            if(!valid_email($email)){
                    echo "Email Address is not valid!";
                    exit;
            }
            
            

                    $TF=$this->account_model->login($email,$password,$remember_me);
                    if($TF){
                        return;
                    }else{
                        $unconfirmed=$this->account_model->is_unconfirmed_user($email);
                        if($unconfirmed){
                            echo "You must confirm your Email address!";
                        }else{
                            echo "Email address and Password not match!";
                        }
                    }
                }else{
                    echo "Error in login proces. Please try again!";
                }
	}
        
        
        
        
        
        
        
    //AJAX
    function signup()
    {

        
        global $user;
        if ($this->account_model->logged_in())
        {
            echo 'error logged in!';
            exit;  
        }

        $con='';


        if($_POST){

            foreach ($_POST as $key => $value) {
                    ${$key} = $value;
            }

            
            
            
            
            
$name=sqlesc(trim($name),false);//

$parts = explode(' ', $name); 
$first_name = array_shift($parts);
$last_name = array_pop($parts);
$middle_name = trim(implode(' ', $parts));

$email=sqlesc($email,false);//
$password=sqlesc($password,false);//
$password2=sqlesc($password2,false);//

if($name=='' ){
    echo "Full Name is required!";
    exit;
} 


if($first_name=='' ){
    echo "First Name is required!";
    exit;
} 
if($last_name=='' ){
    echo "Last Name is required!";
    exit;
} 

if($email=='' ){
    echo "Email is required!";
    exit;
} 
if($password=='' ){
    echo "Password is required!";
    exit;
} 
if($password2=='' ){
    echo "Password again is required!";
    exit;
} 
if($password!=$password2){
    echo "Passwords not match";
    exit;
} 
if(!valid_email($email)){
        echo "Email Address is not valid!";
        exit;
}
if ($this->account_model->email_exists($email)){
        echo "Email address alredy exists in our database. Please use a different one";
        exit;
}



$city='';

$file_name='';
$ext='jpg';
$fb_user_id='';
$twitter_user_id='';

$confirmed=0;
$active=1;
$registration_type='classic';
/*
echo "$first_name,$last_name,$email,$password,$city,$fb_user_id,$ext,$img,$twitter_user_id,$confirmed,$active,$registration_type";
exit;
     */                   

                        $TF=$this->account_model->create($first_name,$last_name,$email,$password,$city,$file_name,"jpg",$fb_user_id,$twitter_user_id,$confirmed,$active,$registration_type);
                        //$TF_novi=true;

                        if($TF)
			{
                 
/*****************************EMAIL**********************************/ 
                                                 
$hash=sha1(SALT.$email);                      
$link=base_url().'account/registration_confirm/'.$email.'/'.$hash;
                            
$to=$email;
$from='office@lister.rs';

$subject="Account registration procedure"; 

$message='
    Your registration informations:
    <br>
    Email Address: '.$email.'
    <br>
    Password: '.$password.'
    <br><br>
    
    To activate your account please cilick on link below:
    <br>
    <a href="'.$link.'">'.$link.'</a>
';                  
                            
$headers   = array();
$headers[] = "MIME-Version: 1.0";
$headers[] = "Content-type: text/html; charset=UTF-8";
$headers[] = "From: LISTER <{$from}>";
//$headers[] = "Bcc: JJ Chong <bcc@domain2.com>";
$headers[] = "Reply-To: Recipient Name <receiver@domain3.com>";
$headers[] = "Subject: {$subject}";
$headers[] = "X-Mailer: PHP/".phpversion();

$flag=mail($to, $subject, $message, implode("\r\n", $headers));
          
if(!$flag){
                                                    echo "error535 mail not sent";
                                                    exit;
}         
/*****************************EMAIL**********************************/                        

                                    $_SESSION['popup'] = "signup success";//




                                    echo "";
                                    exit;


			}
			else
			{
                            
                            echo "error888!"; 

                            
			}
                        
                        
                        
		}else{
                    echo "error 346: no post!"; 
                }
                


    } 
        
        
        

        
		
	function register()
	{

            global $user;

            if ($this->account_model->logged_in())
            {	
                    redirect();
            }

            
            if(isset($_POST["first_name1"])){//dolazi sa prvog koraka
                            $this->load->library('account/registration_form_lib');
                            $data["glavna"]=$this->registration_form_lib->Get();
            }else{

                $this->form_validation->set_rules('first_name','First name','xss_clean|required|min_length[3]');
                $this->form_validation->set_rules('last_name','Last name','xss_clean|required|min_length[3]');
		$this->form_validation->set_rules('email','Email Address','xss_clean|required|valid_email|callback_email_exists');
                $this->form_validation->set_rules('username2','Username','xss_clean|required|min_length[4]|callback_user_exists');
		$this->form_validation->set_rules('password2','Password','xss_clean|required|min_length[4]|max_length[20]|matches[password2_conf]');
		$this->form_validation->set_rules('password2_conf','Password Confirmation','xss_clean|required|matches[password2]');
		
		$this->form_validation->set_rules('gender','Pol','required');
                
		/*$this->form_validation->set_rules('day');
		$this->form_validation->set_rules('month');*/
		$this->form_validation->set_rules('year','Datum rodjenja','xss_clean|callback_year_empty');
                $this->form_validation->set_rules('country','Država','required');
		$this->form_validation->set_rules('city','Grad','xss_clean|required');
                
                //var_dump($_FILES);
                
                if((isset($_FILES["file"])) and (!empty($_FILES["file"]['tmp_name']))){
                    $this->form_validation->set_rules('file','Fajl','callback_img_upload_check');
                }
                
		if($this->form_validation->run()==FALSE)
		{
                            $this->load->library('account/registration_form_lib');
                            $data["glavna"]=$this->registration_form_lib->Get();
		}
		else
		{

                    
                        $first_name=$this->input->post('first_name');
                        $last_name=$this->input->post('last_name');
			$email=$this->input->post('email');
                        $username=$this->input->post('username2');
			$pass=$this->input->post('password2');
			$day=$this->input->post('day');
                        $month=$this->input->post('month');
                        $year=$this->input->post('year');
                        
                        
                        $gender=$this->input->post('gender');
			$country=$this->input->post('country');
			$city=$this->input->post('city');

                        //var_dump ($_FILES);

                        $fb_user_id="";
                        $twitter_user_id="";
 
                        
                        
                        
                        
                               /*********************SLIKA*************************************/
                            $file_name = "";
                            $ext="";
                            $error_img="";
                            if((isset($_FILES["file"])) and (!empty($_FILES["file"]['tmp_name']))){
                                                $error_img="";

                                                $file_name=rand_sha1(32);
                                                $folder=substr($file_name, -2);
                                                
                                                $dir_name='slike_new/'.$folder."/";
                                                
                                                if(!is_dir($dir_name)){
                                                    mkdir(FCPATH.$dir_name,0755);
                                                }
                                                

                                                $config['file_name'] = $file_name;
                                                $config['upload_path'] = $dir_name;
                                                $config['allowed_types'] = 'gif|jpg|png';
                                                $config['max_size']	= '1024';
                                                //$config['max_width']  = '1024';
                                                //$config['max_height']  = '1024';
                                                //$config['encrypt_name']  = TRUE;



                                                if(!is_dir($dir_name)){ 
                                                       echo "directory does not exist...$dir_name !";
                                                       exit;
                                                }





                                                $this->load->library('upload', $config);

                                                $field_name = "file";
                                                if ( $this->upload->do_upload($field_name))
                                                {

                                                    $data['upload_data'] = $this->upload->data();
                                                    $arr=getimagesize($data['upload_data']['full_path']);


                                                    if ($arr[0]>=200 && $arr[1]>=200){
                                                                                $TF_slika=TRUE;

                                                                                $this->load->library('image_lib');


                                                                                //make max image width or height = 720px

                                                                                if ($data['upload_data']['image_width']>720 || $data['upload_data']['image_height']>720){


                                                                                        $config2['image_library'] = 'gd2';
                                                                                        $config2['source_image'] = $data['upload_data']['full_path'];
                                                                                        $config2['create_thumb'] = FALSE;
                                                                                        $config2['maintain_ratio'] = TRUE;
                                                                                        $config2['width'] = 720;
                                                                                        $config2['height'] = 720;


                                                                                        $this->image_lib->initialize($config2);

                                                                                        if (!$this->image_lib->resize())
                                                                                        {
                                                                                                $TF_slika=FALSE;
                                                                                                $error_img =  $this->image_lib->display_errors();

                                                                                        }

                                                                                        $this->image_lib->clear();


                                                                                }

                                                                                if($TF_slika){
                                                                                    $dir=$data['upload_data']['file_path'];
                                                                                    $image= $data['upload_data']['raw_name'];
                                                                                    $ext=substr($data['upload_data']['file_ext'],1);
                                                                                    //$this->account_model->insert_image($file_name,$ext,$id);
                                                                                }
                                                    }else{
                                                            if(@unlink($data['upload_data']['full_path'])){
                                                                    $error_img = 'min image width or height must be 200px !';
                                                            }
                                                            else{
                                                                    exit('Problem width deletting image, min width or height < 200px !');
                                                            }
                                                    } 


                                                }
                                                else{
                                                    $error_img= $this->upload->display_errors();
                                                }


                                                if ($error_img!=""){
                                                    die ($error_img);

                                                }
     
                            }
                            /*********************SLIKA*************************************/
                        
                        
                        
                        
                        
                        
                        
                        $id=$this->account_model->create($first_name,$last_name,$username,$email,$pass,$day,$month,$year,$gender,$country,$city,$fb_user_id,$ext,$file_name,$twitter_user_id);
			if($id)
			{
                            

                            
 /*
                            $TF=$this->account_model->login($username,$pass);
                            
                            if($TF){
                                $this->load->library('registration_success');
                                $data["content"]=$this->registration_success->Get();
                            }
                            */
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
/*****************************EMAIL**********************************/ 
/*            
$hash=sha1(SALT.$email);                      
$link=base_url().'account/registration_confirm/'.$email.'/'.$hash;
                            
$to=$email;
$from='office@smedia.rs';

$subject="Aktivacija naloga !"; 

$message='
    Vasi pristupni podaci su:
    <br>
    Username:'.$username.'
    <br>
    Password:'.$pass.'
    <br><br>
    Za aktivaciju naloga kliknite na sledeci link:
    <br>
    <a href="'.$link.'">'.$link.'</a>
';                  
                            
$headers   = array();
$headers[] = "MIME-Version: 1.0";
$headers[] = "Content-type: text/html; charset=UTF-8";
$headers[] = "From: Smedia group <{$from}>";
//$headers[] = "Bcc: JJ Chong <bcc@domain2.com>";
$headers[] = "Reply-To: Recipient Name <receiver@domain3.com>";
$headers[] = "Subject: {$subject}";
$headers[] = "X-Mailer: PHP/".phpversion();

$flag=mail($to, $subject, $message, implode("\r\n", $headers));
          
if(!$flag){
                                                    echo "error mail not sent";
                                                    exit;
}  
*/
      
/*****************************EMAIL**********************************/ 
                            
                            /*
                            $_SESSION['popup'] = 1;//signup success
                            
                            redirect();
*/

                            
                            $_SESSION['registration_type'] = "normal";
                            $_SESSION['registration_id'] = $id;
                            $_SESSION['registration_password'] = $pass;
                            redirect("account/register_sections");             
                            
                            
                            
			}
			else
			{
                            
                            
                            
                            $_SESSION['popup'] = 4;//error reg

                            redirect();
                            
                            
                            
                            
                            
			}
		}
                
                
                
            }
                

            
            

                $this->load->library('head_lib');
                $data["head"]=$this->head_lib->Get("","",0,0,"account",0);             

                
                $this->load->library('profile2_lib');
                $data["profile"]=$this->profile2_lib->Get(); 
                
                /*
                $this->load->library('account/registration_home_form_lib');
                $data["glavna"]=$this->registration_home_form_lib->Get(); 
                */

                $this->load->library('footer_lib');
                $data["footer"] = $this->footer_lib->Get();   
                
                
                $this->load->library('foot_lib');
                $data["foot"] = $this->foot_lib->Get(); 


                $this->load->view('register_homepage',$data);
    
	}
        
        
        
        
        
        
        
        
        

        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
	function registration_confirm($email,$hash)
	{
            
            $TF=$this->account_model->registration_confirm($email,$hash);
            if($TF)
            {

                        //$username=$this->account_model->get_username_from_email($email);
                            
                            
                            //$this->account_model->login_via_mail($email);
                            
                            //$TF=$this->account_model->login($username,$pass);
                            
                            //redirect();
                            
                            $_SESSION['popup'] = "confirmation_success";//confirmation success
                            /*
                            $this->load->library('account/activation_success_lib');
                            $data["content"]=$this->activation_success_lib->Get();
                             */
                             redirect();
                            
            }else{
                            $_SESSION['popup'] = "confirmation_error";
                            /*
                            $this->load->library('account/registration_error_lib');
                            $data["content"]=$this->registration_error_lib->Get();*/
                            
                            //26-07-2013 rediretc dodat proba
                            redirect();
            }
            
/*
                $this->load->library('head_lib');
                $data["head"]=$this->head_lib->Get();             

                $this->load->library('header2_lib');
                $data["header"]=$this->header2_lib->Get(); 



                $this->load->library('footer_lib');
                $data["footer"] = $this->footer_lib->Get();   
                
                
                $this->load->library('foot_lib');
                $data["foot"] = $this->foot_lib->Get(); 

                
                
                
                
                
                $this->load->view('account',$data);
            
            */
            
	} 
        
        
        
        
        
        
        
    
	function register_finish()
	{
            
            $id_users=0;
            if(isset($_SESSION['registration_id'])){
                $id_users=$_SESSION['registration_id'];
            }
            
            
            $pass="";
            if(isset($_SESSION['registration_password'])){
                $pass=$_SESSION['registration_password'];
            }
            
            
            $type="";
            if(isset($_SESSION['registration_type'])){
                $type=$_SESSION['registration_type'];
            }
            
            
            

            
            $TF=true;
            
            
            
            
            if($id_users==0 || $pass==""  || $type==""){
                $TF=false;
            }
            
            if($type=="fb" || $type=="twitter"){
                $TF=false;
            }
            
            
            
            if ($this->account_model->logged_in())
            {	
                $TF=false;
            }
            
            
            $user_pom=$this->account_model->get_user($id_users);
            
            if(!$user_pom){
                 $TF=false;
            }
            
            
           foreach ($user_pom as $key => $value) {
                ${$key} = trim($value);
            }
            
            
            if($active!=0){
                $TF=false;
            }
            
            
            
            
            
            
            
            
            
 /*
                            $TF=$this->account_model->login($username,$pass);
                            
                            */
                            
                            
                            

                            
                            
                            
                            
                            
                            
                            
if($TF){
                            
/*****************************EMAIL**********************************/ 
          
$hash=sha1(SALT.$email);                      
$link=base_url().'account/registration_confirm/'.$email.'/'.$hash;
                            
$to=$email;
$from='office@gifs.rs';

$subject="Aktivacija naloga !"; 

$message='
    Vasi pristupni podaci su:
    <br>
    Username:'.$username.'
    <br>
    Password:'.$pass.'
    <br><br>
    Za aktivaciju naloga kliknite na sledeci link:
    <br>
    <a href="'.$link.'">'.$link.'</a>
';                  
                            
$headers   = array();
$headers[] = "MIME-Version: 1.0";
$headers[] = "Content-type: text/html; charset=UTF-8";
$headers[] = "From: Smedia group <{$from}>";
//$headers[] = "Bcc: JJ Chong <bcc@domain2.com>";
$headers[] = "Reply-To: Recipient Name <receiver@domain3.com>";
$headers[] = "Subject: {$subject}";
$headers[] = "X-Mailer: PHP/".phpversion();

$flag=mail($to, $subject, $message, implode("\r\n", $headers));
          
if(!$flag){
                                                    echo "error mail not sent";
                                                    exit;
}  

      
/*****************************EMAIL**********************************/ 


$_SESSION['popup'] = 1;//signup success aktivirajte nalog


}   else{
$_SESSION['popup'] = 7;//signup success
}              
                            



                            





                unset($_SESSION['registration_id']);
                unset($_SESSION['registration_password']);
                unset($_SESSION['registration_type']);
                
                


                            //26-07-2013 dodat 'proba' u redirect()
                            redirect(); 
                            
            
	}   
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
	function edit()
	{
            
            
            
            
            
            
		if (!$this->account_model->logged_in())
		{	
			redirect('/proba');
		}
            
                
                
                
                global $user;
                
            
            
                $this->form_validation->set_rules('first_name','First name','xss_clean|required|min_length[3]');
                $this->form_validation->set_rules('last_name','Last name','xss_clean|required|min_length[3]');
                $this->form_validation->set_rules('username2','Username','xss_clean|required|min_length[4]|callback_user_exists_edit');
		$this->form_validation->set_rules('email','Email Address','xss_clean|required|valid_email|callback_email_exists_edit');
		//$this->form_validation->set_rules('password','Password','xss_clean|required|min_length[4]|max_length[20]|matches[password_conf]');
		//$this->form_validation->set_rules('password_conf','Password Confirmation','xss_clean|required|matches[password]');
		
		$this->form_validation->set_rules('gender','Pol','required');
                
		/*$this->form_validation->set_rules('day');
		$this->form_validation->set_rules('month');*/
		$this->form_validation->set_rules('year','Datum rodjenja','xss_clean|callback_year_empty');
                $this->form_validation->set_rules('country','Država','required');
		$this->form_validation->set_rules('city','Grad','xss_clean|required');
                
                //var_dump($_FILES);
                
                if((isset($_FILES["file"])) and (!empty($_FILES["file"]['tmp_name']))){
                    $this->form_validation->set_rules('file','Fajl','callback_img_upload_check');
                }
                
		if($this->form_validation->run()==FALSE)
		{
                            $this->load->library('account/edit_form_lib');
                            $data["glavna"]=$this->edit_form_lib->Get();
                            
		}
		else
		{

                    
                        $first_name=$this->input->post('first_name');
                        $last_name=$this->input->post('last_name');
			$username=$this->input->post('username2');
			$email=$this->input->post('email');
			//$pass=$this->input->post('password');
			$day=$this->input->post('day');
                        $month=$this->input->post('month');
                        $year=$this->input->post('year');
                        
                        
                        $gender=$this->input->post('gender');
			$country=$this->input->post('country');
			$city=$this->input->post('city');

                        //var_dump ($_FILES);

                        $fb_user_id="";
                        $twitter_user_id="";
 
                        
                        
                        
                        
                               /*********************SLIKA*************************************/
                            $file_name = "";
                            $ext="";
                            $error_img="";
                            if((isset($_FILES["file"])) and (!empty($_FILES["file"]['tmp_name']))){
                                                $error_img="";

                                                $file_name=rand_sha1(32);
                                                $folder=substr($file_name, -2);
                                                
                                                $dir_name='slike_new/'.$folder."/";
                                                
                                                if(!is_dir($dir_name)){
                                                    mkdir(FCPATH.$dir_name,0755);
                                                }
                                                

                                                $config['file_name'] = $file_name;
                                                $config['upload_path'] = $dir_name;
                                                $config['allowed_types'] = 'gif|jpg|png';
                                                $config['max_size']	= '1024';
                                                //$config['max_width']  = '1024';
                                                //$config['max_height']  = '1024';
                                                //$config['encrypt_name']  = TRUE;



                                                if(!is_dir($dir_name)){ 
                                                       echo "directory does not exist...$dir_name !";
                                                       exit;
                                                }





                                                $this->load->library('upload', $config);

                                                $field_name = "file";
                                                if ( $this->upload->do_upload($field_name))
                                                {

                                                    $data['upload_data'] = $this->upload->data();
                                                    $arr=getimagesize($data['upload_data']['full_path']);


                                                    if ($arr[0]>=200 && $arr[1]>=200){
                                                                                $TF_slika=TRUE;

                                                                                $this->load->library('image_lib');


                                                                                //make max image width or height = 720px

                                                                                if ($data['upload_data']['image_width']>720 || $data['upload_data']['image_height']>720){


                                                                                        $config2['image_library'] = 'gd2';
                                                                                        $config2['source_image'] = $data['upload_data']['full_path'];
                                                                                        $config2['create_thumb'] = FALSE;
                                                                                        $config2['maintain_ratio'] = TRUE;
                                                                                        $config2['width'] = 720;
                                                                                        $config2['height'] = 720;


                                                                                        $this->image_lib->initialize($config2);

                                                                                        if (!$this->image_lib->resize())
                                                                                        {
                                                                                                $TF_slika=FALSE;
                                                                                                $error_img =  $this->image_lib->display_errors();

                                                                                        }

                                                                                        $this->image_lib->clear();


                                                                                }

                                                                                if($TF_slika){
                                                                                    $dir=$data['upload_data']['file_path'];
                                                                                    $image= $data['upload_data']['raw_name'];
                                                                                    $ext=substr($data['upload_data']['file_ext'],1);
                                                                                    //$this->account_model->insert_image($file_name,$ext,$id);
                                                                                }
                                                    }else{
                                                            if(@unlink($data['upload_data']['full_path'])){
                                                                    $error_img = 'min image width or height must be 200px !';
                                                            }
                                                            else{
                                                                    exit('Problem width deletting image, min width or height < 200px !');
                                                            }
                                                    } 


                                                }
                                                else{
                                                    $error_img= $this->upload->display_errors();
                                                }


                                                if ($error_img!=""){
                                                    die ($error_img);

                                                }
     
                            }
                            /*********************SLIKA*************************************/
                        
                        
                        $active=0+$user["active"];
                        $fb_user_id=$user["fb_user_id"];
                        $twitter_user_id=$user["twitter_user_id"];
                        
                        
                        $TF_mail_changed=false;
                        if($email!=$user["email"]){
                            $TF_mail_changed=true;
                            $active=0;
                            $fb_user_id="";
                            
                        }
                        
                        
                        
                        
                        $id=$this->account_model->edit($first_name,$last_name,$username,$email,$day,$month,$year,$gender,$country,$city,$fb_user_id,$ext,$file_name,$twitter_user_id,$active);

			
                        
                        
                        if($id)
			{
                            

                            
 /*
                            $TF=$this->account_model->login($username,$pass);
                            
                            if($TF){
                                $this->load->library('registration_success');
                                $data["content"]=$this->registration_success->Get();
                            }
                            */
                            
                            
                            
                            
                            

                            
                            
                            
                            
if($TF_mail_changed){   
                            
                            
/*****************************EMAIL**********************************/ 
                          
$hash=sha1(SALT.$email);                      
$link=base_url().'account/registration_confirm/'.$email.'/'.$hash;
                            
$to=$email;
$from='office@smedia.rs';

$subject="Aktivacija naloga !"; 

$message='
    Zbog promene email adrese, ponovo morate aktivirati svoj nalog:
    <br>
    Za aktivaciju naloga kliknite na sledeci link:
    <br>
    <a href="'.$link.'">'.$link.'</a>
';                  
                            
$headers   = array();
$headers[] = "MIME-Version: 1.0";
$headers[] = "Content-type: text/html; charset=UTF-8";
$headers[] = "From: Smedia group <{$from}>";
//$headers[] = "Bcc: JJ Chong <bcc@domain2.com>";
$headers[] = "Reply-To: Recipient Name <receiver@domain3.com>";
$headers[] = "Subject: {$subject}";
$headers[] = "X-Mailer: PHP/".phpversion();

$flag=mail($to, $subject, $message, implode("\r\n", $headers));
          
if(!$flag){
                                                    echo "error mail not sent";
                                                    exit;
}     
      
         
/*****************************EMAIL**********************************/ 
          


$this->account_model->logout();

session_start();
$_SESSION['popup'] = 3;//zbog promene mejla morate aktivirati nalog
redirect('/proba');




}                      

                            
$_SESSION['popup'] = 5;//uspesno ste editovali profil
             
redirect('/proba');              


			}
			else
			{
                            
                            $_SESSION['popup'] = 6;//account nije promenjen
redirect('/proba');
/*
                            $this->load->library('account/registration_error_lib');
                            $data["content"]=$this->registration_error_lib->Get();
 */
 
			}
		}
                
                $this->load->library('head_lib');
                $data["head"]=$this->head_lib->Get("","",0,0,"account",0);             

                
                $this->load->library('profile2_lib');
                $data["profile"]=$this->profile2_lib->Get(); 
                

                /*
                $this->load->library('account/registration_home_form_lib');
                $data["glavna"]=$this->registration_home_form_lib->Get(); 
                */

                $this->load->library('footer_lib');
                $data["footer"] = $this->footer_lib->Get();   
                
                
                $this->load->library('foot_lib');
                $data["foot"] = $this->foot_lib->Get(); 


                $this->load->view('register_homepage',$data);
    
	}
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
	function logout()
	{
            

            
            setcookie(SESS_PREFIX.'email', "", 0x7fffffff, "/");
            setcookie(SESS_PREFIX.'passhash', "", 0x7fffffff, "/");
            session_destroy();
            global $facebook;
            $facebook->destroySession();
            //26-07-2013 dodat 'proba' u redirect()
            redirect();
	}
        
        
	function check_login()
	{
            
            
            echo "netreba";
            exit;

	
                $username=$this->input->post('username');
                $username=sqlesc($username,false);
                

                $password=$this->input->post('password');
                $password=sqlesc($password,false);
                
                $remember_me=$this->input->post('remember_me');
                $remember_me=sqlesc($remember_me,false);
                

                
                if($username=="" || $password==""){
                    echo "Username and pass must be filed !!!";
                    exit;
                }
                

                
                
                
                
                
                $passhash=sha1(SALT.$password);
                $passhash=sqlesc($passhash,false);
                $passdb=sha1(SALT.$passhash.$username);
                $passdb=sqlesc($passdb,false);

/*
                echo $passhash."aaa".$passdb;
                exit;
                */
                
		$query=$this->db->query("SELECT * FROM fb_users WHERE username='$username'");


		if($query->num_rows()==1)
		{
			$result=$query->row_array();
                        
			if($result['password']==$passdb)
			{
                            
                                $_SESSION['smp_username']=$username;
                                $_SESSION['smp_passhash']=$passhash;

                                if($remember_me){
                                    setcookie("smp_username", $username, time()+60*60*24);
                                    setcookie("smp_passhash", $passhash, time()+60*60*24);
                                }else{
                                    setcookie('smp_username', "",0x7fffffff, "/");
                                    setcookie('smp_passhash', "",0x7fffffff, "/");
                                }
                            
                            
				return;
			}
		}
		//$this->form_validation->set_message('login_check','Username and password not match!');
		echo "Username and pass not match!!!";
	}
	function user_exists($user)
	{

                $user=sqlesc($user);
            
                $sql="SELECT * from fb_users where username=$user";

		$query=$this->db->query($sql);
		if($query->num_rows()>0)
		{
			$this->form_validation->set_message('user_exists','The username alredy exists in our database, please use a different one.');
			return FALSE;
		}
		
		return TRUE;
	}
	function email_exists($email)
	{

                $email=sqlesc($email);
            
                $sql="SELECT * from fb_users where email=$email";

		$query=$this->db->query($sql);
		if($query->num_rows()>0)
		{
			$this->form_validation->set_message('email_exists','The email alredy exists in our database, please use a different one.');
			return FALSE;
		}
		
		return TRUE;
                
                
                
	}
        
        
	function gender_empty($gender)
	{

		if($gender=='0')
		{
			$this->form_validation->set_message('gender_empty','Morate popuniti polje "pol".');
			return FALSE;
		}
		return TRUE;
	}

	function year_empty($year)
	{
		$day=$this->input->post('day');
		$month=$this->input->post('month');

		if($day=='0' || $month=='0' || $year=='0')
		{
			$this->form_validation->set_message('year_empty','Morate popuniti datum rođenja.');
			return FALSE;
		}
		return TRUE;
	}
        
        
	function img_upload_check()
	{
            
                $str_error="";
            
                    $allowedExts = array("gif", "jpeg", "jpg", "png");
                    $extension = end(explode(".", $_FILES["file"]["name"]));
                    if ((($_FILES["file"]["type"] == "image/gif")
                    || ($_FILES["file"]["type"] == "image/jpeg")
                    || ($_FILES["file"]["type"] == "image/jpg")
                    || ($_FILES["file"]["type"] == "image/png"))
                    && ($_FILES["file"]["size"] < (1024*1024))
                    && in_array($extension, $allowedExts)
      
                    )
                      {
                      if ($_FILES["file"]["error"] > 0)
                        {
                       $str_error= $_FILES["file"]["error"];
                        }
                      else
                        {
                        }
                      }
                    else
                      {
                      $str_error= "Invalid file";
                      }
                      
                      if($str_error==""){
                          $info = getimagesize($_FILES["file"]['tmp_name']);
                          if($info[0]<200 || $info[1]<200){
                              $str_error="minimalna širina i visina slike mora biti 200px";
                          }
                      }
                      
                      
		if($str_error!="")
		{
			$this->form_validation->set_message('img_upload_check', $str_error);
			return FALSE;
		}
		return TRUE;
                      
                      
                      
                      
		
	}
        
        
        
	function fb_redirect_url()
	{
            echo '<script type="text/javascript">window.top.location.href="'.base_url().'"</script>';
	}
        
        
        
        
        
	function twitter_redirect()
	{
        
            
            
                if (CONSUMER_KEY === '' || CONSUMER_SECRET === '' || CONSUMER_KEY === 'CONSUMER_KEY_HERE' || CONSUMER_SECRET === 'CONSUMER_SECRET_HERE') {
                  echo 'You need a consumer key and secret to test the sample code. Get one from <a href="https://dev.twitter.com/apps">dev.twitter.com/apps</a>';
                  exit;
                }
            
            
            
            
                /* Build TwitterOAuth object with client credentials. */
                $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);

                /* Get temporary credentials. */
                $request_token = $connection->getRequestToken(OAUTH_CALLBACK);

                /* Save temporary credentials to session. */
                $_SESSION['oauth_token'] = $token = $request_token['oauth_token'];
                $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

                /* If last connection failed don't display authorization link. */

                switch ($connection->http_code) {
                  case 200:
                    /* Build authorize URL and redirect user to Twitter. */
                    $url = $connection->getAuthorizeURL($token);
                    header('Location: ' . $url); 
                    break;
                  default:
                    /* Show notification if something went wrong. */
                    echo 'Could not connect to Twitter. Refresh the page or try again later.';
                }
	}
        
        
        
        
        
        
        
        
        
        
        
        
        
	function twitter_redirect_url()
	{

        
                /**
                 * @file
                 * Take the user when they return from Twitter. Get access tokens.
                 * Verify credentials and redirect to based on response from Twitter.
                 */


                //session_start();


                /* If the oauth_token is old redirect to the connect page. */
                if (isset($_REQUEST['oauth_token']) && $_SESSION['oauth_token'] !== $_REQUEST['oauth_token']) {
                  $_SESSION['oauth_status'] = 'oldtoken';

                  $this->logout();

                }

                /* Create TwitteroAuth object with app key/secret and token key/secret from default phase */
                $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

                /* Request access tokens from twitter */
                $access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);

                /* Save the access tokens. Normally these would be saved in a database for future use. */
                $_SESSION['access_token'] = $access_token;

                /* Remove no longer needed request tokens */
                unset($_SESSION['oauth_token']);
                unset($_SESSION['oauth_token_secret']);

                /* If HTTP response is 200 continue otherwise send to connect page to retry */
                if (200 == $connection->http_code) {
                  /* The user has been verified and the access tokens can be saved for future use */
                  $_SESSION['status'] = 'verified';
                  //26-07-2013 dodat controler 'proba' u rediredt()
                  redirect('/proba');
                } else {
                  /* Save HTTP status for error dialog on connnect page.*/
                    $this->logout();
                }
        
        
        
        
        }   
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
	function user_exists_edit($user2)
	{

            global $user;
            $id=0+$user["id"];
            
                $user2=sqlesc($user2);
            
                $sql="SELECT * from fb_users where username=$user2 AND id<>$id";

		$query=$this->db->query($sql);
		if($query->num_rows()>0)
		{
			$this->form_validation->set_message('user_exists_edit','The username alredy exists in our database, please use a different one.');
			return FALSE;
		}
		
		return TRUE;
	}
	function email_exists_edit($email)
	{

            global $user;
            $id=0+$user["id"];
            
            
            
                $email=sqlesc($email);
            
                
                
                
                
                $sql="SELECT * from fb_users where email=$email and id<>$id";

		$query=$this->db->query($sql);
		if($query->num_rows()>0)
		{
			$this->form_validation->set_message('email_exists_edit','The email alredy exists in our database, please use a different one.');
			return FALSE;
		}
		
		return TRUE;
                
    
	}
        
        
        
        
        
 
        
        
        
        
        
        
        
 	function sections_edit()
	{
            
            
            global $user;
            
            
            
		if (!$this->account_model->logged_in())
		{	
			redirect();
		}
            
                

                
                
                
            

                $this->load->library('head_lib');
                $data["head"]=$this->head_lib->Get("","",0,0,"account",0);             

                
                $this->load->library('profile2_lib');
                $data["profile"]=$this->profile2_lib->Get(); 
                
                
                
                
                
                
                
                
                
                $this->load->library('account/sections_edit_lib');
                $data["glavna"]=$this->sections_edit_lib->Get(); 
                
                
                
                
                
                
                
                
                

                $this->load->library('footer_lib');
                $data["footer"] = $this->footer_lib->Get();   
                
                
                $this->load->library('foot_lib');
                $data["foot"] = $this->foot_lib->Get(); 


                $this->load->view('register_homepage',$data);
    
	}
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
} 
?>