<?php $row = $data['data']['result']; ?>
<!--Begin::Row-->
<div class="row">

    <div class="col-xl-4">
        <!--begin::Stats Widget 30-->
        <div class="card card-custom bg-primary card-stretch gutter-b">
            <!--begin::Body-->
            <div class="card-body">
                <span class=""><i class="fas fa-users icon-2x text-white"></i></span>
                <span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-4 d-block"><?= number_format($row['allMember'],0,',','.') ?> Member</span>
                <span class="font-weight-bold text-white font-size-sm">Total All Member</span>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Stats Widget 30-->
    </div>
    <div class="col-xl-4">
        <!--begin::Stats Widget 32-->
        <div class="card card-custom bg-dark card-stretch gutter-b">
            <!--begin::Body-->
            <div class="card-body">
                <span class=""><i class="fas fa-book icon-2x text-white"></i></span>
                
                <span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block"><?= number_format($row['sumBook'],0,',','.') ?> Book</span>
                <span class="font-weight-bold text-white font-size-sm">Total Booking Order</span>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Stats Widget 32-->
    </div>
    <div class="col-xl-4">
        <!--begin::Stats Widget 31-->
        <div class="card card-custom bg-danger card-stretch gutter-b">
            <!--begin::Body-->
            <div class="card-body">
                <span class=""><i class="fas fa-file-invoice-dollar icon-2x text-white"></i></span>
                
                <span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">Rp. <?= number_format($row['sumTotalpayment'],0,',','.') ?></span>
                <span class="font-weight-bold text-white font-size-sm">Total Income from Member Payment</span>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Stats Widget 31-->
    </div>
    
</div>
<!--End::Row-->
<!--begin::Row-->
<div class="row">
    <div class="col-lg-6 col-md-12">
        <!--begin::List Widget 3-->
        <div class="card card-custom card-stretch gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0">
                <h3 class="card-title font-weight-bolder text-dark">Member</h3>

                <div class="card-toolbar">
                    <div class="dropdown dropdown-inline">
                        <input type="hidden" id="session_grafmember" name="session_grafmember" value="tahunan">
                        
                        <button type="button" onclick="grafikMember()" id="grafik_member" class="btn btn-outline-secondary">Tahunan</button>
                    </div>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-2">
                <!--begin::Item-->
                    <div class="d-flex align-items-center mb-10">
                        <canvas id="myChart"></canvas>
                    </div>
            </div>
            <!--end::Body-->
        </div>
        <!--end::List Widget 3-->
    </div>

    <div class="col-lg-6 col-md-12">
        <!--begin::List Widget 4-->
        <div class="card card-custom card-stretch gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0">
                <h3 class="card-title font-weight-bolder text-dark">Booking Lapangan</h3>
                <div class="card-toolbar">
                    <div class="dropdown dropdown-inline">
                        <input type="hidden" id="session_grafbooking" name="session_grafbooking" value="tahunan">
                        <button type="button" onclick="grafikBooking()" id="grafik_booking" class="btn btn-outline-secondary">Tahunan</button>
                    </div>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-2">
                <div class="card-body pt-2">
                    <!--begin::Item-->
                        <div class="d-flex align-items-center mb-10">
                            <canvas id="myChartBooking"></canvas>
                        </div>
                </div>

            </div>
            <!--end::Body-->
        </div>
        <!--end:List Widget 4-->
    </div>
</div>
<!--end::Row-->

<!--begin::Row-->
<div class="row">
    <div class="col-lg-6 col-md-12">
        <!--begin::List Widget 3-->
        <div class="card card-custom card-stretch gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0">
                <h3 class="card-title font-weight-bolder text-dark">New Members</h3>

                <div class="card-toolbar">
                    <div class="dropdown dropdown-inline">
                        <a href="<?= site_url('Admin/Member') ?>" class="btn btn-light btn-sm font-size-sm font-weight-bolder text-dark-75" data-toggle="tooltip" title="See More Members" data-placement="top" aria-haspopup="true" aria-expanded="false">See More</a>
                        
                    </div>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-2">
                <!--begin::Item-->
                <?php foreach ($row['member'] as $member): ?>

                    <div class="d-flex align-items-center mb-10">
                        <!--begin::Symbol-->
                        <?php $src = $member['jenis_kelamin'] == "Laki-Laki" ? "https://preview.keenthemes.com/metronic/theme/html/demo1/dist/assets/media/svg/avatars/009-boy-4.svg" : "https://preview.keenthemes.com/metronic/theme/html/demo1/dist/assets/media/svg/avatars/006-girl-3.svg"; ?>
                        <div class="symbol symbol-40 symbol-light-success mr-5">
                            <span class="symbol-label">
                                <img src="<?= $src ?>" class="h-75 align-self-end" alt="" />
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="d-flex flex-column flex-grow-1 font-weight-bold">
                            <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg"><?= $member['nama_member'] ?> - <?= $member['no_telp'] ?></a>
                            <span class="text-muted"><?= $member['email'] ?> </span>
                        </div>
                        <!--end::Text-->
                        <!--begin::Dropdown-->
                        <div class="dropdown dropdown-inline ml-2" data-toggle="tooltip" title="Quick actions" data-placement="left">
                            <a href="#" class="btn btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ki ki-bold-more-hor"></i>
                            </a>
                            <div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right">
                                <!--begin::Navigation-->
                                <ul class="navi navi-hover">
                                    <li class="navi-header font-weight-bold py-4">
                                        <span class="font-size-lg">Choose One :</span>
                                        <i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right" title="Click to learn more..."></i>
                                    </li>
                                    <li class="navi-separator mb-3 opacity-70"></li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                            <span class="navi-text">
                                                <span class="">More Info</span>
                                            </span>
                                        </a>
                                    </li>

                                </ul>
                                <!--end::Navigation-->
                            </div>
                        </div>
                        <!--end::Dropdown-->
                    </div>
                <?php endforeach ?>
            </div>
            <!--end::Body-->
        </div>
        <!--end::List Widget 3-->
    </div>

    <div class="col-lg-6 col-md-12">
        <!--begin::List Widget 4-->
        <div class="card card-custom card-stretch gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0">
                <h3 class="card-title font-weight-bolder text-dark">New Booking Golf Hall </h3>
                <div class="card-toolbar">
                    <div class="dropdown dropdown-inline">
                        <a href="<?= site_url('Admin/Booking') ?>" class="btn btn-light btn-sm font-size-sm font-weight-bolder text-dark-75" data-toggle="tooltip" title="See More Book Hall" data-placement="top" aria-haspopup="true" aria-expanded="false">See More</a>
                    </div>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-2">
                <?php $i = 0; foreach ($row['booking'] as $booking): ?>
                    
                <!--begin::Item-->
                <div class="d-flex align-items-center <?= $i > 0 ? 'mt-10' : '' ?>">
                    <?php 
                    $checked = '';
                        if ($booking['status_pesanan'] == "Pending"){ $color = "primary"; } 
                        elseif ($booking['status_pesanan'] == "Accept") { $color = "success"; $checked = 'checked=""'; }
                        else{ $color = "danger"; }
                    ?>
                    <!--begin::Bullet-->
                    <span class="bullet bullet-bar bg-<?= $color ?> align-self-stretch"></span>
                    <!--end::Bullet-->
                    <!--begin::Checkbox-->
                    <label class="checkbox checkbox-lg checkbox-light-<?= $color ?> checkbox-inline flex-shrink-0 m-0 mx-4">
                        <input type="checkbox" name="select" value="1" disabled="" <?= $checked; ?> />
                        <span></span>
                    </label>
                    <!--end::Checkbox-->
                    <!--begin::Text-->
                    <div class="d-flex flex-column flex-grow-1">
                        <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-lg mb-1"><?= $booking['nama_pemesan'] ?> / Paket <?= $booking['nama_lapangan'] ?></a>
                        <span class="text-muted font-weight-bold">Tanggal : <?= date('d-m-Y H:i', strtotime($booking['tgl_booking'].' '.$booking['jam_main'])) ?> WIB</span>
                    </div>
                    <!--end::Text-->
                    <!--begin::Dropdown-->
                    <div class="dropdown dropdown-inline ml-2" data-toggle="tooltip" title="Quick actions" data-placement="left">
                        <a href="#" class="btn btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ki ki-bold-more-hor"></i>
                        </a>
                        <div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right">
                            <!--begin::Navigation-->
                            <ul class="navi navi-hover">
                                <li class="navi-header font-weight-bold py-4">
                                    <span class="font-size-lg">Choose One :</span>
                                    <i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right" title="Click to learn more..."></i>
                                </li>
                                <li class="navi-separator mb-3 opacity-70"></li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="">More Info</span>
                                        </span>
                                    </a>
                                </li>
                                
                            </ul>
                            <!--end::Navigation-->
                        </div>
                    </div>
                    <!--end::Dropdown-->
                </div>
                <!--end:Item-->
                <?php $i++; endforeach ?>

            </div>
            <!--end::Body-->
        </div>
        <!--end:List Widget 4-->
    </div>
</div>
<!--end::Row-->

<!--begin::Row-->
<div class="row">

    <div class="col-lg-12 col-xxl-12 order-1 order-xxl-2">
        <!--begin::Advance Table Widget 4-->
        <div class="card card-custom card-stretch gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0 py-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label font-weight-bolder text-dark">Admin Users</span>
                    <span class="text-muted mt-3 font-weight-bold font-size-sm">Manage Apps with Admin Users</span>
                </h3>
                <div class="card-toolbar">

                    <a href="<?= site_url('Admin/AdminConf/form') ?>" class="btn btn-primary font-weight-bolder font-size-sm">Create New</a>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-0 pb-3">
                <div class="tab-content">
                    <!--begin::Table-->
                    <div class="table-responsive">
                        <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID</th>
                                    <th>Nama Admin</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>No Telephone</th>
                                    <th>Status</th>
                                    <th>Level</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($row['dataAdmin'] as $key): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $key['id_admin'] ?></td>
                                    <td><?= $key['nama_admin'] ?></td>
                                    <td><?= $key['email'] ?></td>
                                    <td><?= $key['username'] ?></td>
                                    <td><?= $key['no_telp'] ?></td>
                                    <td><?= $key['status'] ?></td>
                                    <td><?= $key['level'] ?></td>
                                    <td class="text-center">
                                        <a class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" href="<?= site_url('Admin/AdminConf/form/'.base64_encode($key['id_admin'])) ?>" title="Edit Record"><i class="fas fa-edit edit"></i></a>
                                        <a class="btn btn-sm btn-default btn-text-primary btn-hover-danger btn-icon mr-2" onclick="confirm('Hapus data ini?')" href="<?= site_url('Admin/AdminConf/delete/'.base64_encode($key['id_admin']).'/'.$key['nama_admin']) ?>" title="Delete"><i class="fas fa-trash trash"></i></a> 
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </tbody>
                </table>
            </div>
            <!--end::Table-->
        </div>
    </div>
    <!--end::Body-->
</div>
<!--end::Advance Table Widget 4-->
</div>
</div>
<!--end::Row-->
<!-- ChartJs Versi 2.7.2 -->
<!-- ChartJs must be here because cant load from main.php -->
    <script src="<?= base_url('assets/') ?>dist/charjs_v280/Chart.js-2.8.0/dist/Chart.min.js"></script>
<!-- End ChartJs Versi 2.7.2 -->
<script>


//deklarasi chartjs untuk membuat grafik 2d di id mychart 
var ctx = document.getElementById('myChart').getContext('2d');

var myChart = new Chart(ctx, {
 //chart akan ditampilkan sebagai bar chart
    type: 'bar',
    data: {
     //membuat label chart
        labels: [
            <?php
                $countMember = count($data['data']['result']['grafikMemberBulan']);
                $i = 1;
                foreach($data['data']['result']['grafikMemberBulan'] as $rows){
                    if($i < $countMember){
                        echo '"'.$rows['bulan_tahun'].'",';
                    }else{
                        echo $rows['bulan_tahun'];
                    }
                }
            ?>
        ],
        datasets: [{
            label: 'Grafik Member',
            //isi chart
            data: [
                <?php
                    $countMember = count($data['data']['result']['grafikMemberBulan']);
                    $i = 1;
                    foreach($data['data']['result']['grafikMemberBulan'] as $rows){
                        if($i < $countMember){
                            echo '"'.$rows['count_member'].'",';
                        }else{
                            echo $rows['count_member'];
                        }
                    }
                ?>
            ],
            //membuat warna pada bar chart
            backgroundColor: [
                <?php
                    $countMember = count($data['data']['result']['grafikMemberBulan']);
                    $i = 1;
                    foreach($data['data']['result']['grafikMemberBulan'] as $rows){
                ?>  
                    'rgba(<?php echo rand(1,255).",".rand(1,255).",".rand(1,255); ?>, 0.2)',
                <?php
                    }
                ?>
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});


var ctx = document.getElementById('myChartBooking').getContext('2d');

var bookingChart = new Chart(ctx, {
    
    type: 'line',
    data: {
        labels: [<?php
                $countBooking = count($data['data']['result']['grafikBookingBulan']);
                $i = 1;
                foreach($data['data']['result']['grafikBookingBulan'] as $rows){
                    if($i < $countBooking){
                        echo '"'.$rows['bulan_tahun'].'",';
                    }else{
                        echo $rows['bulan_tahun'];
                    }
                }
            ?>],
        datasets: [{
            label: 'Grafik Booking',
            data: [
                <?php
                    $countBooking = count($data['data']['result']['grafikBookingBulan']);
                    $i = 1;
                    foreach($data['data']['result']['grafikBookingBulan'] as $rows){
                        if($i < $countBooking){
                            echo '"'.$rows['count_booking'].'",';
                        }else{
                            echo $rows['count_booking'];
                        }
                    }
                ?>
            ],
            backgroundColor: [
                <?php
                    $countMember = count($data['data']['result']['grafikBookingBulan']);
                    $i = 1;
                    foreach($data['data']['result']['grafikBookingBulan'] as $rows){
                ?>  
                    'rgba(<?php echo rand(1,255).",".rand(1,255).",".rand(1,255); ?>, 0.2)',
                <?php
                    }
                ?>
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

function grafikMember(){
    $.ajax({
        url: "<?php echo site_url('Admin/Dashboard/grafikMember')?>",
        type: "POST",
        data: {session_grafmember:session_grafmember},
		dataType: 'json',
        success: function(dataa) {
            var labelTemp = [];
            var dataSetTemp = [];
            var backgrounTemp = [];
            var borderTemp = [];
            for (i = 0; i < dataa.length; i++) {
                var rand1 = Math.floor(Math.random() * 255);
                var rand2 = Math.floor(Math.random() * 255);
                var rand3 = Math.floor(Math.random() * 255);
                labelTemp.push( dataa[i].bulan_tahun );
                dataSetTemp.push( dataa[i].count_member );
                backgrounTemp.push( 'rgba('+rand1+', '+rand2+', '+rand3+', 0.2)' );
                borderTemp.push( 'rgba('+rand1+', '+rand2+', '+rand3+', 1)' );
            }
                // console.log(labelTemp);
                myChart.destroy();  // call destroy before loading new dataset
                myChart = chartUpdate(labelTemp, dataSetTemp, backgrounTemp, borderTemp);
            if(session_grafmember == 'tahunan'){
                document.getElementById('session_grafmember').value = 'bulanan';
                $('#grafik_member').html('Bulanan');
            }else{
                document.getElementById('session_grafmember').value = 'tahunan';
                $('#grafik_member').html('Tahunan');
            }
        }
    });
}



function chartUpdate(labeldata, countdata, bgcolor, bdrcolor){
    let ctxid = document.getElementById("myChart").getContext('2d');
    let myChartLine = new Chart(ctxid, {
    //chart akan ditampilkan sebagai bar chart
        type: 'bar',
        data: {
        //membuat label chart
            labels: labeldata,
            datasets: [{
                label: 'Grafik Member',
                //isi chart
                data: countdata,
                //membuat warna pada bar chart
                backgroundColor: bgcolor,
                borderColor: bdrcolor,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    return myChartLine; // return chart object
}

function grafikBooking(){
    sessionbooking = document.getElementById('session_grafbooking').value;
    $.ajax({
        url: "<?php echo site_url('Admin/Dashboard/grafikBooking')?>",
        type: "POST",
        data: {session_grafbooking:sessionbooking},
		dataType: 'json',
        success: function(dataa) {
            var labelTemp = [];
            var dataSetTemp = [];
            var backgrounTemp = [];
            var borderTemp = [];
            for (i = 0; i < dataa.length; i++) {
                var rand1 = Math.floor(Math.random() * 255);
                var rand2 = Math.floor(Math.random() * 255);
                var rand3 = Math.floor(Math.random() * 255);
                labelTemp.push( dataa[i].bulan_tahun );
                dataSetTemp.push( dataa[i].count_booking );
                backgrounTemp.push( 'rgba('+rand1+', '+rand2+', '+rand3+', 0.2)' );
                borderTemp.push( 'rgba('+rand1+', '+rand2+', '+rand3+', 1)' );
            }
                // console.log(labelTemp);
                bookingChart.destroy();  // call destroy before loading new dataset
                bookingChart = chartUpdateBooking(labelTemp, dataSetTemp, backgrounTemp, borderTemp);
            if(sessionbooking == 'tahunan'){
                document.getElementById('session_grafbooking').value = 'bulanan';
                $('#grafik_booking').html('Bulanan');
            }else{
                document.getElementById('session_grafbooking').value = 'tahunan';
                $('#grafik_booking').html('Tahunan');
            }
        }
    });
}

function chartUpdateBooking(labeldata, countdata, bgcolor, bdrcolor){
    let ctxid = document.getElementById("myChartBooking").getContext('2d');
    let myChartLine = new Chart(ctxid, {
    //chart akan ditampilkan sebagai bar chart
        type: 'line',
        data: {
        //membuat label chart
            labels: labeldata,
            datasets: [{
                label: 'Grafik Member',
                //isi chart
                data: countdata,
                //membuat warna pada bar chart
                backgroundColor: bgcolor,
                borderColor: bdrcolor,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    return myChartLine; // return chart object
}
</script>