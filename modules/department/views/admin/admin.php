<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/top'); ?>
<?php $this->load->view('admin/layout/leftside'); ?>

	<div class="row heading-bg">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h5 class="txt-dark">Departmanlar</h5>
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
								<a href="<?php echo site_url('department/admin/add_record/'.(int)($this->uri->segment(4))); ?>" class="btn btn-success btn-block">
									<i class="fa fa-plus mr-5"></i>
									Yeni Departman Ekle
								</a>
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
										<th class="col-md-9">Departman Adı</th>
										<th>İşlemler</th>
									  </tr>
									</thead>
									<tbody id="sortable">
									<?php foreach ($page as $item): ?>										
										<tr id="listItem_<?php echo $item->id; ?>">
											<td><?php echo $item->title; ?></td>
											<td>
												<a href="<?php echo site_url('department/admin/index/'.$item->id); ?>" class="btn btn-xs btn-primary" data-toggle="tooltip" title="Alt Departmanlar"><?php echo $item->child; ?> <i class="fa fa-level-down"></i></a>
												<a href="<?php echo site_url('department/admin/edit_record/'.$item->id); ?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Düzenle"><i class="fa fa-pencil"></i></a>										
												<a onclick="delete_confirm('<?php echo site_url('department/admin/delete_record/'.$item->id); ?>')" class="btn btn-danger btn-xs <?php echo($item->child > 0)?"disabled":""; ?>" data-toggle="tooltip" title="Sil"><i class="fa fa-trash"></i></a>
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