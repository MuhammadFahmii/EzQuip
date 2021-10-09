      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
              <div class="card card-primary">
                <div class="card-header">
                  <h4 class="card-title">
                    <a href="<?= base_url('barang') ?>">&larr;</a>
                    Form Tambah Data
                  </h4>
                </div>
                <div class="card-body">
                  <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="namaBarang">Nama Barang</label>
                      <input type="text" name="namaBarang" id="namaBarang" class="form-control" value="<?= set_value('namaBarang'); ?>" autofocus>
                      <small class="form-text text-danger"><?= form_error('namaBarang'); ?></small>
                    </div>
                    <div class="form-group">
                      <label for="jenisBarang">Jenis Barang</label>
                      <select class="form-control" id="jenisBarang" name="jenisBarang">
                        <option value="">--Pilih Barang--</option>
                        <?php foreach ($jenisBarang as $jb) : ?>
                          <option value="<?= $jb; ?>"><?= $jb; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="hargaJual">Harga</label>
                      <input type="number" name="hargaJual" class="form-control" id="hargaJual" rows="3" value="<?= set_value('hargaJual'); ?>"></input>
                      <small class="form-text text-danger"><?= form_error('hargaJual'); ?></small>
                    </div>
                    <div class="form-group">
                      <label for="jumlah">Jumlah</label>
                      <input type="number" name="jumlah" class="form-control" id="jumlah" rows="3" value="<?= set_value('jumlah'); ?>"></input>
                    </div>
                    <div class="form-group">
                      <label for="gambar">Pilih Gambar</label>
                      <input type="file" name="gambar" id="gambar" class="form-control-file">
                      <?php if ($this->session->flashdata("errorImage")) : ?>
                        <small class="form-text text-danger"><?= $this->session->flashdata("errorImage"); ?></small>
                      <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Tambah</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      </div>