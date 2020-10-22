<style>
	.overlay{
		display: none;
		position: fixed;
		width: 100%;
		height: 100%;
		top: 0;
		left: 0;
		z-index: 999;
		background: rgba(255,255,255,0.8) url("<?= base_url('assets/users/assets/img/loading.gif') ?>") center no-repeat;
	}
	/* Turn off scrollbar when body element has the loading class */
	ul#result.loading{
		overflow: hidden;   
	}
	/* Make spinner image visible when body element has the loading class */
	ul#result.loading .overlay{
		display: block;
	}
</style>
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

<section class="gray">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-12">
				<div class="checkout-side">

					<div class="booking-short">
						<h4>Form Search Order</h4>
						<span>Search by Kode Booking</span>
					</div>

					<div class="booking-short-side">
						<div class="accordion" id="accordionExample">
							<div class="card">
								<div class="card-header" id="CouponCode">
									<h2 class="mb-0">
										<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#couponcd" aria-expanded="false" aria-controls="couponcd">
											Search Kode Booking
										</button>
									</h2>
								</div>
								<div id="couponcd" class="collapse show" aria-labelledby="CouponCode" data-parent="#accordionExample">
									<div class="card-body">
										<div class="form-group">
											<input type="text" class="form-control" id="kode" name="kode" placeholder="Enter Kode" required="">
											<button type="button" id="submitForm" class="btn btn-black black full-width mt-2"><i class="fa fa-search"></i> Search</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-9 col-md-12 col-sm-12">
				<div class="dashboard-wrapers">
					<div class="dashboard-gravity-list">
						<h4>Booking Order</h4>
						<ul id="result">
							<div class="overlay"></div>	
							<li class="pending-booking">
								<div style="width: 100%; margin: 0 auto; text-align: center;">
									<div>
										<h5><i class="fa fa-info-circle"></i> Masukan Kode Booking terlebih dahulu</h5>
									</div>
								</div>
							</li>
						</ul>
					</div>

				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	$('#submitForm').click(()=>{
		var kode = $('#kode').val();
		if(kode == ''){
			document.getElementById('kode').focus()
			alert("Kode has been Required")
		}else{
			$.get('<?= site_url('Users/Api/loadBooking/') ?>'+kode, (res)=>{
				data = JSON.parse(res);
				$('#result').html(data.html);

			})
		}
	})
	$(document).on({
		ajaxStart: function(){
			$("ul#result").addClass("loading"); 
		},
		ajaxStop: function(){ 
			$("ul#result").removeClass("loading"); 
		}    
	});
</script>

