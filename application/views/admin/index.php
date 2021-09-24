
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Beranda Admin</h1>
        </div>
    </section>
    <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 ">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Data Kelas</h4>
                  </div>
                  <div class="card-body">
                  <?php echo $total_kelas ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Data Guru</h4>
                  </div>
                  <div class="card-body">
                  <?php echo $total_guru ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Data Siswa</h4>
                  </div>
                  <div class="card-body">
                  <?php echo $total_siswa ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
    
</div>
