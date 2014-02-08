<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Posts_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getDetailsForPostByPostID($id){
										 
		$sql="SELECT posts.*,themes.type FROM posts inner join themes on posts.themes_id = themes.id WHERE posts.id = $id ";
		$query = $this->db->query($sql);
		
		if ($query->num_rows() > 0)
		{
			return $query;
		}else{
			return FALSE;
		} 
	}
	
        public function getAllPostsIDSByThemesID($themes_id)
        {
            $this->db->select('id');
            $query = $this->db->get_where('posts', array('themes_id' => $themes_id));
            
            if ($query->num_rows() > 0)
            {
                    return $query;
            }else{
                    return FALSE;
            } 
        }
        
        public function getAllPostsIDSByTopListID($themes_id)
        {
            $this->db->select('id');
            $this->db->order_by("likes", "DESC"); 
            $query = $this->db->get_where('posts', array('themes_id' => $themes_id,'is_in_top_list' => '1'));
            
            if ($query->num_rows() > 0)
            {
                    return $query;
            }else{
                    return FALSE;
            } 
        }
        
	public function insertPost($tablename,$data)
	{
            /*
            $data = array(
                'title' => 'My title' ,
                'name' => 'My Name' ,
                'date' => 'My date'
            );
            */
            $this->db->insert($tablename, $data); 
	}
	public function deletePost($id)
	{
		$sql="DELETE FROM posts WHERE id = $id";
		$this->db->query($sql); 
	}
	public function updatePost()
	{
	
	}    
        public function like($post_id,$user_id)
        {
            $this->db->set('likes', 'likes+1', FALSE);
            $this->db->where('id', $post_id);
            return $this->db->update('posts');
        }
        
        
}
?>