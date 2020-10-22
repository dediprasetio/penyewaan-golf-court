<style type="text/css">
  .alert.alert-custom{
        padding: 0.75rem 1.25rem !important;
  }
</style> 

<!--begin::Card-->
<div class="card card-custom example example-compact">
  <div class="card-header">
    <h3 class="card-title">Form Action Admin</h3>
  </div>

  <?php  
  echo validation_errors('<div class="alert alert-warning">', '</div>' );
  $row = $data['data']['result'];
  $url = @$row->id_admin ? "action/".base64_encode($row->id_admin) : "action";
  ?>

  <!--begin::Form-->
  <form method="POST" class="form" action="<?= site_url('Admin/AdminConf/'.$url) ?>">
    <div class="card-body">
      <div class="form-group">
        <label>ID Admin</label>
        <input type="text" name="id" class="form-control form-control-solid" value="<?= @$row->id_admin ? $row->id_admin : $row; ?>" readonly="">
      </div>
      <div class="form-group">
        <label>Nama Lengkap </label>
        <input type="text" name="nama" class="form-control" required="" placeholder="Enter Full Name" value="<?= @$row->nama_admin ? $row->nama_admin : ''; ?>" />
        <span class="form-text text-muted">Please enter your Full Name</span>
        <span class="form-text text-danger"><?php echo form_error('nama'); ?></span>
      </div>
      <div class="form-group">
        <label>Alamat Email</label>
        <input type="email" name="email" class="form-control" required="" placeholder="Enter Email" value="<?= @$row->email ? $row->email : ''; ?>" />
        <span class="form-text text-muted">We'll never share your email with anyone else</span>
        <span class="form-text text-danger"><?php echo form_error('email'); ?></span>

      </div>

      <div class="form-group">
        <label>Username </label>
        <input type="text" class="form-control" name="uname" required="" placeholder="Enter Username" value="<?= @$row->username ? $row->username : ''; ?>" />
        <span class="form-text text-muted">We'll never share your username with anyone else</span>
        <span class="form-text text-danger"><?php echo form_error('uname'); ?></span>

      </div>

      <div class="form-group">
        <label>Password </label>
        <input type="password" name="password" class="form-control"  placeholder="Enter Password" />
        <span class="form-text text-muted">Minimal 6 character</span>
        <span class="form-text text-danger"><?php echo form_error('password'); ?></span>

      </div>

      <div class="form-group">
        <label>Re-Password </label>
        <input type="password" class="form-control" name="repassword"  placeholder="Enter Re-Password"  />
        <span class="form-text text-muted">Minimal 6 character and must match at a password</span>
        <span class="form-text text-danger"><?php echo form_error('repassword'); ?></span>

      </div>

      <div class="form-group">
        <label>No Telephone </label>
        <input type="text" name="notelp" class="form-control" required="" placeholder="Enter Telephone" value="<?= @$row->no_telp ? $row->no_telp : ''; ?>" />
        <span class="form-text text-danger"><?php echo form_error('notelp'); ?></span>

      </div>

    </div>
    <div class="card-footer text-right">
      <input type="submit" name="action" class="btn btn-primary mr-2" value="<?= @$row->id_admin ? "Update" : "Save" ?> Record">
      <span class="ml-2">or 
        <a href="javascript:;" onclick="window.history.back(-1)" class="font-weight-bold ml-2">Cancel</a>
      </span>
    </div>
  </form>
  <!--end::Form-->
</div>
                    <!--end::Card-->