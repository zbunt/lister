<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

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

	public function index(){

                $this->load->library('html/head_lib');
                $data["head"]=$this->head_lib->Get();   

                $this->load->library('html/popups_lib');
                $data["popups"]=$this->popups_lib->Get();   
                
                /*
                $params = array('id_sections' => $id_sections);
                $this->load->library('menu_lib', $params);
                $menu = $this->menu_lib;
                $params = array('menu' => $menu);
                $this->load->library('header_lib', $params);
                 */
                
                $this->load->library('html/header_lib');
                $header=$this->header_lib; 
                $data['header'] = $header->show_header();
                

                
                $data["themes"]="";
                $query = $this->themes_model->getAllThemesIDS();
                if($query){
                    foreach ($query->result_array() as $row){
                        $id=0+$row['id'];
                        $theme = new Themes_lib($id);
                        
                        if($theme->is_active){
                            $data_theme["theme"]=$theme;
                            $data["themes"].= $this->load->view('html/homepage/theme_homepage',$data_theme,true);
                        }  
                    } 
                }

		$this->load->view('main',$data);
  
        }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */