<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		// Yönetim paneli kullanıcı girişi kontrolü
		if (! isset($this->session->userdata['logged_in'])) { redirect('/admin/login', 'refresh'); }
		
		$this->load->model('password_manager/Admin_model');
		$this->load->helper('password_manager/password_manager');
		$this->data['departments'] = array();
		$departments = get_departments();
		foreach($departments as $department) {
			$this->data['departments'][$department->id] = $department->title;
		}
	}
	
	public function index()
	{
		$this->load->library('migration');
		//if ($this->migration->init_module("password_manager")) { $this->migration->current(); }
		
		$id = (int)($this->uri->segment(4));
		
		$this->data['page'] = (array) $this->Admin_model->page($id);
		$this->load->view('password_manager/admin/admin', $this->data);
	}
	
	public function add_record()
	{
		if($_POST){
			$id = (int)($this->uri->segment(4));
			$add_id = $this->Admin_model->add_record($id, $this->input->post()['tr']);
			$this->session->set_flashdata("success_message", "Kayıt işlemi başarılı!");
			redirect('/password_manager/admin/index/'.$id, 'location');
		}else{
			$this->load->view('password_manager/admin/add_record');
		}
	}
	
	public function delete_record()
	{
		$id = (int)($this->uri->segment(4));
		$this->Admin_model->delete_record($id);
		$this->session->set_flashdata("success_message", "Silme işlemi başarılı!");
		redirect('/password_manager/admin/index', 'refresh');
	}
	
	public function edit_record()
	{
		if($_POST){
			$id = (int)($this->uri->segment(4));
			
			$this->Admin_model->edit_record($id, $this->input->post('tr', false));
			
			$this->session->set_flashdata("success_message", "Düzenleme başarılı!");
			redirect('password_manager/admin/edit_record/'.$id, 'location');
		}else{
			$id = (int)($this->uri->segment(4));
			$this->data['page']['tr'] = (array) $this->Admin_model->record($id);
			
			$this->load->view('password_manager/admin/edit_record', $this->data);
		}
	}

	public function filezilla_import()
	{
		if($_FILES) {
			if($_FILES["file"]["type"] == 'text/xml') {
				$file = $_FILES['file']['tmp_name'];
				$xml = simplexml_load_file($file);
				if(isset($xml->Servers) && isset($xml->Servers->Server)) {
					$servers = $xml->Servers->Server;
					foreach($servers as $server) {
						$data = array(
							'title' => $server->Name,
							'website' => $server->Host,
							'username' => $server->User,
							'password' => base64_decode($server->Pass),
							'pass_group' => 'ftp'
						);
						
						// host ve kullanıcı adının sistemde kayıtlı olup olmadığını kontrol ediyoruz
						$data_check = array(
							'website' => $data['website'],
							'username' => $data['username']
						);
						$checked_record = $this->Admin_model->check_record($data_check);
						if($checked_record) {
							$update_record = array('password' => $data['password']);
							$this->Admin_model->update_record($checked_record->id, $update_record);
						} else {
							$this->Admin_model->add_record(0, $data);
						}
					}
					echo true;
				} else {
					echo false;
				}
			} else {
				echo false;
			}
			
			exit;
		}
		$this->load->view('password_manager/admin/tools/filezilla_import', $this->data);
	}

	public function generator()
	{
		$generated_password = generate_password();
		echo $generated_password;

	}
}