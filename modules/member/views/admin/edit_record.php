<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/top'); ?>
<?php $this->load->view('admin/layout/leftside'); ?>

	<div class="row heading-bg">
		<div class="col-xs-12">
			<h5 class="txt-dark">Üye Düzenle</h5>
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
								<div class="row">
									<div class="col-xs-12">
										<a href="<?php echo site_url('member/admin'); ?>" class="btn btn-xs btn-default pull-right" data-toggle="tooltip" title="Üst Sayfaya Git">
											<i class="fa fa-arrow-left"></i>
										</a>
									</div>
								</div>
								<div class="row mt-20">
									<div class="col-md-6 col-xs-12">
										<div class="table-responsive">
											<table class="table table-striped txt-dark">
												<tbody>
													<tr>
														<td><strong>Ad</strong></td>
														<td class="pt-0 pb-0"><input type="text" class="form-control" name="name" value="<?php echo @$page["name"] ?>" required="required" /></td>
													</tr>
													<tr>
														<td><strong>Soyad</strong></td>
														<td class="pt-0 pb-0"><input type="text" class="form-control" name="surname" value="<?php echo @$page["surname"] ?>" required="required" /></td>
													</tr>
													<tr>
														<td><strong>E-Posta</strong></td>
														<td class="pt-0 pb-0"><input type="email" class="form-control" name="email" value="<?php echo @$page["email"] ?>" required="required" /></td>
													</tr>
													<tr>
														<td><strong>Telefon</strong></td>
														<td class="pt-0 pb-0"><input type="text" class="form-control mask" name="phone" value="<?php echo @$page["phone"] ?>" pattern=".{16,16}" data-mask="9 (999) 999 9999" /></td>
													</tr>
													<tr>
														<td><strong>Şehir</strong></td>
														<td class="pt-0 pb-0"><select class="form-control" id="city" name="city" required="required">
														<option value="">Şehir Seçiniz</option>
														<?php foreach(all_cities() as $city): ?>
															<option value="<?php echo $city->city_id ?>" <?php echo(@$page["city"]==$city->city_id)?"selected":""; ?>><?php echo $city->title ?></option>
														<?php endforeach; ?></select></td>
													</tr>
													<tr>
														<td><strong>İlçe</strong></td>
														<td class="pt-0 pb-0"><select class="form-control" id="town" name="town" required="required"><option value="">İlçe Seçiniz</option></select></td>
													</tr>
													<tr>
														<td><strong>Adres</strong></td>
														<td class="pt-0 pb-0"><textarea class="form-control" name="address" required="required"><?php echo @$page["address"] ?></textarea></td>
													</tr>
													<tr>
														<td><strong>Üyelik Tarihi</strong></td>
														<td class="pt-0 pb-0"><input type="text" class="form-control" value="<?php echo @$page["created_date"] ?>" disabled /></td>
													</tr>
													<tr>
														<td><strong>Son Giriş</strong></td>
														<td class="pt-0 pb-0"><input type="text" class="form-control" value="<?php echo @$page["last_login"] ?>" disabled /></td>
													</tr>
													<tr>
														<td><strong>Toplam Giriş</strong></td>
														<td class="pt-0 pb-0"><input type="text" class="form-control" value="<?php echo @$page["total_login"] ?>" disabled /></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="col-md-6 col-xs-12">
										<div class="form-group">
											<label class="control-label mb-10 text-left" for="password">Yeni Şifre</label>
											<input type="password" class="form-control" id="password" name="password" placeholder="Yeni bir şifre belirleyin" pattern=".{6,}" title="minimum 6 karakter" />
										</div>
										<div class="form-group clearfix">
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

<script>
$(document).ready(function(){
	var town_id = <?php echo (int) @$page["town"]; ?>;
    var data = "";
    $.ajax({
        type:"GET",
        url : "dealers/get_towns_json",
        data : "city="+$('#city').val(),
        async: false,
        success : function(response) {
			$.each(JSON.parse(response), function(key, value){
				if(town_id == value.town_id){					
					$("#town").append('<option value="'+value.town_id+'" selected>'+value.title+'</option>');
				}else{
					$("#town").append('<option value="'+value.town_id+'">'+value.title+'</option>');
				}
			});
        }
    });
	
	$('#city').change(function() {
		var data = "";
		$.ajax({
			type:"GET",
			url : "dealers/get_towns",
			data : "city="+$(this).val(),
			async: false,
			success : function(response) {
				data = response;
				return response;
			}
		});
		$('#town').html(data);
	});
});
</script>