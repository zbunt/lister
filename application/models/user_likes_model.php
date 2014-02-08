<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class User_likes_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
        
        public function insert_likes_details($user_id,$post_id,$date)
        {
            $this->db->set('user_id', $user_id);
            $this->db->set('post_id', $post_id);
            $this->db->set('date_liked', $date);
                       
            $v = $this->db->insert('user_likes');                        
            return $v;
        }
        
        public function is_user_liked_post($user_id,$post_id)
        {
            $this->db->select('id');
            
            $query = $this->db->get_where('user_likes', array('post_id' => $post_id,'user_id' => $user_id));
            
            if ($query->num_rows() > 0)
            {
                    return true;
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