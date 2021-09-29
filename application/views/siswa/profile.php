<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Profile Siswa</h1>
        </div>
    </section>
    <div class="row">
        <div class="col">
            <div class="card author-box card-primary">
                <div class="card-body">
                    <div class="author-box-name">
                        <h5>Info Pribadi</h5>
                        <?php echo $this->session->flashdata('message'); ?>
                        <?php unset($_SESSION['message']); ?>
                        <hr>
                    </div>
                    <div class="row">
                        <div class="author-box-left col-md-2">
                            <div class="gambar mx-auto" style="overflow: hidden; border-radius:50%; width:200px; height:200px; border: 1px solid lightgray;">
                                <img alt="image" src="<?= base_url(); ?>assets/photo/<?= $this->session->photo; ?>" style="width: 100%; height:auto;">
                            </div>
                            <div class="clearfix"></div>
                            <a href="#" class="btn btn-primary col-md-8 mx-auto mt-2" data-toggle="modal" data-target="#gantiPhoto">Ganti</a>
                        </div>
                        <div class="col mt-3">
                            <small>Nama :</small>
                            <h4><?= $user; ?></h4>
                            <small>NIS :</small>
                            <h6><?= $identitas; ?></h6>
                            <small>Walikelas :</small>
                            <h6><?= $kelas; ?></h6>
                            <small>Email :</small>
                            <h6><?= $email; ?></h6>
                            <div class="w-100 d-sm-none"></div>
                        </div>
                    </div>
                    <hr>
                    <a href="#" class="btn btn-primary float-right" id="btnProfile">Ubah Data Pribadi</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card author-box card-primary">
                <div class="card-body">
                    <div class="author-box-name">
                        <h5>Ganti Password</h5>
                        <?php echo $this->session->flashdata('msgPass'); ?>
                        <?php unset($_SESSION['msgPass']); ?>
                        <hr>
                    </div>
                    <form action="<?= base_url('siswa/gantiPassword'); ?>" method="POST">
                        <input type="hidden" name="id" value="<?= $id; ?>">
                        <div class="author-box-description">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="password" class="d-block">Password Lama</label>
                                        <input id="password" type="password" class="form-control" name="oldpassword">
                                        <?php echo form_error('oldpassword', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="password" class="d-block">Password Baru</label>
                                        <input id="password" type="password" class="form-control" name="password1">
                                        <?php echo form_error('password1', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="password2" class="d-block">Konfirmasi Password Baru</label>
                                        <input id="password2" type="password" class="form-control" name="password2">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-right">
                                Simpan
                            </button>
                        </div>
                    </form>
                    <div class="w-100 d-sm-none"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal ganti photo -->
<div class="modal fade" id="gantiPhoto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Ganti Photo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('siswa/gantiPhoto'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Masukan Photo</label>
                        <input type="file" class="form-control-file" name="foto" id="updatePhoto" required>
                        <input type="hidden" name="nis" value="<?= $identitas; ?>">
                        <input type="hidden" name="id" value="<?= $id; ?>">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Change</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal ganti profile -->
<div class="modal fade" id="gantiProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Ubah Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('siswa/gantiProfile');?>" method="POST" class="needs-validation" novalidate>
                    <input type="hidden" name="id" value="<?= $id; ?>">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama" value="<?= $user; ?>" required>
                        <div class="invalid-feedback">
                            Nama Harus Diisi.
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Kelas</label>
                        <select name="kelas" class="form-control" id="id_kelas" required>
                            <option value="" disabled>- Pilih Kelas -</option>
                            <?php
                            $kelas = $this->db->query("SELECT * FROM kelas");
                            foreach ($kelas->result() as $k) {
                            ?>
                                <option value="<?php echo $k->id ?>" <?php if ($id_kelas == "$k->id") {
                                                                            echo "selected";
                                                                        } ?>><?php echo $k->nama_kelas ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" value="<?= $email; ?>" required>
                        <div class="invalid-feedback">
                            Email Harus Diisi.
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Change</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#btnProfile").click(function() {
            $("#gantiProfile").modal("show");
        });
        $("#gantiProfile").on('hidden.bs.modal', function() {
            $(this).find('form').trigger('reset');
        });
    });
</script>