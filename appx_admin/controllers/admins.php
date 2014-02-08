<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admins extends CI_Controller {

	
    function __construct() {
        
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('head');
        $this->load->library('mainmenu');
        
        global $admins;
        $this->load->library('admins_lib');
        $admins=$this->admins_lib->Get();
        
        //provera da li je ulogovan
        if (!$this->account_model->logged_in())
            {
                    redirect('login');
            }
         
    }


    public function password() {

       global $admins;

        $data["head"] = $this->head->Get();
        $data["mainmenu"] = $this->mainmenu->Get();
        
        if ($_POST) {
            
            //var_dump($_POST);
            
            $new_pass = $this->input->post('new_pass');
            $new_pass2 = $this->input->post('news_pass2');
            $old_pass = $this->input->post('old_pass');
            
            $this->form_validation->set_rules('old_pass', 'Old password', 'xss_clean|required');
            $this->form_validation->set_rules('new_pass', 'New Password', 'xss_clean|required|matches[new_pass2]');
            $this->form_validation->set_rules('new_pass2', 'Retpye Password', 'xss_clean|required');            
            
            //validacija
            if ($this->form_validation->run() == FALSE) {

                $this->load->view('admin/edit', $data);
                
            } else {

                $admin_passchacge_true = $this->account_model->change_password($admins['id'],$new_pass,$old_pass);                             
                
                if($admin_passchacge_true){
                    $data['message'] = "Password changed!!!!";
                }else{
                    $data['message'] = "Password NOT changed!!!!";
                }
                

                $this->load->view('admin/res', $data);
            }
        } else {

            

            $this->load->view('admin/edit', $data);
        }
    }
   
        
    
        
        
        
        
        
        
        
        
        
        
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */