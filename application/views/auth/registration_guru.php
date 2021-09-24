<div id="app" class="registration-card">
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">

                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Buat Akun</h4>
                        </div>

                        <div class="card-body">
                            <form action="<?= base_url(); ?>auth/registrationGuru" method="POST">
                                <div class="form-group">
                                    <label for="name">NIP</label>
                                    <input id="name" type="text" class="form-control" name="nip" value="<?= set_value('nip'); ?>">
                                    <?php echo form_error('nip', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="text" class="form-control" name="email" value="<?= set_value('email'); ?>">
                                    <?php echo form_error('email', '<small class="text-danger">', '</small>'); ?>
                                </div>

                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="password" class="d-block">Password</label>
                                        <input id="password" type="password" class="form-control" name="password">
                                        <?php echo form_error('password', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="password2" class="d-block">Konfirmasi Password</label>
                                        <input id="password2" type="password" class="form-control" name="password2">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                                        Buat Akun
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="mt-5 text-muted text-center">
                        Sudah Memiliki Akun? <a href="<?= base_url(); ?>auth/indexGuru">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>