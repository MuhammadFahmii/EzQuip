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
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="<?= base_url(); ?>" method="post">
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
          <div class="form-group">
            <div class="input-group">
              <input type="password" class="form-control" name="password" placeholder="Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
          <div class="row justify-content-center">
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <h5 class="text-center mt-2">OR</h5>
        <div class="d-flex justify-content-center">
          <a href="<?= $loginURL; ?>" class="btn btn-danger"><i class="fab fa-google-plus-g"></i>
            Login with google
          </a>
        </div>
        <!-- /.col -->
        <hr>
        <p class="mb-1">
          <a href="<?= base_url('auth/forgotPassword') ?>">I forgot my password</a>
        </p>
        <p class="mb-0">
          <a href="<?= base_url('auth/registration'); ?>" class="text-center">Register a new membership</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->