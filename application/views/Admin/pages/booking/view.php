<link href="<?= base_url('assets/') ?>dist/assets/plugins/custom/datatables/datatables.bundle526f.css?v=7.0.8" rel="stylesheet" type="text/css" />

<style type="text/css">
	.font-blue-in-here{
		color: #187DE4;
	}

	.font-blue-in-here:hover i.edit {
		color: #0073e9;
	}
	.font-blue-in-here:hover i.trash {
		color: #F64E60;
	}
	.alert.alert-custom{
		padding: 0.75rem 1.25rem !important;
	}
	
</style>
<!--begin::Card-->
<div class="card card-custom gutter-b">
	<div class="card-header flex-wrap py-3">
		<div class="card-title">
			<h3 class="card-label">Data Booking Order
				<span class="d-block text-muted pt-2 font-size-sm">Manage & Config Data Booking</span></h3>
			</div>
			<div class="card-toolbar">
				&nbsp;
			</div>
		</div>
		<div class="card-body">
			<!--begin: Datatable-->
			<div id="test" style="float:left">	</div>
			<table class="table table-bordered table-checkable" id="memberDtables">
				<thead>
					<tr>
						<th>Kode</th>
						<th>Nama Pemesan</th>
						<th>Tgl Main</th>
						<th>Paket Lapangan</th>
						<th>Total Harga</th>
						<th>Tanggal Pesan</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; foreach ($data['data']['result'] as $key): ?>

					<tr>
						<td><?= $key['kode_booking'] ?></td>
						<td><?= $key['nama_pemesan'] ?></td>
						<td><?= date('d M Y H:i', strtotime($key['tgl_booking'].' '.$key['jam_main'])) ?> WIB</td>
						<td><?= $key['nama_lapangan'] ?></td>
						<td>Rp. <?= number_format($key['total_harga'],0,',','.') ?></td>
						<td><?= date('d M Y H:i:s', strtotime($key['tgl_pesan'])) ?></td>
						<td>
							<?php if ($key['status_pesanan'] == 'Accept') {
								$lebel = "label-light-primary";
							}elseif ($key['status_pesanan'] == 'Pending') {
								$lebel = "label-default";
							}else{
								$lebel = "label-light-danger";
							}
							
							 ?>
							<span class="label label-lg font-weight-bold <?= $lebel ?> label-inline"><?= $key['status_pesanan'] ?></span>
						</td>
						<td class="text-center">
							<a class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" href="<?= site_url('Admin/Booking/detail/'.base64_encode($key['id_pesanan'])) ?>" title="Info Record"><i class="fas fa-info edit"></i></a>
							<!-- <a class="btn btn-sm btn-default btn-text-primary btn-hover-danger btn-icon mr-2" onclick="deleteThs(this);" data-url="<?= site_url('Admin/Member/delete/'.base64_encode($key['id_member'])) ?>" title="Delete"><i class="fas fa-trash trash"></i></a>  -->
						</td>
					</tr>
				<?php endforeach ?>

			</tbody>
		</table>
		<!--end: Datatable-->
	</div>
</div>
<!--end::Card-->
<!--begin::Page Vendors(used by this page)-->
<script src="<?= base_url('assets/') ?>dist/assets/plugins/custom/datatables/datatables.bundle526f.js?v=7.0.8"></script>
<!--end::Page Vendors-->
<!--begin::Page Scripts(used by this page)-->
<script src="<?= base_url('assets/') ?>dist/assets/js/pages/crud/datatables/basic/basic526f.js?v=7.0.8"></script>
<script type="text/javascript">
	function deleteThs(val) {
		var url = $(val).data('url');
		var conf = confirm("Hapus Data ini?");
		if (conf) {
			window.location.href = url;
		}
	}
	$(document).ready(function() {
		var table = $('#memberDtables').DataTable( {
			sDom: "<'row'<'col-sm-12'B>><'row mt-4'<'col-sm-6'l><'col-sm-6'f>>" +
			"<'row'<'col-sm-12'tr>>" +
			"<'row'<'col-sm-5'i><'col-sm-7'p>>",
			responsive: true,
			dom: 'Bfrtip',
			buttons: [
			{
				extend: 'excelHtml5',
				exportOptions: {
					columns: [0,1,2,3,4,5,6]
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [0,1,2,3,4,5,6],
					page: 'current'
				}
			},
			{
				extend: 'pdfHtml5',
				download: 'open',
				exportOptions: {
					columns: [0,1,2,3,4,5,6],
					page: 'current'
				},
				
			},
			]
		} );

		// table.buttons().container().appendTo($('.col-sm-:eq(0)', table.table().container() ));
	} );
</script>
		<!--end::Page Scripts-->