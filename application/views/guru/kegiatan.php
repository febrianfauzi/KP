<div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
<div class="m-content" data-content="Kegiatan"></div>
<?php $this->session->unset_userdata('message'); ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>List Kegiatan</h1>
        </div>
    </section>
    <div class="row">
        <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h4><?php if (isset($Ukegiatan)) {
                            echo "EDIT DATA KEGIATAN";
                        } else {
                            echo "TAMBAH KEGIATAN";
                        } ?></h4>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <?php if (isset($Ukegiatan)) : ?>
                            <input type="hidden" name="id" value="<?= $Ukegiatan['id']; ?>">
                        <?php endif; ?>
                        <input type="hidden" name="id_kelas" value="<?= $id_kelas;?>">
                        <div class="form-group">
                            <label>Nama Kegiatan</label>
                            <textarea class="form-control" style="height: 100px;" name="nama"><?php if (isset($Ukegiatan)) {
                                                                                                    echo $Ukegiatan['nama_kegiatan'];
                                                                                                } ?><?= set_value('nama'); ?></textarea>
                            <?php if (empty($_POST['cari'])) : ?>
                                <small class=" form-text text-danger"><?php echo form_error('nama'); ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control" style="height: 100px;" name="ket"><?php if (isset($Ukegiatan)) {
                                                                                                    echo $Ukegiatan['ket'];
                                                                                                } ?><?= set_value('ket'); ?></textarea>
                            <?php if (empty($_POST['cari'])) : ?>
                                <small class="form-text text-danger"><?php echo form_error('ket'); ?></small>
                            <?php endif; ?>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">
                            <?php if (isset($Ukegiatan)) {
                                echo "Simpan Perubahan";
                            } else {
                                echo "Simpan";
                            } ?></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="row col">
                        <div class="col-md-7">
                            <h4>DAFTAR KEGIATAN</h4>
                        </div>
                        <!-- <div class="col-md-5">
                            <form action="" method="POST">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Cari Kegiatan.." name="keyword">
                                    <div class="input-group-append">
                                        <input class="btn btn-primary" type="submit" name="cari" value="Cari">
                                    </div>
                                </div>
                            </form>
                        </div> -->
                    </div>
                </div>
                <div class="card-body">
                    <!-- <div class="table-responsive"> -->
                    <table class="table table-hover table-bordered dt-responsive" id="datatables" style="width: 100%;">
                        <thead>
                            <tr class="text-center">
                                <th width="5%">No</th>
                                <th width="30%">Nama Kegiatan</th>
                                <th widht="50%">Keterangan</th>
                                <th width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($kegiatan as $row) : ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td>
                                        <pre><?= $row['nama_kegiatan'] ?></pre>
                                    </td>
                                    <td>
                                        <pre><?= $row['ket'] ?></pre>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?= base_url(); ?>guru/ubahKegiatan/<?= $row['id']; ?>" class="btn btn-info" data-toggle="tooltip" title="Edit"><i class="fas fa-pen"></i></a>
                                        <a href="<?= base_url(); ?>guru/hapusKegiatan/<?= $row['id']; ?>" class="btn btn-danger tombol-hapus" data-toggle="tooltip" title="Hapus"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>

                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
</div>