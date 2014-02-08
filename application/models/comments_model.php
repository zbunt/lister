<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Comments_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

        public function getAllCommentsByPostID($post_id)
        {
                $sql="SELECT * FROM comments inner join post2comments on post2comments.comment_id = comments.id WHERE post2comments.post_id = $post_id ";
		$query = $this->db->query($sql);
		
		if ($query->num_rows() > 0)
		{
			return $query;
		}else{
			return FALSE;
		} 
        }
        
        public function getAllCommentsIdsByPostID($post_id)
        {
                $sql="SELECT comments.id FROM comments inner join post2comments on post2comments.comment_id = comments.id WHERE post2comments.post_id = $post_id ";
		$query = $this->db->query($sql);
		
		if ($query->num_rows() > 0)
		{
			return $query;
		}else{
			return FALSE;
		} 
        }
        
        public function getAllCommentsByThemesID($theme_id)
        {
                $sql="SELECT * FROM comments inner join theme2comments on theme2comments.comment_id = comments.id WHERE theme2comments.theme_id = $theme_id ";
		$query = $this->db->query($sql);
		
		if ($query->num_rows() > 0)
		{
			return $query;
		}else{
			return FALSE;
		}
        }
        public function getAllCommentsIdsByThemesID($theme_id)
        {
                $sql="SELECT comments.id FROM comments inner join theme2comments on theme2comments.comment_id = comments.id WHERE theme2comments.theme_id = $theme_id ";
		$query = $this->db->query($sql);
		
		if ($query->num_rows() > 0)
		{
			return $query;
		}else{
			return FALSE;
		}
        }
        public function insertCommentForPost($user_id,$post_id,$date_created,$text)
        {
            $this->CI->db->set('text', $text);
            $this->CI->db->set('date_created', $date_created);
            $this->CI->db->set('user_id', $user_id);
            $this->CI->db->set('posts_id', $post_id);
            
            return $this->CI->db->insert('comments');
        }
        public function insertCommentForTopList($user_id,$themes_id,$date_created,$text)
        {
            $this->CI->db->set('text', $text);
            $this->CI->db->set('date_created', $date_created);
            $this->CI->db->set('user_id', $user_id);
            $this->CI->db->set('posts_id', $themes_id);
            
            return $this->CI->db->insert('comments');
        }
        public function deleteComment($comment_id){}


}
?>