<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct() {
            
            parent::__construct();


            global $admins;
            $this->load->library('admins_lib');
            $admins=$this->admins_lib->Get();
            
            $this->load->library('head');
            $this->load->library('mainmenu');
        }
        
	public function index()
	{
                     
            if ($this->account_model->logged_in())
            {	                                    
                $data["head"]=$this->head->Get(); 
                $data["mainmenu"]=$this->mainmenu->Get(); 
                
                
                
                $this->load->view('main',$data);                
                
            }else{
                    redirect('login');
            }

	}
        
        public function logout(){
            
            $this->account_model->logout();
            redirect('login');
            
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */