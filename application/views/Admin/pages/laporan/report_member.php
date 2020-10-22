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
	<div class="card-header row py-4">
		<div class="col-sm-6">
			<div class="card-title" >
				<h3 class="card-label">Data Member
					<span class="d-block text-muted pt-2 font-size-sm">Manage & Config Data Member</span>
				</h3>
			</div>
		</div>
		<div class="col-sm-6 ">
			<div class="card-toolbar">
				<form method="GET" action="<?= site_url('Admin/Report/member/') ?>">
					<div class="row">
						<div class="col-xl-8">
							<div id="daterange-btn" class="row">
								<div class='form-group col-xl-6 col-md-12' style="margin-bottom: 0; padding: 0 5px;">
									<input type='text' name="start" id="start" class="form-control" readonly="readonly" placeholder="Select date range" />
								</div>
								<div class='form-group col-xl-6 col-md-12' style="margin-bottom: 0; padding: 0 5px;">
									<input type='text' name="end" id="end" class="form-control" readonly="readonly" placeholder="Select date range" />
								</div>
							</div>
						</div>
						<div class='form-group col-xl-4 col-md-12' style="margin-bottom: 0; padding: 0 5px;">
							<input type='submit' class="btn btn-primary" readonly="readonly" value="Search By Date" />
						</div>
					</div>
				</form>
			</div>
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
<script src="<?= base_url('assets/') ?>dist/assets/js/pages/crud/forms/widgets/bootstrap-daterangepicker526f.js?v=7.0.8"></script>
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

<script type="text/javascript">
	$(function() {
		var months = ["01","02","03","04","05","06","07","08","09","10","11","12"];
		var today = new Date();
		tday = today.getDate() < 10 ? '0'+today.getDate() : today.getDate();
		tmonth = today.getMonth() < 10 ? '0'+today.getMonth() : today.getMonth();
		datenow = months[today.getMonth()]+'/'+tday+'/'+today.getFullYear();

		var start = moment().subtract(29, 'days');
		var end = moment();

		function cb(start, end) {
			// $('#daterange-btn span').html(start.format('DD-MMMM-YYYY') + ' - ' + end.format('DD-MMMM-YYYY'));
			document.getElementById('start').value = start.format('DD-MM-YYYY');
			document.getElementById('end').value = end.format('DD-MM-YYYY');
		}

		$('#daterange-btn').daterangepicker(
		{
			startDate: moment().subtract(29, 'days'),
			endDate: moment(),
			minDate: '01/01/2014',
			maxDate: datenow,
			dateLimit: { days: 60 },
			alwaysShowCalendars: true,
			"autoApply": true,
			ranges: {
				'Today': [moment(), moment()],
				'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
				'Last 7 Days': [moment().subtract(6, 'days'), moment()],
				'Last 30 Days': [moment().subtract(29, 'days'), moment()],
				'This Month': [moment().startOf('month'), moment().endOf('month')],
				'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
			},
			opens: 'right',
		}, cb)

		cb(start,end);
	});

</script>