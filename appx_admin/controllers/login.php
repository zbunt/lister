<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	
    function __construct() {
        
        parent::__construct();
        $this->load->model('account_model');
        
        global $admins;
        $this->load->library('admins_lib');
        $admins=$this->admins_lib->Get();
        
    }


    public function index()
	{
            global $admins;
            $data["error_message"]="";
            
            $this->load->library('head');
            $data["head"]=$this->head->Get(); 
            
            
            if($_POST){
                
                $user = $_POST['username'];
                $pass = $_POST['password'];
                
                
                
                
                $TF = $this->account_model->login($user,$pass);
                
                //var_dump($_COOKIE);
                //var_dump($_SESSION);
                
                if($TF){
                    //$admins=$this->admins_lib->Get();
                    redirect('home');
                }else{
                    $data["error_message"]='<div id="l_error">ERROR</div>';
                }
                
                
           
            }
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
           
            
            
            
            
           
            
            $this->load->view('login',$data);
                
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */