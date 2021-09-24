<style>
    .green {
        color: lightgreen !important;
    }

    .red {
        color: red !important;
    }
</style>
<div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
<div class="m-content" data-content="Isi Kegiatan"></div>
<?php $this->session->unset_userdata('message'); ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Beranda Murid</h1>
        </div>
    </section>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="col mt-3">
                        <table>
                            <tr>
                                <th>Nama&emsp;</th>
                                <td> : <?= $user; ?></td>
                            </tr>
                            <tr>
                                <th>NIS&emsp;</th>
                                <td> : <?= $identitas; ?></td>
                            </tr>
                            <tr>
                                <th>Kelas&emsp;</th>
                                <td> : <?= $kelas; ?></td>
                            </tr>
                            <tr>
                                <th>Bulan&emsp;</th>
                                <td> : <?= date('F') ?></td>
                            </tr>
                        </table>
                        <div class="w-100 d-sm-none"></div><br>
                    </div>
                </div>
            </div>
            <p>Keterangan : <br>
                <button class="btn-sm" style="background-color: transparent;border-color: #ccc;">&nbsp;</button> Belum diisi
                <button class="btn-sm text" style="background-color: transparent;border-color: #ccc;"><i class="fas fa-check green"></i></button> Dilakukan
                <button class="btn-sm mb-2" style="background-color: transparent;border-color: #ccc;"><i class="fas fa-times red"></i></button> Tidak Dilakukan
            </p>
            <table class="table table-sm table-responsive-lg table-responsive-md table-responsive-sm table-hover table-bordered">
                <thead class="bg-light">
                    <?php $this->Absen_model->getTanggal(); ?>
                </thead>
                <?php $this->Absen_model->getData($kegiatan, $identitas); ?>
            </table>
        </div>
    </div>

</div>
</div>