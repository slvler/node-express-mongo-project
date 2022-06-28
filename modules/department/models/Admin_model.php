<?php
class Admin_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
	}
	
    public function page($id)
	{
        $this->db->select('*');
        $this->db->where('parent', $id);
		$this->db->order_by('id asc');
		$records = $this->db->get('department');
		return $records->result();
	}
	
	public function records()
	{
        $this->db->select('*');
		$this->db->order_by('id asc');
		$records = $this->db->get('department');
		return $records->result();
    }
	
	public function subCount($parent)
	{
		$this->db->where('parent',$parent);
		$this->db->from('department');
		$child = $this->db->count_all_results();
		return $child;
    }
	
	public function add_record($id, $post)
    {
        $this->db->set('title', $post['title']);
        $this->db->set('parent', $post['parent']);
        $this->db->insert('department');
        $insert_id = $this->db->insert_id();
        
        return $insert_id;
	}

	public function edit_record($id, $data)
	{
		$update_data = array();
		if(isset($data['title'])) $update_data['website'] = $data['website'];
		if(isset($data['parent'])) $update_data['username'] = $data['username'];
		$this->db->where('id',$id);
		return $this->db->update('department', $update_data);
	}
	
    public function delete_record($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('department');
		
		return true;
    }
	
    public function record($id)
	{
		$this->db->select('*');
		$this->db->where('id',$id);
		$record = $this->db->get('department');
		return $record->row();
    }
}