<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Themes_lib {

	var $CI;
	var $id;
	var $name;
	var $type;
	var $is_top_list;
	var $created_date;
	var $expires_date;
	var $is_visible_countdown;
        var $is_active;
	var $background_picture;
	var $size;
	var $posts_ids;

	var $sort_homepage;	
	var $no_of_likes;
	var $no_of_posts;

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
            $query = $this->CI->themes_model->getDetailsForThemeByThemeID($this->id);

            if($query)
            {                    
                foreach ($query->result() as $row) 
                {
                    $this->name = $row->name;
                    $this->type = $row->type;
                    $this->is_top_list = ($row->top_list == 1)? true: false;
                    $this->created_date = $row->created_date;
                    $this->expires_date = $row->expires_date;
                    $this->is_visible_countdown = ($row->is_visible_countdown == 1)? true: false;
                    $this->background_picture = $this->CI->config->base_url() . "uploads/themes/" . $row->picture;
                    $this->size = $row->size;
                    $this->sort_homepage = $row->sort_homepage;
                    $this->is_active = $row->is_active;
                }           
            }
	    
            //posts IDS
            $query = $this->CI->posts_model->getAllPostsIDSByThemesID($this->id);
            
            if($query)
            {
                foreach ($query->result() as $row)
                {
                    $this->posts_ids[] = $row->id;
                }                
                $this->no_of_posts = count($this->posts_ids);
            }
            else
            {
                $this->posts_ids = false;
                $this->no_of_posts = 0;
            }                                    
	}
	
}

