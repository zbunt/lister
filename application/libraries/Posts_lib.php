<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Posts_lib {

	var $CI;
	var $id;
	var $name;
	var $text;
	var $item;
	var $flaged;
	var $id_user;
	var $likes;
	var $created_date;
	var $active;
	var $themes_id;
	var $comments_ids;
	var $no_of_comments;
	var $type;
        var $user_is_liked_this_post;

	public function __construct($id = false)
	{
            if($id)
            {
		$this->CI =& get_instance();
		$this->set_id($id);		                
                $this->get_details();                                
            }
	}
	
	private function set_id($id)
	{
		$this->id = $id;
	}

	private function get_details()
	{
            $query = $this->CI->posts_model->getDetailsForPostByPostID($this->id);

            if($query)
            {                    
                foreach ($query->result() as $row) 
                {
                    $this->name = $row->name;
                    $this->text = $row->text;
                    $this->item = $row->item;
                    $this->id_user = $row->id_user;
                    $this->flaged = ($row->flaged == 1)? true: false;
                    $this->likes = $row->likes;
                    $this->created_date = $row->created_date;
                    $this->active = ($row->active == 1)? true: false;
                    $this->themes_id = $row->themes_id;
                    $this->type = $row->type;                                                                                
                }           
            }
	    
            //comments IDS                        
            $query = $this->CI->comments_model->getAllCommentsIdsByPostID($this->id);
            
            if($query)
            {
                foreach ($query->result() as $row)
                {
                    $this->comments_ids[] = $row->id;
                }
                $this->no_of_comments = count($this->comments_ids);
            }
            else
            {
                $this->comments_ids = false;
                $this->no_of_comments = 0;
            }                        
            
	}
	
	public function like($user_id)
        {
            
            $date = date('Y-m-d H:i:s');
            $query = $this->CI->posts_model->like($this->id,$user_id);           
            $query2 = $this->CI->user_likes_model->insert_likes_details($user_id,$this->id,$date);
            
            if($query && $query2)
            {
                return true;
            }
            else
            {
                return false;
            }
            
        }
	public function insert_comment($user_id,$date_created,$text)
        {
            $query = $this->CI->comments_model->insertCommentForPost($user_id,$this->id,$date_created,$text);
            
            if($query)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
	
        public function is_user_liked_this_post($user_id)
        {
            return $query = $this->CI->user_likes_model->is_user_liked_post($user_id,$this->id);
            
        }
	
	public function get_username_who_posted()
        {
            $query = $this->CI->user_model->get_user($this->id_user);
            
            foreach ($query->result() as $row)
                {
                    $name = $row->first_name . " " . $row->last_name;
                }
            return $name;
        }
}

