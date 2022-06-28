<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		// Yönetim paneli kullanıcı girişi kontrolü
		if (! isset($this->session->userdata['logged_in'])) { redirect('/admin/login', 'refresh'); }
		
		$this->load->model('department/Admin_model');
	}
	
	public function index()
	{
		$id = (int)($this->uri->segment(4));
		$this->data['page'] = $this->Admin_model->page($id);
		foreach ($this->data['page'] as $item){
			$item->child = $this->Admin_model->subCount($item->id);
		};
        $this->load->view('department/admin/admin', $this->data);
    }
	
	public function add_record()
	{
		if($_POST){
			$id = (int)($this->uri->segment(4));
			$add_id = $this->Admin_model->add_record($id, $this->input->post()['tr']);
			$this->session->set_flashdata("success_message", "Kayıt işlemi başarılı!");
			redirect('/department/admin/index/'.$id, 'location');
		}else{
			$this->load->view('department/admin/add_record');
		}
	}
	
	public function delete_record()
	{
		$id = (int)($this->uri->segment(4));
		$this->Admin_model->delete_record($id);
		$this->session->set_flashdata("success_message", "Silme işlemi başarılı!");
		redirect('/department/admin/index', 'refresh');
	}
	
	public function edit_record()
	{
		if($_POST){
			$id = (int)($this->uri->segment(4));
			
			$this->Admin_model->edit_record($id, $this->input->post('tr', false));
			
			$this->session->set_flashdata("success_message", "Düzenleme başarılı!");
			redirect('department/admin/edit_record/'.$id, 'location');
		}else{
			$id = (int)($this->uri->segment(4));
			$this->data['page']['tr'] = (array) $this->Admin_model->record($id);
			
			$this->load->view('department/admin/edit_record', $this->data);
		}
	}
}