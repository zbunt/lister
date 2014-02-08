<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post_ajax extends CI_Controller
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

        function like()
        {
            global $user;
            
            if($this->account_model->logged_in())
            {
                                        
                $post_id = $_POST['post_id'] + 0;

                $post = new Posts_lib($post_id);

                if($post->like($user['id']))
                {
                    echo 'ok';
                }
                else
                {
                    echo 'fail';
                }      
            
            }
        }
        
        function insert_comment()
        {            
            global $user;
            
            if(!$this->account_model->logged_in())
            {
                echo 'fail';die();
            }

            $post = new Posts_lib($post_id);
            
            $user_id = $user['id'];
            $post_id = $post_id = $_POST['post_id'] + 0;
            $date_created = date("Y-m-d H:i:s");
            $text = $_POST['text'];
            
            if($post->insert_comment($user_id,$date_created,$text))
            {
                echo 'ok';
            }
            else
            {
                echo 'fail';
            }
        }
}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */