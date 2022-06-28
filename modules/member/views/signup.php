<?php $this->load->view('home/layout/header'); ?>

	<main id="member" role="main">
		<div class="bg-light py-5">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-6 col-12 bg-white p-3">
						<h3 class="page-title mb-1"><?php echo $page["title"] ?></h3>
						<?php echo form_open("", array("id" => "form_login", "class" => "form-login")); ?>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user"></i></span></div>
									<?php
										$data = array(
											'class' => 'form-control',
											'name' => 'name',
											'id' => 'name',
											'type' => 'text',
											'placeholder' => "Ad",
											'required' => 'required'
										);
										echo form_input($data);
									?>
									<?php
										$data = array(
											'class' => 'form-control',
											'name' => 'surname',
											'id' => 'surname',
											'type' => 'text',
											'placeholder' => "Soyad",
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
											'name' => 'email',
											'id' => 'email',
											'type' => 'email',
											'placeholder' => "E-Posta",
											'required' => 'required'
										);
										echo form_input($data);
									?>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-phone"></i></span></div>
									<?php
										$data = array(
											'class' => 'form-control mask',
											'name' => 'phone',
											'id' => 'phone',
											'type' => 'text',
											'placeholder' => "Telefon",
											'data-mask' => "phone",
											'required' => 'required'
										);
										echo form_input($data);
									?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-12">
									<div class="form-group">
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-key"></i></span></div>
											<?php
												$data = array(
													'class' => 'form-control',
													'name' => 'password',
													'id' => 'password',
													'type' => 'password',
													'placeholder' => "Şifre",
													'pattern' => ".{6,}",
													'title' => "minimum 6 karakter",
													'required' => 'required'
												);
												echo form_input($data);
											?>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-12">
									<div class="form-group">
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-key"></i></span></div>
											<?php
												$data = array(
													'class' => 'form-control',
													'name' => 'password2',
													'id' => 'password2',
													'type' => 'password',
													'placeholder' => "Şifre (Tekrar)",
													'pattern' => ".{6,}",
													'title' => "minimum 6 karakter",
													'required' => 'required'
												);
												echo form_input($data);
											?>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group row align-items-center">
								<div class="col-12">
									<?php
										$data = array(
											'class' => 'btn btn-default btn-block',
											'type' => 'submit',
											'value' => 'KAYIT OL'
										);
										echo form_input($data);
									?> 
								</div>
							</div>
							<hr />
							Zaten üye misin? <a href="<?php echo base_url("member/login"); ?>">Giriş Yap!</a>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</main>

<?php $this->load->view('home/layout/footer'); ?>