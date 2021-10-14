<!-- Main Content -->
<div class="main-content">
  <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
  <div class="m-content" data-content="Guru"></div>
  <?php $this->session->unset_userdata('message'); ?>
  <section class="section">
    <div class="section-header">
      <h1>Data Guru</h1>
    </div>
  </section>
  <div class="row">
    <div class="col">
      <a id="tambahguru" class="btn btn-success icw" data-toggle="modal" data-target="#modal-tambah-guru"><i class="fas fa-plus icw"></i> Tambah data</a>
    </div>
  </div>
  <div class="row">
    <div class="col-12 mt-4">
      <div class="card">
        <div class="card-body ">
          <!-- <div class="table-responsive"> -->
          <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" id="datatables">
            <thead>
              <tr>
                <th width="5%">#</th>
                <th>Nomor Induk Pegawai</th>
                <th>Nama Lengkap</th>
                <th>Wali Kelas</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($row as $key => $data) { ?>
                <tr>
                  <td><?= $no++; ?>.</td>
                  <td><?= $data->nip ?></td>
                  <td><?= $data->nama_guru ?></td>
                  <td><?= $data->nama_kelas ?></td>
                  <td>

                    <a id="detguru" data-toggle="modal" data-target="#modal-detguru" data-nip="<?= $data->nip ?>" data-nama_guru="<?= $data->nama_guru ?>" data-kelas="<?= $data->nama_kelas ?>" data-email="<?= $data->email ?>" data-alamat="<?= $data->alamat ?>">
                      <button class="btn btn-info mb-1" data-toggle="tooltip" title="Detail"><i class="fa fa-eye icw"></i></button></a>
                    <a id="editguru" data-toggle="modal" data-target="#modal-editguru" data-id="<?= $data->id ?>" data-nama="<?= $data->nama_guru ?>" data-id_kelas="<?= $data->id_kelas ?>" data-email="<?= $data->email ?>" data-alamat="<?= $data->alamat ?>">
                      <button class="btn btn-primary mb-1" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil-alt icw"></i></button></a>
                    <a href="<?= site_url('admin/Hapus_data_guru/' . $data->id); ?>" class="btn btn-danger mb-1 tombol-hapus" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash icw"></i></a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
          <!-- </div> -->
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<?php foreach ($row as $key => $data) { ?>
  <!-- Modal Ubah -->
  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modal-editguru" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update Data guru</h5>
        </div>
        <form class="form-horizontal" action="<?= site_url('admin/process_guru') ?>" method="post" enctype="multipart/form-data" role="form" class="needs-validation" novalidate>
          <div class="modal-body">

            <div class="form-group">
              <label class="col-lg-2 col-sm-2 control-label">Nama*</label>
              <div class="col-lg-10">
                <input type="hidden" id="id" name="id" value="<?= $data->id ?>">
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="<?= $data->nama_guru ?>" required>
                <div class="invalid-feedback">
                  Field Nama Harus Diisi.
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-2 col-sm-2 control-label">Kelas*</label>
              <div class="col-lg-10">
                <select name="id_kelas" class="form-control" id="id_kelas" required>
                  <option disabled value="">- Pilih Kelas -</option>
                  <?php
                  $kelas = $this->db->query("SELECT * FROM kelas");
                  foreach ($kelas->result() as $k) {
                  ?>
                    <option value="<?php echo $k->id ?>" <?php if ($data->id_kelas == "$k->id") {
                                                            echo "selected";
                                                          } ?>><?php echo $k->nama_kelas ?></option>
                  <?php } ?>
                </select>
                <div class="invalid-feedback">
                  Field Kelas Harus Diisi.
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-2 col-sm-2 control-label">Email</label>
              <div class="col-lg-10">
                <input type="text" class="form-control" id="email" name="email" value="<?= $data->email ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-2 col-sm-2 control-label">Alamat</label>
              <div class="col-lg-10">
                <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $data->alamat ?>">
              </div>
            </div>

            <div class="form-group col-lg-10">
              <button class="btn btn-primary mr-1" type="submit" name="Edit_guru"> Simpan</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal"> Batal</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  </div>
<?php } ?>
<!-- END Modal Ubah -->


<!-- Modal tambah data -->

<div class="modal fade" tabindex="-1" role="dialog" id="modal-tambah-guru">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Tambah Data guru</h5>
      </div>
      <div class="modal-body">
        <form method="post" action="<?= base_url('admin/Tambah_data_guru'); ?>" class="needs-validation" novalidate>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">NIP*</label>
            <div class="col-sm-7 col-md-7">
              <input type="text" name="nip" class="form-control" required>
              <div class="invalid-feedback">
                Field NIP Harus Diisi.
              </div>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama*</label>
            <div class="col-sm-7 col-md-7">
              <input type="text" name="nama" class="form-control" required>
              <div class="invalid-feedback">
                Field Nama Harus Diisi.
              </div>
            </div>
          </div>

          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kelas*</label>
            <div class="col-sm-7 col-md-7">
              <select name="kelas2" class="form-control" required>
                <option selected disabled value="">Pilih Kelas</option>
                <?php foreach ($kelas2 as $l) { ?>
                  <option value="<?php echo $l['id']; ?>"><?php echo $l['nama_kelas']; ?> </option>
                <?php } ?>
              </select>
              <div class="invalid-feedback">Field Kelas Harus Diisi.</div>
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

<div class="modal fade" tabindex="-1" role="dialog" id="modal-detguru">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table">
          <tbody>
            <tr>
              <th>NIP</th>
              <td><span id="nip"></span></td>
            </tr>
            <tr>
              <th>Nama Lengkap</th>
              <td><span id="nama"></span></td>
            </tr>
            <tr>
              <th>Walikelas</th>
              <td><span id="kelas"></span></td>
            </tr>
            <tr>
              <th>Email</th>
              <td><span id="email"></span></td>
            </tr>
            <tr>
              <th>Alamat</th>
              <td><span id="alamat"></span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>