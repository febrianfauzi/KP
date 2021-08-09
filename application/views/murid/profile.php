<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>My Profile</h1>
        </div>
    </section>
    <div class="row">
        <div class="col">
            <div class="card author-box card-primary">
                <div class="card-body">
                    <div class="author-box-name">
                        <h5>Info Pribadi</h5>
                        <hr>
                    </div>
                    <div class="author-box-left mr-3">
                        <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle author-box-picture">
                        <div class="clearfix"></div>
                        <a href="#" class="btn btn-primary mt-3">Ganti</a>
                    </div>
                    <div class="col mt-3">
                        <small>Nama :</small>
                        <h4><?= $user['name']; ?></h4>
                        <small>Kelas :</small>
                        <h6>Teknik Informatika</h6>
                        <small>Email :</small>
                        <h6><?= $user['email']; ?></h6>
                        <div class="w-100 d-sm-none"></div>
                    </div>
                    <hr>
                    <a href="#" class="btn btn-primary float-right">Ubah Data Pribadi</a>
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
                        <hr>
                    </div>
                    <div class="author-box-description">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="password" class="d-block">Password Lama</label>
                                    <input id="password" type="password" class="form-control" name="password">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="password" class="d-block">Password Baru</label>
                                    <input id="password" type="password" class="form-control" name="password">
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
                    <div class="w-100 d-sm-none"></div>
                </div>
            </div>
        </div>
    </div>
</div>