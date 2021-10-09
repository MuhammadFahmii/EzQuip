<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><?= $title; ?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <?php if ($role_id == 1) : ?>
              <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
            <?php elseif ($role_id == 2) : ?>
              <li class="breadcrumb-item"><a href="<?= base_url('user'); ?>">Home</a></li>
            <?php endif; ?>
            <li class="breadcrumb-item active"><?= $title; ?></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>