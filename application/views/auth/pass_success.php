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
                            <h5 class="mt-5 mb-5">Password berhasil diubah, Silahkan <a href="<?= base_url('auth/'); if($role == 3){echo 'indexSiswa';}else{echo 'indexGuru';};?>">Login</a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>