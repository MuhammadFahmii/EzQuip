    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <!-- <a href="#" class="brand-link">
        <img src="" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">EzQuip</span>
      </a> -->

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Looping submenu -->
            <?php foreach ($menu as $m) : ?>
              <li class="nav-header"><?= $m['menu']; ?></li>
              <?php foreach ($submenu as $sm) : ?>
                <?php if ($sm['menu_id'] == $m['id']) : ?>
                  <li class="nav-item">
                    <?php if ($name == $sm['name']) : ?>
                      <a href="<?= base_url($sm['url']); ?>" class="nav-link active">
                      <?php else : ?>
                        <a href="<?= base_url($sm['url']); ?>" class="nav-link">
                        <?php endif; ?>
                        <i class="nav-icon <?= $sm['icon']; ?>"></i>
                        <p><?= $sm['name']; ?></p>
                        </a>
                  </li>
                <?php endif; ?>
              <?php endforeach; ?>
            <?php endforeach; ?>

            <li class="nav-item logout mt-4">
              <a href="<?= base_url('auth/logout'); ?>" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                  Logout
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>