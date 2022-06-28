<?php $this->load->view('home/layout/header'); ?>

	<main id="member" role="main">
		<div class="bg-light py-5">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-8 col-12 bg-white p-3">
						<h3 class="page-title mb-1"><?php echo $page["title"] ?></h3>
						<div class="list-group">
							<?php foreach($orders as $order): ?>
							<a href="javascript;;" type="button" data-toggle="modal" data-target="#ordermodal<?php echo $order["id"] ?>" class="list-group-item list-group-item-action">
								<?php echo $order["order_key"] ?> - (<?php echo date("d-m-Y",strtotime($order["date"])) ?>)
							</a>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
	
<?php $this->load->view('home/layout/footer'); ?>

<?php foreach($orders as $order): ?>
<div class="modal fade" id="ordermodal<?php echo $order["id"] ?>" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header d-block">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><?php echo $order["order_key"] ?> - (<?php echo date("d-m-Y",strtotime($order["date"])) ?>)</h4>
			</div>
			<div class="modal-body">
				<div class="accordion" id="accordion<?php echo $order["id"] ?>">
					<div class="card">
						<div class="card-header" id="heading1<?php echo $order["id"] ?>">
							<a class="d-block text-center h6 m-0" href="javascript;;" data-toggle="collapse" data-target="#collapse1<?php echo $order["id"] ?>" aria-expanded="false" aria-controls="collapse1<?php echo $order["id"] ?>">
								Sipariş Bilgileri
							</a>
						</div>
						<div id="collapse1<?php echo $order["id"] ?>" class="collapse" aria-labelledby="heading1<?php echo $order["id"] ?>" data-parent="#accordion<?php echo $order["id"] ?>">
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-hover">
										<tr><td>Sipariş Numarası</td><td><?php echo $order["order_key"]; ?></td></tr>
										<tr><td>Tutar</td><td><?php echo $this->cart->format_number($order["total"]); ?></td></tr>
										<tr><td>Tarih</td><td><?php echo $order["date"]; ?></td></tr>
										<tr><td>Sipariş Durumu</td><td><?php echo $order["status"]; ?></td></tr>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" id="heading2<?php echo $order["id"] ?>">
							<a class="d-block text-center h6 m-0" href="javascript;;" data-toggle="collapse" data-target="#collapse2<?php echo $order["id"] ?>" aria-expanded="false" aria-controls="collapse2<?php echo $order["id"] ?>">
								Teslimat Bilgileri
							</a>
						</div>
						<div id="collapse2<?php echo $order["id"] ?>" class="collapse" aria-labelledby="heading2<?php echo $order["id"] ?>" data-parent="#accordion<?php echo $order["id"] ?>">
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-hover">
										<tr><td>Ad</td><td><?php echo @$order["name"]; ?></td></tr>
										<tr><td>Soyad</td><td><?php echo @$order["surname"]; ?></td></tr>
										<tr><td>Telefon</td><td><?php echo @$order["phone"]; ?></td></tr>
										<tr><td>E-Posta</td><td><?php echo @$order["email"]; ?></td></tr>
										<tr><td>Şehir</td><td><?php echo get_city_title(@$order["city"]); ?></td></tr>
										<tr><td>İlçe</td><td><?php echo get_town_title(@$order["town"]); ?></td></tr>
										<tr><td>Adres</td><td><?php echo @$order["address"]; ?></td></tr>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" id="heading3<?php echo $order["id"] ?>">
							<a class="d-block text-center h6 m-0" href="javascript;;" data-toggle="collapse" data-target="#collapse3<?php echo $order["id"] ?>" aria-expanded="false" aria-controls="collapse3<?php echo $order["id"] ?>">
								Fatura Bilgileri
							</a>
						</div>
						<div id="collapse3<?php echo $order["id"] ?>" class="collapse" aria-labelledby="heading3<?php echo $order["id"] ?>" data-parent="#accordion<?php echo $order["id"] ?>">
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-hover">
										<tr><td>Fatura Tipi</td><td><?php echo @$order["invoice_type"]; ?></td></tr>
										<tr><td>TC Kimlik Numarası</td><td><?php echo @$order["tcno"]; ?></td></tr>
										<tr><td>Vergi Numarası</td><td><?php echo @$order["taxno"]; ?></td></tr>
										<tr><td>Vergi Dariresi</td><td><?php echo @$order["taxadministration"]; ?></td></tr>
										<tr><td>Ad</td><td><?php echo @$order["invoice_name"]; ?></td></tr>
										<tr><td>Soyad</td><td><?php echo @$order["invoice_surname"]; ?></td></tr>
										<tr><td>Telefon</td><td><?php echo @$order["invoice_phone"]; ?></td></tr>
										<tr><td>E-Posta</td><td><?php echo @$order["invoice_email"]; ?></td></tr>
										<tr><td>Şehir</td><td><?php echo get_city_title(@$order["invoice_city"]); ?></td></tr>
										<tr><td>İlçe</td><td><?php echo get_town_title(@$order["invoice_town"]); ?></td></tr>
										<tr><td>Adres</td><td><?php echo @$order["invoice_address"]; ?></td></tr>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" id="heading4<?php echo $order["id"] ?>">
							<a class="d-block text-center h6 m-0" href="javascript;;" data-toggle="collapse" data-target="#collapse4<?php echo $order["id"] ?>" aria-expanded="false" aria-controls="collapse4<?php echo $order["id"] ?>">
								Ürünler
							</a>
						</div>
						<div id="collapse4<?php echo $order["id"] ?>" class="collapse" aria-labelledby="heading4<?php echo $order["id"] ?>" data-parent="#accordion<?php echo $order["id"] ?>">
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-hover">
									<?php foreach(json_decode($order["products"], true) as $product): ?>
										<tr>
											<td>
												<a href="<?php echo get_seo_url("product/index/".$product['id']); ?>" target="_blank">
													<?php echo $product["name"]; ?>
												</a>
												<?php foreach ($product["options"] as $option_value): ?>
													<?php if($option_value != null): ?>
													<span class="ml-5">(<?php echo $option_value; ?>)</span>
													<?php endif; ?>
												<?php endforeach; ?>
											</td>
											<td><?php echo $product["qty"]; ?></td>
											<td><?php echo $this->cart->format_number($product["price"]); ?></td>
											<td><?php echo $this->cart->format_number($product["subtotal"]); ?></td>
										</tr>
									<?php endforeach; ?>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Kapat</button>
			</div>
		</div>
	</div>
</div>
<?php endforeach; ?>