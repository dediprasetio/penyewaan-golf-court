<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
    <!--begin::Info-->
    <div class="d-flex align-items-center flex-wrap mr-2">
        <!--begin::Page Title-->
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"><?= $data['subtitel'] ?></h5>
        <!--end::Page Title-->
        <!--begin::Actions-->

        <!--end::Actions-->
    </div>
    <!--end::Info-->
    <!--begin::Toolbar-->
    <div class="d-flex align-items-center">

        <!--begin::Daterange-->
        <a href="#" class="btn btn-sm btn-light font-weight-bold mr-2" id="kt_dashboard_daterangepicker" data-toggle="tooltip" title="Select dashboard daterange" data-placement="left">
            <span class="text-muted font-size-base font-weight-bold mr-2" id="kt_dashboard_daterangepicker_title">Today</span>
            <span class="text-primary font-size-base font-weight-bolder" id="kt_dashboard_daterangepicker_date"><?= date('m d') ?></span>
        </a>
        <!--end::Daterange-->
    </div>
    <!--end::Toolbar-->
</div>