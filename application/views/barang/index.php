      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <!-- Flash Message dengan Sweet Alert-->
              <?php if ($this->session->flashdata('success')) : ?>
                <div class="flash-data" data-type="success" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
              <?php elseif ($this->session->flashdata('failed')) : ?>
                <div class="flash-data" data-type="failed" data-flashdata="<?= $this->session->flashdata('failed'); ?>"></div>
              <?php endif; ?>
              <?php if ($this->session->flashdata("errorImage")) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <h5><i class="icon fas fa-ban"></i><?= $this->session->flashdata('errorImage'); ?></h5>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              <?php endif; ?>
              <a href="<?= base_url('barang/tambah'); ?>" class="btn btn-primary mb-2">Tambah Barang</a>
              <a href="<?= base_url('barang/cetakLaporan'); ?>" class="btn btn-success mb-2">Cetak Laporan</a>
              <!-- Main Content -->
              <table class="table table-striped display nowrap" id="mytable">
                <thead>
                  <tr>
                    <th>Nama Barang</th>
                    <th>Jenis Barang</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Gambar</th>
                    <th>Action</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
      </section>
      </div>