<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comments_lib {

	var $id;
	var $text;
	var $user_id;
	var $user_name;

	public function __construct($id = false)
	{
            if($id)
            {
		$this->CI =& get_instance();
		$this->set_id($id);
            }
	}
	
	private function set_id($id = '')
	{
		$this->id = $id;
	}

        
        
        
	public function insert_comment_post($user_id,$post_id,$text)
	{
	
	}
	
        public function delete_comment()
	{
	
	}
	
}

