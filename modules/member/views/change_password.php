<?php $this->load->view('home/layout/header'); ?>

	<main id="member" role="main">
		<div class="bg-light py-5">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-6 col-12 bg-white p-3">
						<h3 class="page-title mb-1"><?php echo $page["title"] ?></h3>
						<?php echo form_open("", array("id" => "form_login", "class" => "form-login")); ?>
							<?php
								$data = array(
									'name' => 'sk',
									'type' => 'hidden',
									'value' => $this->input->get("sk")
								);
								echo form_input($data);
							?>
							<p>Kullanmak istediğiniz yeni şifrenizi giriniz.</p>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-envelope"></i></span></div>
									<?php
										$data = array(
											'class' => 'form-control',
											'name' => 'password',
											'id' => 'password',
											'type' => 'password',
											'placeholder' => "Yeni Şifre",
											'pattern' => ".{6,}",
											'title' => "minimum 6 karakter",
											'required' => 'required'
										);
										echo form_input($data);
									?>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-envelope"></i></span></div>
									<?php
										$data = array(
											'class' => 'form-control',
											'name' => 'password2',
											'id' => 'password2',
											'type' => 'password',
											'placeholder' => "Yeni Şifre (Tekrar)",
											'pattern' => ".{6,}",
											'title' => "minimum 6 karakter",
											'required' => 'required'
										);
										echo form_input($data);
									?>
								</div>
							</div>
							<div class="form-group row align-items-center">
								<div class="col-12">
									<?php
										$data = array(
											'class' => 'btn btn-default btn-block',
											'type' => 'submit',
											'value' => 'DEĞİŞTİR'
										);
										echo form_input($data);
									?> 
								</div>
							</div>
							<hr />
							<span class="float-right"><a href="<?php echo base_url("member/login"); ?>"><i class="fa fa-angle-double-left mr-1"></i>Geri Dön</a></span>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</main>
	
<?php $this->load->view('home/layout/footer'); ?>