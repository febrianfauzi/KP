<link rel="stylesheet" href="<?= base_url(); ?>assets/css/datepicker.css">
<?php $hari = date('l', strtotime($tgl)); ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Isi Kegiatan</h1>
        </div>
    </section>
    <div class="row">
        <div class="col">
            <div class="card card-primary">
                <form action="" method="POST">
                    <input type="hidden" name="nis" value="<?= $identitas ?>">
                    <div class="card-header">
                        <h3><?= $hari.', '.$tgl; ?></h4>
                    </div>
                </form>
                <?php
                if ($hari == 'Sunday' || $hari == 'Saturday') : ?>
                    <div class="card-body">
                        <h2 class="mb-5">Tanggal ini adalah hari libur</h2>
                        <a href="<?= base_url('murid/absensi') ?>"><button class="btn btn-primary">Kembali</button></a>
                    </div>
                <?php else : ?>
                    <a href="<?= base_url('murid/absensi') ?>"><button class="btn btn-primary float-right mr-4 mt-3">Kembali</button></a>
                    <form action="" method="POST">
                        <input type="hidden" name="nis" value="<?= $identitas ?>">
                        <input type="hidden" name="tgl" value="<?= $tgl ?>">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <tr class="text-center bg-light">
                                        <th width="2%">No</th>
                                        <th>Nama Kegiatan</th>
                                        <th width="25%">Action</th>
                                    </tr>
                                    <?php
                                    $i = 1;
                                    if ($tgl) : ?>
                                        <?php $this->IsiKegiatan_model->cekDataKegiatan($kegiatan, $identitas, $tgl); ?>
                                    <?php endif; ?>
                                </table>
                            </div>
                            <button class="btn btn-primary mt-1 mb-4 float-right" name="button" value="<?php if ($tgl) {
                                                                                                            echo 'update';
                                                                                                        } else {
                                                                                                            echo 'simpan';
                                                                                                        } ?>">Simpan</button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
            </form>
        </div>
    </div>
</div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
<script script>
    $.fn.datepicker.dates['id'] = {
        days: ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"],
        daysShort: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
        daysMin: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
        months: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
        monthsShort: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
        today: "Hari ini",
        clear: "Clear",
        format: "mm/dd/yyyy",
        titleFormat: "MM yyyy",
        /* Leverages same syntax as 'format' */
        weekStart: 0
    };

    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        daysOfWeekDisabled: [0, 6],
        language: 'id',
        clearBtn: true,
        disableTouchKeyboard: true
    });
</script>