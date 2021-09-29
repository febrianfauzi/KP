<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Title Web</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">[=]</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Daftar Menu</li>
            <li><a class="nav-link" href="<?= base_url($role_id); ?>"><i class="fas fa-fire"></i> <span>Beranda</span></a></li>
            <?php if ($role_id == 'admin') : ?>
                <li><a class="nav-link" href="<?= base_url('admin/Tampil_data_kelas'); ?>"><i class="fas fa-user-tie"></i> <span>Data Kelas</span></a></li>
                <li><a class="nav-link" href="<?= base_url('admin/Tampil_data_guru'); ?>"><i class="fas fa-user-tie"></i> <span>Data Guru</span></a></li>
                <li><a class="nav-link" href="<?= base_url('admin/Tampil_data_siswa'); ?>"><i class="fas fa-user-tie"></i> <span>Data Siswa</span></a></li>
            <?php endif ?>
            <?php if ($role_id == 'guru') : ?>
                <li><a class="nav-link" href="<?= base_url('guru/Tampil_data_siswa'); ?>"><i class="fas fa-users"></i> <span>Daftar Siswa</span></a></li>
                <li><a class="nav-link" href="<?= base_url('guru/kegiatan'); ?>"><i class="fas fa-tasks"></i><span>Kegiatan</span></a></li>
            <?php endif ?>
            <?php if ($role_id == 'siswa') : ?>
                <li><a class="nav-link" href="<?= base_url('siswa/absensi'); ?>"><i class="fas fa-tasks"></i> <span>Absensi</span></a></li>
            <?php endif ?>
            <?php if ($role_id != 'admin') : ?>
                <li><a class="nav-link" href="<?= base_url($role_id . '/profile'); ?>"><i class="far fa-user"></i> <span>Profil</span></a></li>
            <?php endif ?>
            <li class="menu-header">
                <hr>
            </li>
            <li><a class="nav-link" href="<?= base_url('auth/logout_'.$this->session->role); ?>"><i class="fas fa-sign-out-alt"></i> <span>Keluar</span></a></li>
        </ul>
    </aside>
</div>