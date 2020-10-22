<style type="text/css">
  .alert.alert-custom{
    padding: 0.75rem 1.25rem !important;
  }
</style> 

<?php  
echo validation_errors('<div class="alert alert-warning">', '</div>' );
$row = $data['data']['result'];

$url = @$row['detail']->id ? "actionDetail/".base64_encode($row['detail']->id) : "actionDetail";
?>
<!--begin::Card-->

<div class="card card-custom example example-compact">
  <div class="card-header">
    <h3 class="card-title">Form Action List Fasilitas</h3>
  </div>
  <!--begin::Form-->
  <form method="POST" class="form" action="<?= site_url('Admin/Fasilitas/'.$url) ?>">
    <div class="card-body">
      <div id="form-config">
        <div class="form-group row ">
          <div class="col-md-6 col-xs-12 ">
            <label>Deskripsi Fasilitas</label>
            <input type="text" name="alat[0][deskripsi]" class="form-control" placeholder="Masukan Deskripsi Fasilitas" value="<?= @$row['detail']->deskripsi ? $row['detail']->deskripsi : '' ?>" required="">
            <input type="text" name="ids" value="<?= @$row['detail']->id ? $row['detail']->id : '' ?>" hidden="">
            <input type="text" name="id" value="<?= $row['fasilitas']->id_fasilitas ?>" hidden="">
          </div>
          <div class="col-md-6 col-xs-12">
            <label>Qty Alat</label>
            <input type="number" value="<?= @$row['detail']->qty ? $row['detail']->qty : '' ?>" name="alat[0][qty]" class="form-control" placeholder="Masukan Qty" required="">
          </div>
        </div>
      </div>
      <?php if (!$row['detail']): ?>
        
      <div class="form-group text-right">
        <label>
          <a href="javascript:;" id="add" class="btn btn-primary btn-text-default"><i class="fas fa-plus "></i> Tambah Detail</a>
        </label>
        <label>
          <a href="javascript:;" id="remove" class="btn btn-danger btn-text-default" hidden=""><i class="fas fa-minus "></i> Hapus Detail</a>
        </label>
      </div>

      <script type="text/javascript">
        index = 1;


        $('#add').click(() => {
          html = '<div class="form-group row ">\
          <div class="col-md-6 col-xs-12 ">\
          <label>Nama Alat</label>\
          <input type="text" name="alat['+index+'][deskripsi]" class="form-control" placeholder="Masukan Nama Alat" required="">\
          </div>\
          <div class="col-md-6 col-xs-12">\
          <label>Qty Alat</label>\
          <input type="number" name="alat['+index+'][qty]" class="form-control" placeholder="Masukan Qty Alat" required="">\
          </div>\
          </div>';

          $('#form-config').append(html);
          index = index+1;
          if (index > 1) {
            document.getElementById('remove').removeAttribute('hidden',0);
          }
        });

        $('#remove').click(() => {
          $('#form-config .form-group.row:last').remove();
          index = index-1;
          if (index == 1 || index <= 1) {
            document.getElementById('remove').setAttribute('hidden',0);
          }
        });
      </script>
      <?php endif ?>

    </div>
    

    <div class="card-footer text-right">
      <input type="submit" name="action" class="btn btn-primary mr-2" value="<?= @$row['detail']->id ? "Update" : "Save" ?> Record">
      <span class="ml-2">or 
        <a href="javascript:;" onclick="window.history.back(-1)" class="font-weight-bold ml-2">Cancel</a>
      </span>
    </div>
  </form>
  <!--end::Form-->
</div>
                    <!--end::Card-->