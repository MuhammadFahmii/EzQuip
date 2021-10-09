<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <b>Admin</b>LTE
    </div>
    <!-- /.login-logo -->

    <?php if ($this->session->flashdata('success')) : ?>
      <div class="flash-data" data-type="success" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
    <?php elseif ($this->session->flashdata('failed')) : ?>
      <div class="flash-data" data-type="failed" data-flashdata="<?= $this->session->flashdata('failed'); ?>"></div>
    <?php endif; ?>
    <!-- SweetAlert2 -->

    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Change your password?</p>
        <h5 class="login-box-msg"><?= $this->session->userdata('reset_email'); ?></h5>

        <form action="<?= base_url('auth/changePassword'); ?>" method="post">
          <div class="form-group">
            <div class="input-group">
              <input type="password" class="form-control" name="password1" placeholder="Enter New Password">
              <div class="input-group-append">
                <div class="input-group-text">

                </div>
              </div>
            </div>
            <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
          <div class="input-group">
            <input type="password" class="form-control" name="password2" placeholder="Repeat Password">
            <div class="input-group-append">
              <div class="input-group-text">

              </div>
            </div>
          </div>
          <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
      </div>
      <div class="row justify-content-center">
        <div class="col-5">
          <button type="submit" class="btn btn-primary">Reset Password</button>
        </div>
        <!-- /.col -->
      </div>
      </form>
      <hr>
    </div>
    <!-- /.login-card-body -->
  </div>
  </div>
  <!-- /.login-box -->