<!-- Main Content -->
<div class="main-content">
  <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
  <div class="m-content" data-content="Kelas"></div>
  <?php $this->session->unset_userdata('message'); ?>
  <section class="section">
    <div class="section-header">
      <h1>Data Kelas</h1>
    </div>
  </section>
  <div class="row">
    <div class="col-3">
      <button id="tambahkelas" class="btn btn-success" data-toggle="modal" data-target="#modal-tambah-kelas"><i class="fas fa-plus"> Tambah data</i></button>
    </div>
  </div>
  <div class="row">
    <div class="col-12 mt-4">
      <div class="card">
        <div class="card-body">
          <table class="table datatables" id="datatables">
            <thead>
              <tr>
                <th scope="col">Nama Kelas</th>
                <th scope="col">Jumlah Murid</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($kelas->result_array() as $row) :
                $nama = $row['nama_kelas'];
              ?>
                <tr>
                  <td><?php echo htmlentities($nama, ENT_QUOTES, 'UTF-8'); ?></td>
                  <td><?php $this->model_kelas->Tampil_jum_siswa($row['id']); ?></td>
                  <td>
                    <a href="<?= base_url('admin/Hapus_data_kelas/') . $row['id']; ?>" id="btn-hapus" class="btn btn-danger tombol-hapus" data-toggle="tooltip" title="Delete"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<!-- Modal tambah data -->

<div class="modal fade" tabindex="-1" role="dialog" id="modal-tambah-kelas">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Tambah Data Kelas</h5>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('admin/Tambah_data_kelas'); ?>" method="post" class="needs-validation" novalidate>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Kelas *</label>
            <div class="col-sm-7 col-md-7">
              <input type="text" name="nama_kelas" class="form-control" required>
              <div class="invalid-feedback">
                Field Nama Kelas Harus Diisi.
              </div>
            </div>
          </div>


          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
            <div class="col-sm-6 col-md-6">
              <button class="btn btn-primary mr-2" id="tombol-add">Simpan</button>
        </form>
        <button data-dismiss="modal" aria-label="Close" class="btn btn-danger">Batal</button>
      </div>
    </div>
  </div>
</div>
</div>
</div>



<!-- Modal detail data -->