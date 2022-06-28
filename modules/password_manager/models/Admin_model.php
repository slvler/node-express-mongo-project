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
		$this->db->order_by('id asc');
		$records = $this->db->get('password_manager');
		return $records->result();
    }
	
	public function add_record($id, $post)
    {
        $this->db->set('title', $post['title']);
        $this->db->set('website', $post['website']);
        $this->db->set('email', $post['email']);
        $this->db->set('username', $post['username']);
        $this->db->set('password', $post['password']);
        $this->db->set('notes', $post['notes']);
        $this->db->set('type', $post['type']);
        $this->db->set('pass_group', $post['pass_group']);
        $this->db->set('created_date', date("Y-m-d H-i-s"));
        $this->db->insert('password_manager');
        $insert_id = $this->db->insert_id();
        
        return $insert_id;
	}
	
	public function check_record($data)
	{
		if(isset($data['title'])) $this->db->where('title', trim($data['title']));
		if(isset($data['website'])) $this->db->where('website', trim($data['website']));
		if(isset($data['username'])) $this->db->where('username', trim($data['username']));
		$record = $this->db->get('password_manager');
		return $record->row();
	}

	public function update_record($id, $data)
	{
		$update_data = array('updated_date' => date("Y-m-d H-i-s"));
		if(isset($data['website'])) $update_data['website'] = $data['website'];
		if(isset($data['username'])) $update_data['username'] = $data['username'];
		if(isset($data['password'])) $update_data['password'] = $data['password'];
		$this->db->where('id',$id);
		return $this->db->update('password_manager', $update_data);
	}
	
    public function delete_record($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('password_manager');
		
		return true;
    }
	
    public function record($id)
	{
		$this->db->select('*');
		$this->db->where('id',$id);
		$record = $this->db->get('password_manager');
		return $record->row();
    }
	
    public function edit_record($id, $post)
	{
		$data = array(
			'title'        => $post['title'],
			'website'      => $post['website'],
			'email'        => $post['email'],
			'username'     => $post['username'],
			'password'     => $post['password'],
			'notes'        => $post['notes'],
			'type'         => $post['type'],
			'pass_group'   => $post['pass_group'],
			'updated_date' => date("Y-m-d H-i-s")
		);
			
		$this->db->where('id',$id);
		return $this->db->update('password_manager',$data);
    }
}