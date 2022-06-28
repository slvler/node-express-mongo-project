<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('member/Member_model');
	}
	
	public function index()
	{
		if(isset($this->session->userdata['member_logged_in'])){
			// Üye girişi yapılmışsa profil sayfasına yönlendiriliyor
			redirect('/member/profile', 'refresh');
		}else{
			// Üye girişi yapılmamış ise giriş sayfasına yönlendiriliyor
			redirect('/member/login', 'refresh');
		}
	}
	
	public function profile()
	{
		if(isset($this->session->userdata['member_logged_in'])){
			if(@$this->input->post()["old_password"] != NULL && @$this->input->post()["password"] != NULL && @$this->input->post()["password2"] != NULL){
				// Mevcut şifre, yeni şifre ve yeni şifre tekrarı boş değil ise şifre güncelleme işlemine başlıyor
				if($this->input->post()["password"] == $this->input->post()["password2"]){
					// Şifrelerin aynı olup olmadığını kontrol ediyor
					if(md5($this->input->post()["old_password"]) == get_member_session("password")){
						// Mevcut şifre doğru ise şifreyi güncelliyor
						$this->Member_model->update(get_member_session("id"), $this->input->post(), $this->input->post()["password"]);
						
						$this->session->set_flashdata("success_message", "Profil bilgileriniz değiştirildi!");
						redirect('member/profile', 'refresh');
					}else{
						// Mevcut şifre doğru değil ise uyarı ile geri yönlendiriyor
						$this->session->set_flashdata("error_message", "Mevcut şifrenizi yanlış girdiniz. Lütfen kontrol edip tekrar deneyiniz.");
						redirect('/member/profile', 'refresh');
					}
				}else{
					// Şifreler aynı değil ise uyarı ile geri yönlendiriyor
					$this->session->set_flashdata("error_message", "Girdiğiniz şifreler birbiri ile eşleşmiyor. Lütfen kontrol edip tekrar deneyiniz.");
					redirect('/member/profile', 'refresh');
				}
			}elseif(@$this->input->post()){
				// Şifre alanları dolu değil ve diğer alanlar dolu ise sadece diğer bilgileri gönderiyor
				$this->Member_model->update(get_member_session("id"), $this->input->post());
				
				$this->session->set_flashdata("success_message", "Profil bilgileriniz değiştirildi!");
				redirect('member/profile', 'refresh');
			}
			
			$this->data['page']["title"] = "Ayarlar";
			$this->load->view('member/profile', $this->data);
		}else{
			// Üye girişi yapılmamış ise giriş sayfasına yönlendiriliyor
			redirect('/member/login', 'refresh');
		}
	}
	
	public function login()
	{
		if(! isset($this->session->userdata['member_logged_in'])){
			if($_POST){
				$data = array(
					'email' =>		$this->input->post('email'),
					'password' =>	$this->input->post('password')
				);
				$result = $this->Member_model->login($data);
				if($result != NULL){
					$result = $this->Member_model->member($result);
					if ($result != false) {
						if($result->active == 1){
							$session_data = array('email' => $result->email);
							
							$this->Member_model->login_update($result->id, $result->total_login);
							$this->session->set_userdata('member_logged_in', $session_data);
							$this->session->set_flashdata("success_message", "Giriş başarılı!");
							redirect("/", 'refresh');
						}else{
							$this->session->set_flashdata("error_message", "Üyeliğiniz pasif durumdadır. Lütfen daha sonra tekrar deneyiniz.");
							redirect('/member/login', 'refresh');
						}
					}
				}else{
					$this->session->set_flashdata("error_message", "Hatalı kullanıcı adı & şifre kombinasyonu!");
					redirect('/member/login', 'refresh');
				}
			}else{
				$this->data['page']["title"] = "Üye Girişi";
				$this->load->view('member/login', $this->data);
			}
		}else{
			// Üye girişi yapılmışsa profil sayfasına yönlendiriliyor
			redirect('/member/profile', 'refresh');
		}
	}

	public function signup()
	{
		if(! isset($this->session->userdata['member_logged_in'])){
			if($_POST){
				// Tüm mevcut üyelerin epostaları ile aynı olup olmadığını kontrol ediyor
				$control = 1;
				$members = $this->Member_model->get_member_session($this->input->post()["email"]);
				
				if(!$members){
					// Mail adresini bulamadı ise şifrelerin aynı olup olmadığını kontrol ediyor
					if($this->input->post()["password"] == $this->input->post()["password2"]){
						// Şifreler aynı ise üye kaydını yapıyor
						$this->Member_model->add_user($this->input->post());
						$this->session->set_flashdata("success_message", "Kayıt işlemi başarılı! Giriş yapabilirsiniz.");
						redirect('/member/login', 'refresh');
					}else{
						// Şifreler aynı değil ise uyarı ile geri yönlendiriyor
						$this->session->set_flashdata("error_message", "Girdiğiniz şifreler birbiri ile eşleşmiyor. Lütfen kontrol edip tekrar deneyiniz.");
						redirect('/member/signup', 'refresh');
					}
				}else{
					// Mail adresi mevcut ise uyarı ile geri yönlendiriyor
					$this->session->set_flashdata("error_message", "Mail adresiniz sistemimizde mevcut. Lütfen farklı bir mail adresi kullanın veya bizimle iletişime geçin.");
					redirect('/member/signup', 'refresh');
				}
			}else{
				$this->data['page']["title"] = "Kayıt Ol";
				$this->load->view('member/signup', $this->data);
			}
		}else{
			// Üye girişi yapılmışsa profil sayfasına yönlendiriliyor
			redirect('/member/profile', 'refresh');
		}
	}
	
	public function my_orders()
	{
		if(isset($this->session->userdata['member_logged_in'])){
			$this->data['page']["title"] = "Siparişlerim";
			$this->data["orders"] = $this->Member_model->orders();
			$this->load->view('member/my_orders', $this->data);
		}else{
			// Üye girişi yapılmamış ise giriş sayfasına yönlendiriliyor
			redirect('/member/login', 'refresh');
		}
	}

	public function forgot_password()
	{
		if(! isset($this->session->userdata['member_logged_in'])){
			if($_POST){
				$control = 0;
				$members = $this->Member_model->members();
				foreach($members as $item){
					if( $this->input->post()["email"] == $item->email ){ $control = 1; }
				}
				
				if($control == 1){
					$this->Member_model->create_secret_key($this->input->post()["email"]);
					$this->session->set_flashdata("success_message", "Şifre sıfırlama maili adresinize gönderilmiştir. Bağlantıyı tıklayarak şifrenizi sıfırlayabilirsiniz.");
					redirect('/member/forgot_password', 'refresh');
				}else{
					// Mail adresi mevcut değil ise uyarı ile geri yönlendiriyor
					$this->session->set_flashdata("error_message", "Girdiğiniz E-Mail ile ilgili bir üyelik sistemimizde mevcut değildir.");
					redirect('/member/forgot_password', 'refresh');
				}
			}else{
				$this->data['page']["title"] = "Şifremi Unuttum";
				$this->load->view('member/forgot_password', $this->data);
			}
		}else{
			// Üye girişi yapılmışsa profil sayfasına yönlendiriliyor
			redirect('/member/profile', 'refresh');
		}
	}

	public function change_password()
	{
		if(! isset($this->session->userdata['member_logged_in'])){
			if($_POST){
				if($this->input->post()["password"] == $this->input->post()["password2"]){
					$change = $this->Member_model->change_password($this->input->post()["password"], $this->input->post()["sk"]);
					if($change){
						$this->session->set_flashdata("success_message", "Şifreniz başarı ile güncellenmiştir! Giriş yapabilirsiniz.");
						redirect('/member/login', 'refresh');
					}else{
						$this->session->set_flashdata("error_message", "Bir hata oluştu! Lütfen tekrar deneyiniz.");
						redirect('/member/forgot_password', 'refresh');
					}
				}else{
					$this->session->set_flashdata("error_message", "Girdiğiniz şifreler birbiri ile eşleşmiyor. Lütfen kontrol edip tekrar deneyiniz.");
					redirect($_SERVER['HTTP_REFERER']);
				}
			}elseif($_GET){
				$this->data['page']["title"] = "Şifre Değiştir";
				$this->load->view('member/change_password', $this->data);
			}else{
				redirect('/member/forgot_password', 'refresh');
			}
		}else{
			// Üye girişi yapılmışsa profil sayfasına yönlendiriliyor
			redirect('/member/profile', 'refresh');
		}
	}
	
	public function logout()
	{
		$this->session->unset_userdata('member_logged_in', array( 'email' => '' ));
		$this->session->unset_userdata('company', array( 'company' => '' ));
		$this->session->set_flashdata("success_message", "Başarılı bir şekilde çıkış yapıldı.");
		redirect('/', 'refresh');
	}
}