<body class="hold-transition register-page">
  <div class="register-box">
    <div class="register-logo">
      <b>Admin</b>LTE
    </div>

    <div class="card">
      <div class="card-body register-card-body">
        <p class="login-box-msg">Register a new membership</p>

        <form action="<?= base_url('auth/registration'); ?>" method="post">
          <div class="form-group mb-3">
            <div class="input-group">
              <input type="text" class="form-control" autofocus="on" name="name" placeholder="Full name" value="<?= set_value('name'); ?>">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
          <div class="form-group mb-3">
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
          <div class="form-group mb-3">
            <div class="input-group">
              <input type="password" class="form-control" name="password1" placeholder="Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
          <div class="form-group mb-3">
            <div class="input-group">
              <input type="password" class="form-control" name="password2" placeholder="Retype password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <hr>
        <a href="<?= base_url(); ?>" class="text-center">I already have a membership</a>
      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>
  <!-- /.register-box -->