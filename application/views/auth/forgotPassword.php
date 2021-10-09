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
        <p class="login-box-msg">Forgot your password?</p>

        <form action="<?= base_url('auth/forgotPassword'); ?>" method="post">
          <div class="form-group">
            <div class="input-group">
              <input type="text" class="form-control" name="email" placeholder="Email" value="<?= set_value('email'); ?>">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
          <div class="row justify-content-center">
            <div class="col-6">
              <button type="submit" class="btn btn-primary">Reset Password</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <hr>
        <p class="mb-1">
          <a href="<?= base_url() ?>">Back to login</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->