<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/top'); ?>
<?php $this->load->view('admin/layout/leftside'); ?>

	<div class="row heading-bg">
		<div class="col-xs-12">
			<h5 class="txt-dark">Yeni Şifre Ekle</h5>
		</div>
	</div>
	<?php if (!empty ($this->session->flashdata('success_message'))): ?>
		<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<i class="zmdi zmdi-check pr-15 pull-left"></i><p class="pull-left"><?php echo $this->session->flashdata('success_message'); ?></p> 
			<div class="clearfix"></div>
		</div>
	<?php endif; ?>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default card-view">
				<div class="panel-wrapper collapse in">			
					<div class="panel-body">
						<div class="form-wrap">
							<form method="post" enctype="multipart/form-data">
								<div  class="pills-struct">
									<div class="tab-content">
										<?php foreach(all_languages() as $item): ?>
										<div id="lang_<?php echo $item->lang ?>" class="tab-pane fade <?php echo($item->default == 1)?"active in":""; ?>" role="tabpanel">
											<div class="row">											
												<div class="col-md-9 col-xs-12">
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[title]">Başlık</label>
														<input type="text" class="form-control" id="<?php echo $item->lang ?>[title]" name="<?php echo $item->lang ?>[title]" placeholder="Başlık / Site" <?php echo($item->default == 1)?'required="required"':""; ?> />
													</div>
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[website]">Websitesi</label>
														<input type="text" class="form-control" id="<?php echo $item->lang ?>[website]" name="<?php echo $item->lang ?>[website]" placeholder="Website adresi" />
													</div>
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[email]">E-posta</label>
														<input type="text" class="form-control" id="<?php echo $item->lang ?>[email]" name="<?php echo $item->lang ?>[email]" placeholder="E-posta Adresi" />
													</div>
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[username]">Kullanıcı Adı</label>
														<input type="text" class="form-control" id="<?php echo $item->lang ?>[username]" name="<?php echo $item->lang ?>[username]" placeholder="Kullanıcı Adı" />
													</div>
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[password]">Şifre</label>
														<div class="input-group mb-15">
															<input type="text" class="form-control" id="<?php echo $item->lang ?>_password" name="<?php echo $item->lang ?>[password]" placeholder="Şifre" <?php echo($item->default == 1)?'required="required"':""; ?> />
															<span class="input-group-btn">
															<button type="button" class="btn btn-default btn-anim" data-password-target="#<?php echo $item->lang ?>_password"><i class="fa fa-refresh"></i><span class="btn-text">Şifre Üret</span></button>
															</span>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[notes]">Notlar</label>
														<textarea class="form-control" id="<?php echo $item->lang ?>[notes]" name="<?php echo $item->lang ?>[notes]" placeholder="Notlar"></textarea>
													</div>
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[type]">Hesap Tipi</label>
														<input type="text" class="form-control" id="<?php echo $item->lang ?>_type" name="<?php echo $item->lang ?>[type]" placeholder="Hesap Tipi" />
													</div>
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[pass_group]">Şifre Grubu <span class="fa fa-question-circle" data-toggle="tooltip" title="Şifreyi bir gruba dahil ederek tek seferde kullanıcıya grup yetkilendirmesi yapabilirsiniz"></span></label>
														<input type="text" class="form-control" id="<?php echo $item->lang ?>[pass_group]" name="<?php echo $item->lang ?>[pass_group]" placeholder="Grup adı" />
													</div>
												</div>					
												<div class="col-md-3 col-xs-12">
												</div>
											</div>
										</div>
										<?php endforeach; ?>
									</div>
								</div>
								<div class="form-group clearfix">
									<button type="submit" class="btn btn-success pull-right">Kaydet</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
<?php $this->load->view('admin/layout/footer'); ?>
<?php $this->load->view('admin/layout/end'); ?>