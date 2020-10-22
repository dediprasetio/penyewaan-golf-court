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
			<h3 class="card-label">Data Member
				<span class="d-block text-muted pt-2 font-size-sm">Manage & Config Data Member</span></h3>
			</div>
			<div class="card-toolbar">
				<a href="<?= site_url('Admin/Member/form') ?>" class="btn btn-primary font-weight-bolder">
					<span class="svg-icon svg-icon-md">
						<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Design/Flatten.svg-->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<rect x="0" y="0" width="24" height="24"></rect>
								<circle fill="#000000" cx="9" cy="15" r="6"></circle>
								<path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3"></path>
							</g>
						</svg>
						<!--end::Svg Icon-->
					</span>Add  New Member
				</a>
			</div>
		</div>
		<div class="card-body">
			<!--begin: Datatable-->
			<div id="test" style="float:left">	</div>
			<table class="table table-bordered table-checkable" id="memberDtables">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Member</th>
						<th>Email</th>
						<th>No Telp</th>
						<th>Jenis Kelamin</th>
						<th>Status Member</th>
						<th>Register Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; foreach ($data['data']['result'] as $key): ?>

					<tr>
						<td><?= $no++; ?></td>
						<td><?= $key['nama_member'] ?></td>
						<td><?= $key['email'] ?></td>
						<td><?= $key['no_telp'] ?></td>
						<td><?= $key['jenis_kelamin'] ?></td>
						<td><?= $key['status_member'] ?></td>
						<td><?= date('d M Y H:i:s', strtotime($key['register_date'])) ?></td>
						<td class="text-center">
							<a class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" href="<?= site_url('Admin/Member/detail/'.base64_encode($key['id_member'])) ?>" title="Info Record"><i class="fas fa-info edit"></i></a>
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