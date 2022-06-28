<?php
class Member_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
		$this->load->helper('img_upload');
		$this->load->helper('doc_upload');
    }
	
    public function all_members()
	{
		$this->db->select('*');
		$this->db->where("active", 1);
		$this->db->order_by('id desc');
		$records = $this->db->get('member');
		return $records->result();
    }
	
    public function login($data)
	{
		$this->db->select('*');
		$this->db->from('member');
		$this->db->where("email", $data['email']);
		$this->db->where("password", md5($data['password']));
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return $query->row()->id;
		} else {
			return NULL;
		}
    }
  
    public function get_member_session($email)
	{
		$this->db->select('*');
		$this->db->where('email',$email);
		$sorgu = $this->db->get('member');
		return $sorgu->row();
    }
  
    public function member($id)
	{
		$this->db->select('*');
		$this->db->where('id',$id);
		$sorgu = $this->db->get('member');
		return $sorgu->row();
    }
	
    public function members()
	{
  		$this->db->select('*');
  		$sorgu = $this->db->get('member');
  		return $sorgu->result();
    }

    public function add_user($post)
	{
		$this->db->set('email', $post['email']);
		$this->db->set('password', md5($post['password']));
		$this->db->set('name', $post["name"]);
		$this->db->set('surname', $post["surname"]);
		$this->db->set('phone', $post["phone"]);
		$this->db->set('created_date', date("Y-m-d H-i-s"));

		$this->db->insert('member');
		return true;
    }

    public function create_secret_key($email)
	{
		$secret_key = md5(date('YmdHis')."-".$email);
		$data = array( 'secret_key' => $secret_key);
		$this->db->where('email',$email);
		$this->db->update('member',$data);
		
		$this->forgot_password_mail($email, $secret_key);
    }

	public function forgot_password_mail($email, $secret_key)
	{
		$eb = 'Şifrenizi sıfırlamak için aşağıdaki bağlantıya tıklayabilirsiniz. Şifre sıfırlama talebini siz oluşturmadıysanız eğer bu maili görmezden gelebilirsiniz.';
		$eb = $eb.'<br><br><a href="'.site_url("member/change_password").'?sk='.$secret_key.'">Şifre Sıfırlama Bağlantısı</a>';
		$eb = $eb.'<br><br>'.settings("title");
			
		$config = array(
			'protocol'  => 'smtp',
			'smtp_host' => settings("smtp_host"),
			'smtp_port' => settings("smtp_port"),
			'smtp_user' => settings("smtp_user"),
			'smtp_pass' => settings("smtp_pass"),
			'mailtype'  => 'html',
			'charset'   => 'utf-8',
			'wordwrap'  => TRUE
		);

		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->initialize($config);
		$this->email->from($config['smtp_user'], settings("title"));
		$this->email->to($email);
		$this->email->subject('Şifre Sıfırlama');
		$this->email->message($eb);
		
        return $this->email->send();
    }

    public function change_password($password, $secret_key)
	{
		$data = array('password' =>  md5($password));
		$this->db->where('secret_key',$secret_key);
		$this->db->update('member',$data);
		
		return true;
    }

    public function update($id, $post, $password = NULL)
	{
		$data = array(
			'name'		=> $post['name'],
			'surname'	=> $post['surname'],
			'phone'		=> $post['phone'],
			'city'		=> $post['city'],
			'town'		=> $post['town'],
			'address'	=> $post['address']
		);
		if($password != NULL){ $data['password'] = md5($password); }
		$this->db->where('id', $id);
		$this->db->update('member',$data);
		
		return true;
    }

    public function login_update($id, $total_login)
	{
		$data = array(
			'total_login'	=> $total_login+1,
			'last_login'	=> date("Y-m-d H-i-s")
		);
		$this->db->where('id', $id);
		$this->db->update('member',$data);
		
		return true;
    }
	
    public function orders()
	{
		$this->db->select('*');
		$this->db->where('email',$this->session->userdata['member_logged_in']["email"]);
		$this->db->order_by('id desc');
		$records = $this->db->get('order');
		return $records->result_array();
    }
}