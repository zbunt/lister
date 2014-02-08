<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Themes_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getDetailsForThemeByThemeID($id){
										 
		
		$query = $this->db->get_where('themes', array('id' => $id));
		
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
        
        public function getAllThemesIDS()
        {
            $this->db->select('id');
            $this->db->order_by("sort_homepage", "asc"); 
            $query = $this->db->get_where('themes');
            
            if ($query->num_rows() > 0)
            {
                    return $query;
            }else{
                    return FALSE;
            }
        }
        
        public function getAllTopListsIDS()
        {
            $this->db->select('id');
            $this->db->order_by("sort_homepage", "asc"); 
            $query = $this->db->get_where('themes',array('top_list' => '1'));
            
            if ($query->num_rows() > 0)
            {
                    return $query;
            }else{
                    return FALSE;
            }
        }
        
        
        //is_in_top_list
        
        
}
?>