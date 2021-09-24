<style>
    .green {
        color: lightgreen !important;
    }

    .red {
        color: red !important;
    }
</style>
<div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
<div class="m-content" data-content="Isi Absensi"></div>
<?php $this->session->unset_userdata('message'); ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="row col">
                <div class="col">
                    <h1>Absensi Murid</h1>
                </div>
                <div class="col-md-1"><a href="<?= base_url('admin/Tampil_data_siswa'); ?>"><button class="btn btn-info float-right">Kembali</button></a></div>
            </div>
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
                                <td> : <?= $nama_siswa; ?></td>
                            </tr>
                            <tr>
                                <th>NIS&emsp;</th>
                                <td> : <?= $identitas; ?></td>
                            </tr>
                            <tr>
                                <th>Kelas&emsp;</th>
                                <td> : <?= $kelas; ?></td>
                            </tr>
                        </table>
                        <div class="w-100 d-sm-none"></div><br>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7 mt-3">
                    <form action="" method="POST">
                        <input type="hidden" name="siswa" value="<?= $identitas; ?>">
                        <div class="form-row">
                            <div class="form-group col-md-4 col-lg-4 col-sm-4">
                                <select class="form-control" name="bulan">
                                    <option value="<?php if (isset($this->session->bulan)) {
                                                        echo $this->session->bulan;
                                                    } else {
                                                        echo date('m');
                                                    } ?>" style="border: 2px solid black;">
                                        <?php if (isset($this->session->bulan)) {
                                            $this->Absen_model->getBulan($this->session->bulan);
                                        } else {
                                            $this->Absen_model->getBulan(date('m'));
                                        } ?>
                                    </option>
                                    <option disabled>------</option>
                                    <option value="01">Januari</option>
                                    <option value="02">Februari</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3 col-lg-3 col-sm-3">
                                <select class="form-control" name="tahun">
                                    <option value="<?php if (isset($this->session->tahun)) {
                                                        echo $this->session->tahun;
                                                    } else {
                                                        echo date('Y');
                                                    } ?>">
                                        <?php if (isset($this->session->tahun)) {
                                            echo $this->session->tahun;
                                        } else {
                                            echo date('Y');
                                        } ?></option>
                                    <option disabled>------</option>
                                    <?php $this->Absen_model->getTahun($identitas); ?>
                                </select>
                            </div>
                            <div class="form-group col-md-3 col-lg-3 col-sm-3">
                                <button type="submit" class="btn btn-lg btn-primary col">Pilih</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-5">
                    <p>Keterangan : <br>
                        <button class="btn-sm" style="background-color: transparent;border-color: #ccc;">&nbsp;&nbsp;&nbsp;</button> Belum diisi
                        <button class="btn-sm text" style="background-color: transparent;border-color: #ccc;"><i class="fas fa-check green"></i></button> Dilakukan
                        <button class="btn-sm mb-2" style="background-color: transparent;border-color: #ccc;"><i class="fas fa-times red"></i></button> Tidak Dilakukan
                    </p>
                </div>
            </div>

            <table class="table table-sm table-responsive-lg table-responsive-md table-responsive-sm table-hover table-bordered">
                <thead class="bg-light">
                    <?php
                    if ($this->session->bulan && $this->session->tahun) {
                        $this->Absen_model->getTanggal();
                    } else {
                        $this->Absen_model->getTanggal();
                    } ?>
                </thead>
                <?php
                if ($this->session->bulan && $this->session->tahun) {
                    $this->Absen_model->getDataDetail($kegiatan, $identitas, $this->session->bulan, $this->session->tahun);
                } else {
                    $this->Absen_model->getData($kegiatan, $identitas);
                } ?>
            </table>
        </div>
    </div>

</div>
</div>