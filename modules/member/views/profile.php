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
											'value' => @get_member_session("name"),
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
											'value' => @get_member_session("surname"),
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
											'value' => @get_member_session("phone"),
										);
										echo form_input($data);
									?>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-map-marker"></i></span></div>
									<select class="form-control" name="city" id="city" required="required">
										<option value="">Şehir Seçiniz</option>
										<?php foreach(all_cities() as $city): ?>
											<option value="<?php echo $city->city_id ?>" <?php echo(@get_member_session("city")==$city->city_id)?"selected":""; ?>><?php echo $city->title ?></option>
										<?php endforeach; ?>
									</select>
									<select class="form-control" id="town" name="town" required="required">
										<option value="">İlçe Seçiniz</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-home"></i></span></div>
									<?php
										$data = array(
											'class' => 'form-control',
											'name' => 'address',
											'id' => 'address',
											'placeholder' => "Adres",
											'value' => @get_member_session("address"),
										);
										echo form_textarea($data);
									?>
								</div>
							</div>
							<hr>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-lock"></i></span></div>
									<?php
										$data = array(
											'class' => 'form-control',
											'name' => 'old_password',
											'id' => 'old_password',
											'type' => 'password',
											'placeholder' => "Eski Şifre"
										);
										echo form_input($data);
									?>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-lock"></i></span></div>
									<?php
										$data = array(
											'class' => 'form-control',
											'name' => 'password',
											'id' => 'password',
											'type' => 'password',
											'pattern' => ".{6,}",
											'title' => "minimum 6 karakter",
											'placeholder' => "Yeni Şifre"
										);
										echo form_input($data);
									?>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-lock"></i></span></div>
									<?php
										$data = array(
											'class' => 'form-control',
											'name' => 'password2',
											'id' => 'password2',
											'type' => 'password',
											'pattern' => ".{6,}",
											'title' => "minimum 6 karakter",
											'placeholder' => "Yeni Şifre (Tekrar)"
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
											'value' => 'GÜNCELLE'
										);
										echo form_input($data);
									?> 
								</div>
							</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</main>
	
<?php $this->load->view('home/layout/footer'); ?>

<script>
$(document).ready(function(){
	var town_id = <?php echo (int) @get_member_session("town"); ?>;
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