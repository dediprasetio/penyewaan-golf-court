<style type="text/css">
	.switchbtn.paying label.switchbtn-label img {
		max-height: 100%; 
		height: auto;
	}
</style>
<?php $row = $data['data']['result']; ?>
<?php  
$daftar_hari = array(
	'Sunday' => 'Minggu',
	'Monday' => 'Senin',
	'Tuesday' => 'Selasa',
	'Wednesday' => 'Rabu',
	'Thursday' => 'Kamis',
	'Friday' => 'Jumat',
	'Saturday' => 'Sabtu'
);
$namahari = date('l', strtotime(date('d M Y', strtotime($row['time']))));
if ($daftar_hari[$namahari] == "Sabtu" || $daftar_hari[$namahari] == "Minggu") {
	$daftarHarga = $row['court']->harga_sewa_weekend;
}else{
	$daftarHarga = $row['court']->harga_sewa_weekday;
}
?>
<div class="featured-slick">
	<div class="image-cover page-title" style="background:url(<?= base_url('assets/users/') ?>assets/img/court/4.jpg) no-repeat;" data-overlay="6">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12">

					<h2 class="ipt-title"><?= $data['subtitel'] ?></h2>
					<span class="ipn-subtitle text-light"><?= $data['description'] ?></span>
				</div>
			</div>
		</div>
	</div>
</div>
<link href="<?= base_url('assets/users/') ?>assets\css\custom.css" rel="stylesheet">

<!-- =================== Sidebar Search ==================== -->
<section class="gray">
	<div class="container">
		<div class="row">
			<div class="col-lg-9 col-md-8">
				<form action="<?= site_url('Users/Booking/bookAction') ?>" method="POST" name="frmBooking">
					<!-- 1st Step Checkout -->
					<div class="checkout-wrap">

						<div class="checkout-body">
							<div class="row">

								<div class="col-lg-12 col-md-12 col-sm-12">
									<h4 class="mb-3">Form Booking Court Golf</h4>
								</div>

								<input type="text" hidden="" id="tglMain" name="tgl_main" value="<?= date('d-m-Y', strtotime($row['time'])) ?>" required="">
								<input type="text" hidden="" name="jam_main" value="<?= date('H:i', strtotime($row['time'])) ?>" required="">



								<div class="col-lg-12 col-sm-12">
									<div class="form-group">
										<label style="font-size: 16px; font-weight: bold;">Nama Lengkap<i class="req">*</i></label>
										<input type="text" required="" name="nama" class="form-control" placeholder="Masukan Nama Lengkap" value="<?= @$this->session->userdata('nama') ? $this->session->userdata('nama') : ''?>">
										<input type="text" name="kode" value="<?= @$this->session->userdata('id') ? $this->session->userdata('id') : ''?>" hidden="">
									</div>
								</div>

								<div class="col-lg-12 col-sm-12">
									<div class="form-group">
										<label style="font-size: 16px; font-weight: bold;">Email Pemesan<i class="req">*</i></label>
										<input type="email"  name="email" class="form-control" placeholder="Masukan Email Konfirmasi" value="<?= @$this->session->userdata('email') ? $this->session->userdata('email') : ''?>" required="">
									</div>
								</div>

								<div class="col-lg-12 col-sm-12">
									<div class="form-group">
										<label style="font-size: 16px; font-weight: bold;">No Telp Pemesan<i class="req">*</i></label>
										<input type="number" name="no_telp" class="form-control" placeholder="Masukan No Telephone" value="<?= @$this->session->userdata('no_telp') ? $this->session->userdata('no_telp') : ''?>" required="">
									</div>
								</div>

								<div class="col-lg-12 col-sm-12">
									<div class="form-group">
										<label style="font-size: 16px; font-weight: bold;">Alamat Pemesan<i class="req">*</i></label>
										<textarea name="alamat" rows="3" class="form-control" style="resize: none; height: 6%;" placeholder="Masukan Alamat Pemesan" required=""><?= @$this->session->userdata('alamat') ? $this->session->userdata('alamat') : ''?></textarea>
									</div>
								</div>

								<div class="col-lg-12 col-sm-12">
									<div class="form-group">
										<label style="font-size: 16px; font-weight: bold;">Paket Pemain<i class="req">*</i></label>
										<select class="form-control" id="dtcourt" onchange="changeCountPlayer(this.value)" name="dtcourt">
											<?php foreach ($row['dtcourt'] as $dtCourt): ?>
												<option <?= $dtCourt['id_detail_lapangan'] == $row['court']->id_detail_lapangan ? 'selected=""' : '' ?> value="<?= $dtCourt['id_detail_lapangan'] ?>">Paket <?= $dtCourt['banyak_penyewa'] ?> Orang</option>
											<?php endforeach ?>
										</select>
										<input type="text" name="court" value="<?= $row['court']->id_lapangan ?>" required="" readonly="" hidden="">
									</div>
								</div>


								<?php
								if (@$this->session->userdata('member')): ?>

									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
										<label class="" style="font-size: 16px; font-weight: bold;">Fasilitas Member yang di dapat</label>
									</div>
									<?php $diskon = ''; $i=0; foreach ($row['fasilitas'] as $fasilitas): ?>

									<div class="col-lg-4 col-md-6 col-sm-12 mb-3">
										<div class="switchbtn paying">
											<input checked="" id="fasilitas-<?= $i ?>" class="switchbtn-checkbox " type="radio" value="<?= $fasilitas['id_fasilitas'] ?>" name="fasilitas" >
											<label class="switchbtn-label" for="fasilitas-<?= $i ?>" style="padding: 18px 12px;">
												<div class="single-price">
													<div class="price-title">
														<h5>Fasilitas Member</h5>
													</div>
													<div class="price-tag">
														<h4>Disc. <?= $fasilitas['diskon_member'] ?>%</h4>
													</div>
													<div class="price-item">
														<ul>
															<?php 
															if (count($row['dtfasilitas']) > 0): ?>
																<?php foreach ($row['dtfasilitas'] as $key): ?>
																	<li><span style="font-weight: bold;"><?= $key['qty'] ?> pcs</span> <?= $key['deskripsi'] ?></li>
																<?php endforeach ?>
															<?php endif ?>
														</ul>
													</div>
												</div>
											</label>
										</div>
									</div>
									<?php $diskon = $fasilitas['diskon_member']; $i++; endforeach ?>
									
									<script type="text/javascript">
										$( document ).ready(function() {
											var disk = parseInt($('#diskon').val());
											var hargaLapangan = parseInt($('#subtotal').val());
											var subTotal = (hargaLapangan*disk)/100;
											$('#subdisc').val((hargaLapangan-subTotal))
										});
										
									</script>
								<?php endif ?>


								<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 ">
									<label class="" style="font-size: 16px; font-weight: bold;">Paket Sewa Alat </label>

								</div>
								<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
									<a href="javascript:;" onclick="resetPaket('Alat')"><u><i class="fas fa-trash"></i> Reset Pilihan</u></a>
								</div>

								<?php $i=0; foreach ($row['paketAlat'] as $paketAlat): ?>

								<div class="col-lg-4 col-md-6 col-sm-12 mb-3">
									<div class="switchbtn paying">
										<input onchange="selecetPaket(this.value);" id="paketAlat-<?= $i ?>" class="switchbtn-checkbox paketAlat" type="radio" value="<?= $paketAlat['id_paket'] ?>" name="paketAlat" >
										<label class="switchbtn-label" for="paketAlat-<?= $i ?>" style="padding: 18px 12px;">
											<div class="single-price">
												<div class="price-title">
													<h5><?= $paketAlat['nama_paket'] ?></h5>

												</div>
												<div class="price-tag">
													<h4>Rp. <?= number_format($paketAlat['harga_paket'],0,',','.') ?></h4>
												</div>
												<div class="price-item">
													<ul>
														<?php $dt = $paketAlat[0];
														if (count($dt) > 0): ?>
															<?php foreach ($dt as $key => $value): ?>
																<li><span style="font-weight: bold;"><?= $value['qty'] ?> pcs</span> <?= $value['deskripsi_barang'] ?></li>
															<?php endforeach ?>
														<?php endif ?>
													</ul>
												</div>
											</div>
										</label>
									</div>
								</div>
								<?php $i++; endforeach ?>

								<div class="col-lg-10 col-md-10 col-sm-10">
									<label class="" style="font-size: 16px; font-weight: bold;">Paket Sewa Mobil</label>
								</div>
								<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
									<a href="javascript:;" onclick="resetPaket('Mobil')"><u><i class="fas fa-trash"></i> Reset Pilihan</u></a>
								</div>
								<?php $i=0; foreach ($row['paketMobil'] as $paketMobil): ?>

								<div class="col-lg-4 col-md-6 col-sm-12 mb-3">
									<div class="switchbtn paying">
										<input onchange="selecetPaket(this.value);" id="paketMobil-<?= $i ?>" class="switchbtn-checkbox paketMobil" type="radio" value="<?= $paketMobil['id_paket'] ?>" name="paketMobil" >
										<label class="switchbtn-label" for="paketMobil-<?= $i ?>" style="padding: 18px 12px;">
											<div class="single-price">
												<div class="price-title">
													<h5><?= $paketMobil['nama_paket'] ?></h5>

												</div>
												<div class="price-tag">
													<h4>Rp. <?= number_format($paketMobil['harga_paket'],0,',','.') ?></h4>
												</div>
												<div class="price-item">
													<ul>
														<li><?= $paketMobil['deskripsi'] ?></li>
													</ul>
												</div>
											</div>
										</label>
									</div>
								</div>
								<?php $i++; endforeach ?>

								<div class="col-lg-12 col-sm-12">
									<div class="form-group">
										<label style="font-size: 16px; font-weight: bold;">Total Harga<i class="req">*</i></label>
										<input type="number" name="subtotal" value="<?= $daftarHarga ?>" id="subtotal" readonly="" hidden="">
										<input type="number" name="subdisc" id="subdisc" readonly="" hidden="">
										<input type="number" name="dis" value="<?= @$fasilitas['diskon_member'] ? $fasilitas['diskon_member'] : 0 ?>" id="diskon" hidden="">

										<input type="number" name="total" value="" class="form-control" id="total" readonly="">
									</div>
								</div>

								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="form-group text-center">
										<input type="submit" name="btnBook" class="btn btn-theme" value="Submit Booking">
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<!-- Sidebar End -->

			<div class="col-lg-3 col-md-4">
				<div class="checkout-side">

					<div class="booking-short">
						<img src="<?= base_url('assets/users/assets/img/court/32.jpg') ?>" class="img-fluid" alt="">
						<h4>Paket <?= $row['court']->nama_lapangan ?></h4>
						<span><?= $row['court']->deskripsi ?></span>
					</div>

					<div class="booking-short-side">
						<div class="accordion" id="accordionExample">
							<div class="card">
								<div class="card-header" id="bookinDet">
									<h2 class="mb-0">
										<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#bookinSer" aria-expanded="true" aria-controls="bookinSer">
											Booking Detail
										</button>
									</h2>
								</div>

								<div id="bookinSer" class="collapse show" aria-labelledby="bookinDet" data-parent="#accordionExample">
									<div class="card-body">
										<ul class="booking-detail-list">
											<li>Paket Lapangan <span><?= $row['court']->nama_lapangan ?></span></li>
											<li>Banyak Pemain <span id="baPemain"><?= $row['court']->banyak_penyewa ?> Pemain</span></li>
											<li>Tanggal Main<span><?= date('d M Y', strtotime($row['time'])) ?></span></li>
											<li>Jam Main<span><?= date('H:i', strtotime($row['time'])) ?> WIB</span></li>
											<li>Jenis Tamu <span><?= @$this->session->userdata('member') ? "Member" : "Non Member" ?></span></li>
										</ul>
									</div>
								</div>
							</div>


							<div class="card">
								<div class="card-header " id="PayMents">
									<h2 class="mb-0">
										<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#payser" aria-expanded="false" aria-controls="payser">
											Payment
										</button>
									</h2>
								</div>
								<div id="payser" class="collapse show" aria-labelledby="PayMents" data-parent="#accordionExample">
									<div class="card-body">
										<ul class="booking-detail-list">
											<li>Paket Lapangan <span id="biayaLapangan">Rp. <?= number_format($daftarHarga,0,',','.')  ?></span></li>
											<li id="pricePaketAlat"></li>
											<li id="pricePaketMobil"></li>
											<?php if (@$this->session->userdata('member')): ?>
												<li>Diskon <span><?= $diskon ?>%</span></li>
												<li>Paket Fasilitas <span>Rp. 0</span></li>
												
											<?php endif ?>
											<li style="border-bottom: 1px dashed black">&nbsp;</li>
											<li><b>Total Biaya</b><span id="totalBiaya"><?= "Rp. ".number_format($daftarHarga,0,',','.') ?></span></li>
										</ul>
									</div>
								</div>
							</div>

						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</section>
<!-- =================== Sidebar Search ==================== -->

<script type="text/javascript">

	var total,subTotal,disk;
	
	disk = parseInt($('#diskon').val())
	console.log(disk);

	if (disk == null || disk == "") {
		disk = 0
		total = $('#subtotal').val();
	}else{
		hargaLapangan = parseInt($('#subtotal').val());
		hitungdiskon(hargaLapangan);
	}

	function hitungdiskon(harga) {
		var sub = (harga*disk)/100;

		total = parseInt((harga-parseInt(sub)))
	}
	
	totalPaketAlat = 0;
	totalPaketMobil = 0;
	totalUs = document.getElementById('total').value;
	totalUs = totalUs + total;

	$(window).load(loaded());



	function loaded() {
		document.getElementById('total').value = totalUs;
		document.getElementById('totalBiaya').innerHTML = numbFormating(totalUs)
		document.getElementById('biayaLapangan').innerHTML = numbFormating(total)
	}

	function selecetPaket(agg) {
		$.get('<?= site_url('Api/select/court/') ?>'+agg, (res) => {
			obj = JSON.parse(res);
			data = obj.data
			if(data.status == "Alat"){
				totalUs = totalUs - totalPaketAlat
				totalPaketAlat = parseInt(data.harga_paket)
				totalUs = totalUs + totalPaketAlat
				showPaket(totalPaketAlat, data.status);
			}else{
				totalUs = totalUs - totalPaketMobil
				totalPaketMobil = parseInt(data.harga_paket)
				totalUs = totalUs + totalPaketMobil
				showPaket(totalPaketMobil, data.status);
			}
			loaded()
		});
	}	

	function showPaket(price,status) {
		let html ='';
		if(status == "Alat"){
			html = "Paket Alat <span>"+numbFormating(price)+"</span>"
			$('#pricePaketAlat').html(html);
		}else{
			html = "Paket Mobil <span>"+numbFormating(price)+"</span>"
			$('#pricePaketMobil').html(html);
		}
	}
	function resetPaket(val) {
		let html='';
		if (val == "Alat") {
			$(".paketAlat").prop("checked", false); 
			totalUs = totalUs - totalPaketAlat;
			totalPaketAlat = totalPaketAlat - totalPaketAlat;
			loaded();
			$('#pricePaketAlat').html(html);

		}else if(val == "Mobil"){
			
			$(".paketMobil").prop("checked", false); 
			totalUs = totalUs - totalPaketMobil;
			totalPaketMobil = totalPaketMobil - totalPaketMobil;
			loaded();
			$('#pricePaketMobil').html(html);

		}else{
			console.log('No One Choose')
		}

	}

	function changeCountPlayer(arg) {
		$.get('<?= site_url('Api/select/player/') ?>'+arg, (res) => {
			obj = JSON.parse(res);
			data = obj.data
			totalUs = totalUs - total;
			var tgl = $('#tglMain').val();
			tgl = tgl.split('-')
			var d = new Date(parseInt(tgl[2]),parseInt(tgl[1])-1,parseInt(tgl[0])).getDay();
			var hargaLapangan = 0
			if(d == 6 || d == 0){
				hargaLapangan = parseInt(data.harga_sewa_weekend)
			}else{
				hargaLapangan = parseInt(data.harga_sewa_weekday)
			}

			hitungdiskon(hargaLapangan);
			totalUs = totalUs + total;
			$('#subtotal').val(total)
			document.getElementById('baPemain').innerHTML = data.banyak_penyewa+" Pemain";
			loaded()

		})
	}

	function numbFormating(price) {
		return "Rp. " + parseFloat(price).toFixed(0).replace('.', ',').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
	}
	
</script>