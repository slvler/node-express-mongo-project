<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/top'); ?>
<?php $this->load->view('admin/layout/leftside'); ?>

	<div class="row heading-bg">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h5 class="txt-dark">Şifre Yöneticisi</h5>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"></div>
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
						<div class="row">
							<div class="col-md-2">
								<a href="<?php echo site_url('password_manager/admin/add_record/'.(int)($this->uri->segment(4))); ?>" class="btn btn-success btn-block">
									<i class="fa fa-plus mr-5"></i>
									Yeni Hesap Ekle
								</a>
							</div>
							<div class="col-md-2">
								<a href="<?=site_url('password_manager/admin/filezilla_import')?>" class="btn btn-default btn-block">FileZilla'dan İçe Aktar</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default card-view">
				<div class="panel-wrapper collapse in">			
					<div class="panel-body">
						<div class="table-wrap">
							<div class="table-responsive">
								<table class="table table-hover mb-0">
									<thead>
									  <tr>
										<th>Başlık</th>
										<th>Websitesi</th>
										<th>Kullanıcı Adı</th>
										<th>Şifre</th>
										<th>Departman</th>
										<th>İşlemler</th>
									  </tr>
									</thead>
									<tbody id="sortable">
									<?php foreach ($page as $item): ?>										
										<tr id="listItem_<?php echo $item->id; ?>">
											<td>
												<div class="btn-group">
													<button type="button" class="btn btn-xs btn-primary text-lowercase clipboard" data-clipboard-text="<?=$item->title?>" data-toggle="tooltip" title="Kopyala"><?=$item->title?></button>
													<?php if($item->type == 'ftp'): ?>
													<button type="button" class="btn btn-xs btn-default text-lowercase clipboard" data-clipboard-text="ftp://<?=$item->username?>:<?=entityreplace($item->password)?>@<?=$item->website?>:21/public_html" data-toggle="tooltip" title="Kopyala"><i class="fa fa-lock"></i></button>
													<?php endif; ?>
												</div>
											</td>
											<td>
												<?php if($item->website): ?>
												<button type="button" class="btn btn-xs btn-primary text-lowercase clipboard" data-clipboard-text="<?=$item->website?>" data-toggle="tooltip" title="Kopyala"><?=$item->website?></button>
												<?php endif; ?>
											</td>
											<td><button type="button" class="btn btn-xs btn-primary text-lowercase clipboard" data-clipboard-text="<?=$item->username?>" data-toggle="tooltip" title="Kopyala"><?=$item->username?></button></td>
											<td><button type="button" class="btn btn-xs btn-primary text-lowercase clipboard" data-clipboard-text="<?=entityreplace($item->password)?>" data-toggle="tooltip" title="Kopyala"><?php echo str_repeat("*", 10); ?></button></td>
											<td><?=$departments[$item->department_id]?></td>
											<td>
												<a href="<?php echo site_url('password_manager/admin/edit_record/'.$item->id); ?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Düzenle"><i class="fa fa-pencil"></i></a>										
												<a onclick="delete_confirm('<?php echo site_url('password_manager/admin/delete_record/'.$item->id); ?>')" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Sil"><i class="fa fa-trash"></i></a>
											</td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
<?php $this->load->view('admin/layout/footer'); ?>
<?php $this->load->view('admin/layout/end'); ?>
<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.6/dist/clipboard.min.js"></script>
<script>new ClipboardJS('.clipboard');</script>