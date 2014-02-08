<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Top_lists_lib extends Themes_lib {
    
    var $comments_ids;
    var $no_of_posts_in_top_list;
    var $no_of_comments;
    var $posts_ids_top_list;
    
    public function __construct($id = false) {
        if($id)
        {
            parent::__construct($id);
            $this->get_details_top_list($this->id);
        }
    }
	
    private function get_details_top_list($id)
    {
        //posts IDS
        $query = $this->CI->posts_model->getAllPostsIDSByTopListID($this->id);

        if($query)
        {
            foreach ($query->result() as $row)
            {
                $this->posts_ids_top_list[] = $row->id;
            }                
            $this->no_of_posts_in_top_list = count($this->posts_ids_top_list);
        }
        else
        {
            $this->posts_ids_top_list = false;
            $this->no_of_posts_in_top_list = 0;
        } 

        //comments IDS                        
        $query = $this->CI->comments_model->getAllCommentsByThemesID($this->id);

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
    
    public function insert_comment()
    {
        
    }
    
    
}

