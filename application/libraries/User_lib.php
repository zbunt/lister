<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_lib {

	var $id;

	public function __construct($id)
	{
		$this->CI =& get_instance();
		$this->set_id($id);
	}

	
	function set_id($id = '')
	{
		$this->id = $id;
	}


}

