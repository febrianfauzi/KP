<div id="app" class="login-card">
    <section class="section">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Lupa Password</h4>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="<?= base_url('auth/change_password'); ?>">
                                <input type="hidden" name="id" value="<?= $id; ?>">
                                <input type="hidden" name="role" value="<?= $role; ?>">
                                <div class="form-group">
                                    <label for="password1">Masukan Password</label>
                                    <input id="password1" type="text" class="form-control" name="password1" tabindex="1">
                                    <?php echo form_error('password1', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="password2">Konfirmasi Password</label>
                                    <input id="password2" type="text" class="form-control" name="password2" tabindex="2">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>