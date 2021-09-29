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
                            <?php echo $this->session->flashdata('message'); ?>
                            <?php unset($_SESSION['message']); ?>
                            <form method="POST" action="<?= base_url('auth/email_confirm'); ?>">
                            <input type="hidden" name="role" value="<?= $role; ?>">
                                <div class="form-group">
                                    <label for="email">Masukan Email</label>
                                    <input id="email" type="text" class="form-control" name="email" tabindex="1">
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