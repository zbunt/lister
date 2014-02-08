<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gallery extends CI_Controller {

    function __construct() {

        parent::__construct();

        $this->load->model('sch_model');
        $this->load->model('gallery_model');
        $this->load->helper('form');
        $this->load->library('head');
        $this->load->library('mainmenu');

        global $admins;
        $this->load->library('admins_lib');
        $admins = $this->admins_lib->Get();

        //provera da li je ulogovan
        if (!$this->account_model->logged_in()) {
            redirect('login');
        }
    }

    public function del($sch_id,$pic_id){
        
        $pic_id = 0 + $pic_id;
        $sch_id = 0 + $sch_id;
        
        $result_one = $this->gallery_model->get_one_pic($pic_id);
        $pic_arr = $result_one->row();
        
        $full_name = $pic_id . "." . $pic_arr->ext;
        
        
        $result = $this->gallery_model->del($pic_id);
        
        if($result){
            
            unlink('uploads/schools/'.$sch_id . "/" . $full_name);
            
            
            
            $broj_slika_galeriji = $this->gallery_model->get_num_of_pics($sch_id);
            
            
            if($broj_slika_galeriji == 0){
                
                $this->gallery_model->set_profile_pic($sch_id,0,"");
                
            }
            
            redirect('gallery/edit/' . $sch_id);
            
        }else{
            $data['message'] = "Image not deleted!!!!";
            $this->load->view('gallery/res', $data);
            
        }        
        
    }
    
    public function profile($sch_id,$pic_id){
        
        $pic_id = 0 + $pic_id;
        $sch_id = 0 + $sch_id;
        
        $result_one = $this->gallery_model->get_one_pic($pic_id);
        $pic_arr = $result_one->row();
        
        $pic_name = $pic_id . "." . $pic_arr->ext;
        
        $result = $this->gallery_model->set_profile_pic($sch_id,$pic_id,$pic_name);
        
        if($result){
            
            redirect('gallery/edit/' . $sch_id);
            
        }else{
            $data['message'] = "Image not set!!!!";
            $this->load->view('gallery/res', $data);
            
        }
        
        
    }
    
    public function add($sch_id){
        
        $sch_id = 0 + $sch_id;

        $data["head"] = $this->head->Get();
        $data["mainmenu"] = $this->mainmenu->Get();
        $data['sch_name'] = $this->sch_model->get_name($sch_id);
        $broj_slika_galeriji = $this->gallery_model->get_num_of_pics($sch_id);
        
        
        if ($_POST) {
            
            $this->form_validation->set_rules('logo', 'logo', 'callback_slika_check');
            
            if ($this->form_validation->run() == FALSE) {
                
                echo "NEEEEEEEe";
                
                $this->load->view('gallery/add', $data);
                
            } else {
                
                $pic_id = $this->gallery_model->insert($sch_id);
                                
                $file_name = $pic_id;
                $dir_name = "uploads/schools/$sch_id/";
                
                if (!is_dir($dir_name)) {
                    mkdir($dir_name, 0777);
                }

                $config['file_name'] = $file_name;
                $config['upload_path'] = $dir_name;
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '1024';
                $this->load->library('upload', $config);

                if ($this->upload->do_upload("logo")) {

                    $this->load->library('image_lib');

                    $im['upload_data'] = $this->upload->data();

                    if ($im['upload_data']['image_width'] > 720 || $im['upload_data']['image_height'] > 720) {

                        $config2['image_library'] = 'gd2';
                        $config2['source_image'] = $im['upload_data']['full_path'];
                        $config2['create_thumb'] = FALSE;
                        $config2['maintain_ratio'] = TRUE;
                        $config2['width'] = 720;
                        $config2['height'] = 720;

                        $this->image_lib->initialize($config2);

                        if (!$this->image_lib->resize()) {
                            $error_img = $this->image_lib->display_errors();
                        } else {
                            //updejtuje ime fajla i extenziju u bazi
                            //$data['message'] .= "Logo uploadovan. krece updejt!!!!!"; 
                        }

                        $this->image_lib->clear();
                    }
                    //updejtuje ime u bazi bez obzira na velicinu,resajz itd..
                    $extenzija = substr($im['upload_data']['file_ext'],1) ;
                    $this->gallery_model->update_pic_extension($sch_id, $file_name, $extenzija);
                    
                    if($broj_slika_galeriji == 0){
                        
                        $this->gallery_model->set_profile_pic($sch_id,$pic_id,$pic_id . "." . $extenzija);
                    }
                    
                    redirect('gallery/edit/'.$sch_id);
                     
                } else {

                    $data['message'] = "Picture not uploaded!!!!!";
                    $this->load->view('gallery/res', $data);
                }
                
               
            }
            

            //$data['message'] = "Image not deleted!!!!";
            $this->load->view('gallery/add', $data);
            
        }  else {
    

            $this->load->view('gallery/add', $data);
        }
        
    }
    
    public function edit($sch_id) {

        $sch_id = 0 + $sch_id;

        $data["head"] = $this->head->Get();
        $data["mainmenu"] = $this->mainmenu->Get();
        $data['sch_name'] = $this->sch_model->get_name($sch_id);
        $data['sch_id'] = $sch_id;
        $sch_profile_pic = $this->sch_model->get_profile_pic($sch_id);

 

            $data['fields'] = "";
            $result = $this->gallery_model->get_all_pic_for_school($sch_id);
            
            $broj_slika = $result->num_rows();
            
            if($broj_slika > 0){
            
                foreach ($result->result() as $row)
                {
                    $pic_id = $row->id;
                    $pic_ext = $row->ext;

                    $pic_full_name = $pic_id .".". $pic_ext;
                    $pic_full_path = "uploads/schools/$sch_id/$pic_full_name";

                    $pic_http_path = base_url() . get_thumb($pic_full_path, 200, 150);
                    $fancybox_image = base_url() . "uploads/schools/$sch_id/$pic_full_name";

                    $data['fields'] .= '<div class="gall_item">';
                    $data['fields'] .= '<a class="fancybox" rel="group" href="'.$fancybox_image.'"><img src="'.$pic_http_path.'" width="200" height="150" /></a>';



                    $data['fields'] .= anchor(current_url() . "/#", 'Delete', 'title="Delete school" class="del_confirm" link="'.base_url() . index_page() . '/gallery/del/'.$sch_id. "/" . $pic_id.'"');

                    if($sch_profile_pic !== $pic_full_name){

                        $data['fields'] .= "<BR>" . anchor(base_url() . index_page() . "/gallery/profile/$sch_id/$pic_id", 'Set as profile picture', 'title="Set sa profile pic"');

                    }

                    $data['fields'] .= '</div>';

                }
                
            }else{
                $data['fields'] = "<h1>Please add some pictures to gallery</h1>";
            }
            
            $this->load->view('gallery/list', $data);
       
    }

   public function slika_check() {

        global $allowed_pic_ext;
        $naziv = $_FILES['logo']['name'];
        $niz = explode(".", $naziv);
        $ext = end($niz);

        if ((empty($_FILES['logo']['tmp_name'])) or (!in_array($ext, $allowed_pic_ext))) {

            $this->form_validation->set_message('slika_check', 'The %s field can not be empty and must be jpg,png,gif');
            // var_dump($str);

            return FALSE;
        }

        $info = getimagesize($_FILES["logo"]['tmp_name']);
        if ($info[0] < 220 || $info[1] < 220) {
            $this->form_validation->set_message('slika_check', 'Minmum 200px');
            return FALSE;
        }

        return TRUE;
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */