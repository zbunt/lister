<?php

class User_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
        
                
        public function get_user($user_id)
        {
            $query = $this->db->get_where('user', array('id' => $user_id));
		
            if ($query->num_rows() > 0)
            {
                    return $query;
            }else{
                    return FALSE;
            }
            
           
        }
        
        public function getNoLikesByPostID($post_id){}
        public function getNoLikesByThemesID($theme_id){}
        public function isUserLikedPost($id_post,$id_user){}
        public function isUserLikedTheme($id_post,$id_theme){}
        public function isUserLikedComment($id_post,$id_comment){}                    

}
?>
