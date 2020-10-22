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
			<h3 class="card-label">Data Payment Member 
				<span class="d-block text-muted pt-2 font-size-sm">Manage & Config Data Payment Member</span></h3>
			</div>
			<div class="card-toolbar">

			</div>
		</div>
		<div class="card-body">
			<!--begin: Datatable-->
			<table class="table table-bordered table-checkable" id="kt_datatable">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Member</th>
						<th>Email Member</th>
						<th>Total Bayar</th>
						<th>Tanggal Bayar</th>
						<th>Status Bayar</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; foreach ($data['data']['result'] as $key): ?>

					<tr>
						<td><?= $no++; ?></td>
						<td><?= $key['nama_member'] ?></td>
						<td><?= $key['email_member'] ?></td>
						<td class="text-right">Rp. <?= number_format($key['price'],0,',','.') ?></td>
						<td class="text-center"><?= date('d-m-Y H:i:s', strtotime($key['payment_date'])) ?></td>
						<?php 
						if ($key['status_payment'] == "Pending") { $color = "btn-primary"; } 
						elseif ($key['status_payment'] == "Accept") {$color="btn-success";}
						else{ $color = "btn-danger"; }
						?>
						<td class="text-center"><span class="btn <?= $color ?>"><?= $key['status_payment'] ?></span></td>

						<td class="text-center">
							<a class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" href="<?= site_url('Admin/Member/showInvoice/'.base64_encode($key['id_payment'])) ?>" title="Detail Payment"><i class="fas fa-info edit"></i></a>
							<!-- <a class="btn btn-sm btn-default btn-text-primary btn-hover-danger btn-icon mr-2" onclick="deleteThs(this);" data-url="<?= site_url('Admin/Court/delete/'.base64_encode($key['id_payment'])) ?>" title="Delete"><i class="fas fa-trash trash"></i></a>  -->
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
</script>
		<!--end::Page Scripts-->