<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
            parent::__construct();

            $this->load->model('account_model');
            
            global $admins;                        
            $this->load->library('admins_lib');
            $admins=$this->admins_lib->Get();

            $this->load->library('head');
            $this->load->library('mainmenu');

            $this->load->database();
            $this->load->helper('url');

            $this->load->library('grocery_CRUD');
            $this->load->library('image_CRUD');
            
            if (!$this->account_model->logged_in()) {
                redirect('login');
            }
	}		
			
	function top_lists()
        {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');			
            $crud->set_table('themes');
            $crud->set_subject('teme');
            
            $crud->where('top_list','1');
            
            $crud->required_fields('name','is_active','expires_date','is_visible_countdown','type','picture','size');
            $crud->fields('name','is_active','sort_homepage');
            
            $crud->columns('name','is_active','type','picture');
            $crud->order_by('expires_date','asc');
            
            //$crud->display_as('news_image','Slika')->display_as('news_name_sr','Naslov (lat)')->display_as('news_name_ci','Naslov (cir)')->display_as('news_name_hu','Naslov (hu)')->
            //        display_as('news_datum','Datum')->display_as('news_active','Aktivna?');
           
            $crud->set_field_upload('picture','uploads/themes');
            $crud->callback_before_upload(array($this,'provera_dira'));
                                               
            $crud->callback_after_insert(array($this, 'insert_curent_date_callback'));
                                    
            $crud->add_action('All posts', '', 'admin/post_for_theme','ui-icon-plus');
            $crud->add_action('All posts in top list', '', 'admin/post_for_top_list','ui-icon-plus');
            
            $output = $crud->render();
            $data["js_files"]=$output->js_files;
            $data['css_files']=$output->css_files;
            $data['output']=$output->output;                                                                       
            $data["head"]=$this->head->Get(); 
            $data["mainmenu"]=$this->mainmenu->Get(); 
            $this->load->view('crud.php',$data);
        }	
	function comments()
        {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');			

            $crud->set_table('comments');
            $crud->set_subject('Komentari');
                        
            $crud->unset_add();
                        
            $crud->unset_edit_fields('user_id','themes_id','posts_id','date_created');
            $crud->display_as('user_id','User');
            $crud->display_as('themes_id','Top lista');
            $crud->display_as('posts_id','Post');
            
            $crud->set_relation('user_id','user','{first_name} {last_name}');
            $crud->set_relation('themes_id','themes','name');
            $crud->set_relation('posts_id','posts','name');
                                      
            $crud->field_type('themes_id', 'readonly');
            
            $output = $crud->render();

            $data["js_files"]=$output->js_files;
            $data['css_files']=$output->css_files;
            $data['output']=$output->output;                                                                       
            $data["head"]=$this->head->Get(); 
            $data["mainmenu"]=$this->mainmenu->Get(); 

            $this->load->view('crud.php',$data);
        }	
	
	function teme()
	{
            
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');			
            $crud->set_table('themes');
            $crud->set_subject('teme');
            
            $crud->where('top_list','0');
            
            $crud->required_fields('name','is_active','expires_date','is_visible_countdown','type','picture','size');
            $crud->fields('name','is_active','expires_date','is_visible_countdown','type','picture','size','sort_homepage');
            
            $crud->columns('name','is_active','expires_date','type','picture','size');
            $crud->order_by('expires_date','asc');
            
            //$crud->display_as('news_image','Slika')->display_as('news_name_sr','Naslov (lat)')->display_as('news_name_ci','Naslov (cir)')->display_as('news_name_hu','Naslov (hu)')->
            //        display_as('news_datum','Datum')->display_as('news_active','Aktivna?');
           
            $crud->set_field_upload('picture','uploads/themes');
            $crud->callback_before_upload(array($this,'provera_dira'));
                                               
            $crud->callback_after_insert(array($this, 'insert_curent_date_callback'));
            
            
            $crud->add_action('Make Top List', '', 'admin/make_top_list','ui-icon-check');
            $crud->add_action('All posts', '', 'admin/post_for_theme','ui-icon-plus');
            
            $output = $crud->render();
            $data["js_files"]=$output->js_files;
            $data['css_files']=$output->css_files;
            $data['output']=$output->output;                                                                       
            $data["head"]=$this->head->Get(); 
            $data["mainmenu"]=$this->mainmenu->Get(); 
            $this->load->view('crud.php',$data);			
	}
        
        function make_top_list($themes_id)
        {
            //echo $themes_id;
            
            //check if posts are selected for top list
            $this->db->select('id');
            $query = $this->db->get_where('posts', array('themes_id' => $themes_id, 'is_in_top_list' => '1'));
            
            if ($query->num_rows() > 0)
            {
                    $check = true;
            }else{
                    $check = false;
            } 
            
            //var_dump($check);
            
            if($check)
            {
                $data = array(
                            'top_list' => '1'
                        );

                $this->db->where('id', $themes_id);
                $this->db->update('themes', $data); 
                
                redirect('admin/top_lists');
            }
            else
            {
                echo 'Izaberite postove za top liste';
            }
        }
        
        function insert_curent_date_callback($post_array,$primary_key)
        {
            $user_logs_insert = array(
                "created_date" => date('Y-m-d H:i:s')
            );

            $this->db->where('id',$primary_key);                
            $this->db->update('themes',$user_logs_insert);                

            return true;
        }
        
        
	function postovi()
	{
            
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');			

            $crud->set_table('posts');
            $crud->set_subject('Postovi');
                        
            $crud->unset_add();
            
            $crud->columns('item','text','created_date','id_user','themes_id','likes','active');
            $crud->unset_edit_fields('likes','id_user','created_date','item','text','sort_in_top_list');
            
            $crud->set_relation('id_user','user','{first_name} {last_name}');
            $crud->set_relation('themes_id','themes','name');
                                           
            $crud->add_action('All comments', '', 'admin/comments_for_post','ui-icon-plus');
            
            $crud->display_as('themes_id','Tema');
            $crud->display_as('id_user','User');
            
            $output = $crud->render();

            $data["js_files"]=$output->js_files;
            $data['css_files']=$output->css_files;
            $data['output']=$output->output;                                                                       
            $data["head"]=$this->head->Get(); 
            $data["mainmenu"]=$this->mainmenu->Get(); 

            $this->load->view('crud.php',$data);
			
	}	
	
        function post_for_theme($themes_id)
        {
            $crud = new grocery_CRUD();
            
            $crud->where('themes_id',$themes_id);
            
            $crud->set_theme('datatables');			

            $crud->set_table('posts');
            $crud->set_subject('Postovi');
                        
            $crud->unset_add();
            
            $crud->columns('item','text','created_date','id_user','themes_id','likes','active');
            $crud->unset_edit_fields('likes','id_user','created_date','item','text','sort_in_top_list');
            
            $crud->set_relation('id_user','user','{first_name} {last_name}');
            $crud->set_relation('themes_id','themes','name');
                                           
            $crud->add_action('All comments', '', 'admin/comments_for_post','ui-icon-plus');
            
            $crud->display_as('themes_id','Tema');
            $crud->display_as('id_user','User');
            
            $output = $crud->render();

            $data["js_files"]=$output->js_files;
            $data['css_files']=$output->css_files;
            $data['output']=$output->output;                                                                       
            $data["head"]=$this->head->Get(); 
            $data["mainmenu"]=$this->mainmenu->Get(); 

            $this->load->view('crud.php',$data);
        }
        
        function post_for_top_list($themes_id)
        {
            $crud = new grocery_CRUD();
            
            $crud->where('themes_id',$themes_id);
            $crud->where('is_in_top_list','1');
            
            $crud->set_theme('datatables');			

            $crud->set_table('posts');
            $crud->set_subject('Postovi');
                        
            $crud->unset_add();
            
            $crud->columns('item','text','created_date','id_user','themes_id','likes','active');
            $crud->unset_edit_fields('likes','id_user','created_date','item','text','sort_in_top_list');
            
            $crud->set_relation('id_user','user','{first_name} {last_name}');
            $crud->set_relation('themes_id','themes','name');
                                           
            $crud->add_action('All comments', '', 'admin/comments_for_post','ui-icon-plus');
            
            $crud->display_as('themes_id','Top lista');
            $crud->display_as('id_user','User');
            
            $output = $crud->render();

            $data["js_files"]=$output->js_files;
            $data['css_files']=$output->css_files;
            $data['output']=$output->output;                                                                       
            $data["head"]=$this->head->Get(); 
            $data["mainmenu"]=$this->mainmenu->Get(); 

            $this->load->view('crud.php',$data);
        }
        
        function flaged_posts()
        {
            
            $crud = new grocery_CRUD();
            
            $crud->where('flaged','1');
            
            $crud->set_theme('datatables');			

            $crud->set_table('posts');
            $crud->set_subject('Postovi');
                        
            $crud->unset_add();
            
            $crud->columns('item','text','created_date','id_user','themes_id','likes','active');
            $crud->unset_edit_fields('likes','id_user','created_date','item','text','sort_in_top_list');
            
            $crud->set_relation('id_user','user','{first_name} {last_name}');
            $crud->set_relation('themes_id','themes','name');
                                           
            $crud->add_action('All comments', '', 'admin/comments_for_post','ui-icon-plus');
            
            $crud->display_as('themes_id','Top lista');
            $crud->display_as('id_user','User');
            
            $output = $crud->render();

            $data["js_files"]=$output->js_files;
            $data['css_files']=$output->css_files;
            $data['output']=$output->output;                                                                       
            $data["head"]=$this->head->Get(); 
            $data["mainmenu"]=$this->mainmenu->Get(); 

            $this->load->view('crud.php',$data);
        }
        
        
        function provera_dira($files_to_upload,$field_info){
            if(is_dir($field_info->upload_path))
                {
                    return true;
                }
                else
                {
                    if(mkdir($field_info->upload_path, 0755, true))
                    {
                        
                    }
                    else
                    {
                        return 'I am sorry but it seems that the folder that you are trying to upload doesn\'t exist.';    
                    }
                }
        }
        
        function background_files_size_check()
        {
            
        }
	
	function comments_for_post($post_id)
        {
            
            
            $crud = new grocery_CRUD();
            
            $crud->where('posts_id',$post_id);
            
            $crud->set_theme('datatables');			

            $crud->set_table('comments');
            $crud->set_subject('Komentari');
            
            
            $crud->unset_add();
            
            
            $crud->unset_edit_fields('user_id','themes_id','posts_id','date_created');
            $crud->display_as('user_id','User');
            $crud->display_as('themes_id','Top lista');
            $crud->display_as('posts_id','Post');
            
            $crud->set_relation('user_id','user','{first_name} {last_name}');
            $crud->set_relation('themes_id','themes','name');
            $crud->set_relation('posts_id','posts','name');
                                      
            $crud->field_type('themes_id', 'readonly');
            
            $output = $crud->render();

            $data["js_files"]=$output->js_files;
            $data['css_files']=$output->css_files;
            $data['output']=$output->output;                                                                       
            $data["head"]=$this->head->Get(); 
            $data["mainmenu"]=$this->mainmenu->Get(); 

            $this->load->view('crud.php',$data);
        }
	

}