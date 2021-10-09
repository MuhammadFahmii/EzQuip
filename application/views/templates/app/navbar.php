<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <?php if ($role_id == 1) : ?>
            <a href="<?= base_url('admin'); ?>" class="nav-link">Home</a>
          <?php elseif ($role_id == 2) : ?>
            <a href="<?= base_url('user'); ?>" class="nav-link">Home</a>
          <?php endif; ?>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <img src="<?= base_url('assets/img/') . $image ?>" class="user-image img-circle elevation-2" alt="User Image">
            <span class="d-none d-md-inline"><?= $name; ?></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <!-- User image -->
            <li class="user-header bg-primary">
              <img src="<?= base_url('assets/img/') . $image ?>" class="img-circle elevation-2" alt="User Image">
              <p>
                <?= $name; ?>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <a href="#" class="btn btn-default btn-flat">Profile</a>
              <a href="<?= base_url('auth/logout'); ?>" class="btn btn-default btn-flat float-right logout">Logout</a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->