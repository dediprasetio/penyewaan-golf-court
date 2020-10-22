<style type="text/css">
  .alert.alert-custom{
    padding: 0.75rem 1.25rem !important;
  }
</style> 

<!--begin::Card-->
<div class="card card-custom example example-compact">
  <div class="card-header">
    <h3 class="card-title">Form Action Fasilitas Member</h3>
  </div>

  <?php  
  echo validation_errors('<div class="alert alert-warning">', '</div>' );

  $row = $data['data']['result'];
  $url = @$row['fasilitas']->id_fasilitas ? "action/".base64_encode($row['fasilitas']->id_fasilitas) : "action";
  ?>

  <!--begin::Form-->
  <form method="POST" class="form" action="<?= site_url('Admin/Fasilitas/'.$url) ?>">
    <div class="card-body">

      <div class="form-group row">
        <div class="col-md-6">
          <label>Nama Admin Penginput<span class="text-danger">*</span> </label>
          <select class="form-control" name="admin" id="exampleSelect1" required="">
            <?php foreach ($row['dataAdmin'] as $key): ?>
              <?php if (@$row['fasilitas']->id_admin == $key['id_admin']): ?>
                <option value="<?= $key['id_admin'] ?>" selected=""><?= $key['nama_admin']." - ".$key['level'] ?></option>
                <?php elseif ($this->session->userdata('id') == $key['id_admin']) : ?>
                  <option value="<?= $key['id_admin'] ?>" selected=""><?= $key['nama_admin']." - ".$key['level'] ?></option>
                  <?php else: ?>
                    <option value="<?= $key['id_admin'] ?>"><?= $key['nama_admin']." - ".$key['level'] ?></option>
                  <?php endif ?>
                <?php endforeach ?>

              </select>
              <span class="form-text text-danger"><?php echo form_error('admin'); ?></span>
            </div>
            <div class="col-md-6">
              <label>Diskon Member<span class="text-danger">*</span></label>
              <div class="input-group">

                <input type="number" name="diskon" required="" class="form-control" placeholder="example : 10" value="<?= @$row['fasilitas']->diskon_member ? $row['fasilitas']->diskon_member : ''; ?>">
                <input type="text" name="id" value="<?= @$row['fasilitas']->id_fasilitas ? $row['fasilitas']->id_fasilitas : $row['id_fasilitas'] ?>" readonly="" hidden="">
                <div class="input-group-prepend">
                  <span class="input-group-text">%</span>
                </div>
                <span class="form-text text-danger"><?php echo form_error('diskon'); ?></span>
              </div>
            </div>
          </div>   
          <?php if (!$row['fasilitas']): ?>

            <p class="text-muted "><h5 class="mt-6">Detail Fasilitas yang di Dapat : </h5></p>

            <div id="form-config">
              <div class="form-group row ">
                <div class="col-md-6 col-xs-12 ">
                  <label>Deskripsi Fasilitas</label>
                  <input type="text" name="alat[0][deskripsi]" class="form-control" placeholder="Masukan Deskripsi Fasilitas" required="">
                </div>
                <div class="col-md-6 col-xs-12">
                  <label>Qty yang di dapat</label>
                  <input type="number" name="alat[0][qty]" class="form-control" placeholder="Masukan Qty" required="">
                </div>
              </div>
            </div>

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
                  <label>Deskripsi Fasilitas</label>\
                  <input type="text" name="alat['+index+'][deskripsi]" class="form-control" placeholder="Masukan Deskripsi Fasilitas" required="">\
                </div>\
                <div class="col-md-6 col-xs-12">\
                  <label>Qty yang di dapat</label>\
                  <input type="number" name="alat['+index+'][qty]" class="form-control" placeholder="Masukan Qty" required="">\
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
          <input type="submit" name="action" class="btn btn-primary mr-2" value="<?= @$row['fasilitas']->id_fasilitas ? "Update" : "Save" ?> Record">
          <span class="ml-2">or 
            <a href="javascript:;" onclick="window.history.back(-1)" class="font-weight-bold ml-2">Cancel</a>
          </span>
        </div>
      </form>
      <!--end::Form-->
    </div>
                    <!--end::Card-->