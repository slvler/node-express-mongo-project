<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/top'); ?>
<?php $this->load->view('admin/layout/leftside'); ?>

<div class="row heading-bg">
	<div class="col-xs-12">
		<h5 class="txt-dark">Şifre Düzenle</h5>
	</div>
</div>
<?php if (!empty($this->session->flashdata('success_message'))) : ?>
	<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<i class="zmdi zmdi-check pr-15 pull-left"></i>
		<p class="pull-left"><?php echo $this->session->flashdata('success_message'); ?></p>
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
							<div class="pills-struct">
								<div class="tab-content">
									<?php foreach (all_languages() as $item) : ?>
										<div id="lang_<?php echo $item->lang ?>" class="tab-pane fade <?php echo ($item->default == 1) ? "active in" : ""; ?>" role="tabpanel">
											<div class="row">
												<div class="col-md-6 col-xs-12">
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[title]">Başlık</label>
														<input type="text" class="form-control" id="<?php echo $item->lang ?>[title]" name="<?php echo $item->lang ?>[title]" placeholder="Başlık / Site" value="<?= $page[$item->lang]['title'] ?>" <?php echo ($item->default == 1) ? 'required="required"' : ""; ?> />
													</div>
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>_website">Website</label>
														<div class="input-group mb-15">
															<input type="text" class="form-control" id="<?php echo $item->lang ?>_website" name="<?php echo $item->lang ?>[website]" placeholder="Websitesi" value="<?= $page[$item->lang]['website'] ?>" />
															<span class="input-group-btn">
																<button type="button" class="btn btn-primary btn-anim clipboard" data-clipboard-target="#<?php echo $item->lang ?>_website"><i class="fa fa-external-link"></i><span class="btn-text">Git</span></button>
															</span>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>_email">E-posta</label>
														<div class="input-group mb-15">
															<input type="text" class="form-control" id="<?php echo $item->lang ?>_email" name="<?php echo $item->lang ?>[email]" placeholder="E-posta adresi" value="<?= $page[$item->lang]['email'] ?>" />
															<span class="input-group-btn">
																<button type="button" class="btn btn-primary btn-anim clipboard" data-clipboard-target="#<?php echo $item->lang ?>_email"><i class="fa fa-clipboard"></i><span class="btn-text">Kopyala</span></button>
															</span>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>_username">Kullanıcı Adı</label>
														<div class="input-group mb-15">
															<input type="text" class="form-control" id="<?php echo $item->lang ?>_username" name="<?php echo $item->lang ?>[username]" placeholder="Kullanıcı Adı" value="<?= $page[$item->lang]['username'] ?>" />
															<span class="input-group-btn">
																<button type="button" class="btn btn-primary btn-anim clipboard" data-clipboard-target="#<?php echo $item->lang ?>_username"><i class="fa fa-clipboard"></i><span class="btn-text">Kopyala</span></button>
															</span>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>_password">Şifre</label>
														<div class="input-group mb-15">
															<input type="text" class="form-control" id="<?php echo $item->lang ?>_password" name="<?php echo $item->lang ?>[password]" placeholder="Şifre" value="<?= entityreplace($page[$item->lang]['password']) ?>" <?php echo ($item->default == 1) ? 'required="required"' : ""; ?> />
															<span class="input-group-btn">
																<button type="button" class="btn btn-default btn-anim" data-password-target="#<?php echo $item->lang ?>_password"><i class="fa fa-refresh"></i><span class="btn-text">Şifre Üret</span></button>
																<button type="button" class="btn btn-primary btn-anim clipboard" data-clipboard-target="#<?php echo $item->lang ?>_password"><i class="fa fa-clipboard"></i><span class="btn-text">Kopyala</span></button>
															</span>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[notes]">Notlar</label>
														<textarea class="form-control" style="white-space: pre;" id="<?php echo $item->lang ?>[notes]" name="<?php echo $item->lang ?>[notes]" placeholder="Notlar"><?= $page[$item->lang]['notes'] ?></textarea>
													</div>
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[type]">Hesap Tipi</label>
														<input type="text" class="form-control" id="<?php echo $item->lang ?>_type" name="<?php echo $item->lang ?>[type]" placeholder="Hesap Tipi" value="<?= $page[$item->lang]['type'] ?>" />
													</div>
													<div class="form-group">
														<label class="control-label mb-10 text-left" for="<?php echo $item->lang ?>[pass_group]">Şifre Grubu <span class="fa fa-question-circle" data-toggle="tooltip" title="Şifreyi bir gruba dahil ederek tek seferde kullanıcıya grup yetkilendirmesi yapabilirsiniz"></span></label>
														<input type="text" class="form-control" id="<?php echo $item->lang ?>_pass_group" name="<?php echo $item->lang ?>[pass_group]" placeholder="Grup adı" value="<?= $page[$item->lang]['pass_group'] ?>" />
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
								<div class="row">
									<div class="col-md-6">
										<button type="submit" class="btn btn-success pull-right">Kaydet</button>
									</div>
								</div>
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
<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.6/dist/clipboard.min.js"></script>
<script>
	new ClipboardJS('.clipboard');
</script>