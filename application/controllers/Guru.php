<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kegiatan_model');
        $this->load->library('form_validation');
        $this->load->model('Identitas_model');
        $this->load->model('Data_siswa', 'model_siswa');
        $this->load->model('Data_kelas', 'model_kelas');
        $this->load->model('Absen_model');
        $this->load->model('Kegiatan_model');
        $this->load->model('IsiKegiatan_model');
        $this->load->model('Session_model');
        $this->load->model('Photo_model');
    }

    public function index()
    {
        
        $this->Session_model->Guru_login();
        $user = $this->Identitas_model->userGuru();
        foreach ($user as $row) {
            $nama = $row->nama_guru;
            $image = $row->image;
        }
        $data['user'] = $nama;
        $data['image'] = $image;
        $data['role_id'] = 'guru';
        $data['title'] = 'Beranda Guru';

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('guru/index', $data);
        $this->load->view('templates/user_footer');
    }

    public function profile()
    {
        $this->Session_model->Guru_login();
        $user = $this->Identitas_model->userGuru();
        foreach ($user as $row) {
            $nama = $row->nama_guru;
            $image = $row->image;
            $identitas = $row->nip;
            $kelas = $row->nama_kelas;
            $email = $row->email;
            $id = $row->id_guru;
            $id_kelas = $row->id_kelas;
            $alamat = $row->alamat;
        }
        $data['user'] = $nama;
        $data['image'] = $image;
        $data['identitas'] = $identitas;
        $data['kelas'] = $kelas;
        $data['email'] = $email;
        $data['alamat'] = $alamat;
        $data['id'] = $id;
        $data['id_kelas'] = $id_kelas;
        $data['role_id'] = 'guru';
        $data['title'] = 'Profil Guru';
        $this->session->set_userdata('photo', $image);

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('guru/profile', $data);
        $this->load->view('templates/user_footer');
    }

    public function gantiPhoto()
    {
        $this->Photo_model->gantiFoto();
        redirect('guru/profile');
    }

    public function gantiPassword()
    {
        $user = $this->Identitas_model->userGuru();
        foreach ($user as $row) {
            $nama = $row->nama_guru;
            $image = $row->image;
            $identitas = $row->nip;
            $email = $row->email;
            $kelas = $row->nama_kelas;
            $id = $row->id_guru;
            $id_kelas = $row->id_kelas;
        }
        $data['user'] = $nama;
        $data['image'] = $image;
        $data['email'] = $email;
        $data['kelas'] = $kelas;
        $data['identitas'] = $identitas;
        $data['id'] = $id;
        $data['id_kelas'] = $id_kelas;
        $data['role_id'] = 'guru';
        $data['title'] = 'Profil Guru';

        $oldpassword = $this->input->post('oldpassword');
        $password1 = $this->input->post('password1');
        $password2 = $this->input->post('password2');
        $id = $this->input->post('id');

        $this->form_validation->set_rules('oldpassword', 'Password lama', 'required|trim', [
            'required' => 'Tidak boleh kosong'
        ]);

        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[4]|matches[password2]', [
            'required' => 'Tidak boleh kosong',
            'min_length' => 'Password harus lebih dari 4 karakter !',
            'matches' => 'Password dan Konfirmasi Password tidak sama !'
        ]);
        $this->form_validation->set_rules('password2', 'Confirm Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('guru/profile', $data);
            $this->load->view('templates/user_footer');
        } else {
            $user = $this->db->get_where('user', ['id' => $id])->row_array();
            if (password_verify($oldpassword, $user['password'])) {
                $data = array(
                    'password' => password_hash($password1, PASSWORD_DEFAULT),
                );
                $this->db->where('id', $id);
                $this->db->update('user', $data);
                $this->session->set_flashdata('msgPass', '<div class="alert alert-success" role="alert">Password telah berhasil diubah</div>');
                redirect('guru/profile');
            } else {
                $this->session->set_flashdata('msgPass', '<div class="alert alert-danger" role="alert">Password lama salah</div>');
                redirect('guru/profile');
            }
        }
    }

    public function gantiProfile()
    {
        $id = $this->input->post('id', true);
        $nama = $this->input->post('nama', true);
        $id_kelas = $this->input->post('kelas', true);
        $email = $this->input->post('email', true);
        $alamat = $this->input->post('alamat', true);

        $data = array(
            'nama_guru' => $nama,
            'id_kelas' => $id_kelas,
            'alamat' => $alamat
        );
        $this->db->where('id', $id);
        $this->db->update('guru', $data);

        $data = array(
            'email' => $email
        );
        $this->db->where('id', $id);
        $this->db->update('user', $data);

        $this->session->set_userdata('email', $email);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profile telah berhasil diubah</div>');
        redirect('guru/profile');
    }

    public function list_murid()
    {
        $this->Session_model->Guru_login();
        $user = $this->Identitas_model->userGuru();
        foreach ($user as $row) {
            $nama = $row->nama_guru;
            $image = $row->image;
        }
        $data['user'] = $nama;
        $data['image'] = $image;
        $data['role_id'] = 'guru';
        $data['title'] = 'Profil Guru';

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('guru/list_murid', $data);
        $this->load->view('templates/user_footer');
    }

    public function kegiatan()
    {
        $this->Session_model->Guru_login();
        $user = $this->Identitas_model->userGuru();
        foreach ($user as $row) {
            $nama = $row->nama_guru;
            $image = $row->image;
            $id_kelas = $row->id_kelas;
        }
        $data['user'] = $nama;
        $data['image'] = $image;
        $data['id_kelas'] = $id_kelas;
        $data['role_id'] = 'guru';
        $data['title'] = 'Kegiatan';
        $data['kegiatan'] = $this->Kegiatan_model->getAllKegiatan($id_kelas);
        if ($this->input->post('keyword')) {
            $data['kegiatan'] = $this->Kegiatan_model->cariDataKegiatan();
        }

        $this->form_validation->set_rules('nama', 'Nama Kegiatan', 'required',[
            'required' => 'Field Nama Kegiatan Harus Diisi'
        ]);
        $this->form_validation->set_rules('ket', 'Keterangan', 'required',[
            'required' => 'Field Keterangan Harus Diisi'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('guru/kegiatan', $data);
            $this->load->view('templates/user_footer');
        } else {
            $this->Kegiatan_model->tambahDataKegiatan();
            $this->session->set_flashdata('message', 'Ditambahkan.');
            redirect('guru/kegiatan');
        }
    }

    public function hapusKegiatan($id)
    {
        $this->Session_model->Guru_login();
        $this->Kegiatan_model->hapusDataKegiatan($id);
        $this->session->set_flashdata('message', 'Dihapus.');
        redirect('guru/kegiatan');
    }

    public function ubahKegiatan($id)
    {
        $this->Session_model->Guru_login();
        $user = $this->Identitas_model->userGuru();
        foreach ($user as $row) {
            $nama = $row->nama_guru;
            $image = $row->image;
            $id_kelas = $row->id_kelas;
        }
        $data['user'] = $nama;
        $data['image'] = $image;
        $data['id_kelas'] = $id_kelas;
        $data['role_id'] = 'guru';
        $data['title'] = 'Kegiatan';
        $data['Ukegiatan'] = $this->Kegiatan_model->getKegiatanById($id);
        $data['kegiatan'] = $this->Kegiatan_model->getAllKegiatan($id_kelas);

        $this->form_validation->set_rules('nama', 'Nama Kegiatan', 'required', [
            'required' => 'Field Nama Kegiatan Harus Diisi'
        ]);
        $this->form_validation->set_rules('ket', 'Keterangan', 'required', [
            'required' => 'Field Keterangan Harus Diisi'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('guru/kegiatan', $data);
            $this->load->view('templates/user_footer');
        } else {
            $this->Kegiatan_model->ubahDataKegiatan();
            $this->session->set_flashdata('message', 'Diperbaharui.');
            redirect('guru/kegiatan');
        }
    }

    public function absensi()
    {
        $this->Session_model->Guru_login();
        if ($this->input->post('bulan')) {
            $data['bln'] = $this->input->post('bulan');
            $this->session->set_userdata('bulan', $this->input->post('bulan'));
        }
        if ($this->input->post('tahun')) {
            $data['thn'] = $this->input->post('tahun');
            $this->session->set_userdata('tahun', $this->input->post('tahun'));
        }

        $user = $this->Identitas_model->userGuru();
        
        if (isset($_POST['nis'])) {
            $this->session->set_userdata('siswa', $_POST['nis']);
        }
        $siswa = $this->Identitas_model->siswa($this->session->siswa);
        foreach ($user as $row) {
            $nama = $row->nama_guru;
            $image = $row->image;
            $id_kelas = $row->id_kelas;
        }
        $data['kegiatan'] = $this->Kegiatan_model->getAllKegiatan($id_kelas);
        foreach ($siswa as $row) {
            $nama_siswa = $row->nama_siswa;
            // $image_siswa = $row->image;
            $identitas = $row->nis;
            $kelas = $row->nama_kelas;
        }

        $data['kelas'] = $kelas;
        $data['nama_siswa'] = $nama_siswa;
        // $data['image_siswa'] = $image_siswa;
        $data['identitas'] = $identitas;

        $data['user'] = $nama;
        $data['image'] = $image;
        $data['role_id'] = 'guru';
        
        $data['title'] = 'Absensi';
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('guru/absensi', $data);
        $this->load->view('templates/user_footer');
    }

    public function isi_kegiatan($tgl)
    {
        $this->Session_model->Guru_login();
        $user = $this->Identitas_model->userGuru();
        foreach ($user as $row) {
            $nama = $row->nama_guru;
            $image = $row->image;
            $id_kelas = $row->id_kelas;
        }
        $siswa = $this->Identitas_model->siswa($this->session->siswa);
        foreach ($siswa as $row) {
            $nama_siswa = $row->nama_siswa;
            // $image_siswa = $row->image;
            $identitas = $row->nis;
            $kelas = $row->nama_kelas;
        }

        $data['tgl'] = $tgl;
        $data['user'] = $nama;
        $data['image'] = $image;

        $data['nama_siswa'] = $nama_siswa;
        $data['kelas'] = $kelas;
        $data['identitas'] = $identitas;
        $data['role_id'] = 'guru';
        $data['title'] = 'Isi Kegiatan Murid';
        $data['kegiatan'] = $this->Kegiatan_model->getAllKegiatan($id_kelas);

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('guru/isi_kegiatan', $data);
        $this->load->view('templates/user_footer');


        if ($this->input->post('button') == 'simpan') {
            if (!empty($_POST['Pilihan'])) {
                foreach ($_POST['Pilihan'] as $kegiatan => $pilih) {
                    $data = array(
                        'id' => null,
                        'tgl' => $this->input->post('tgl', true),
                        'nis' => $this->input->post('nis', true),
                        'id_kegiatan' => $kegiatan,
                        'tindakan' => $pilih
                    );
                    $this->db->insert('isi_kegiatan', $data);
                }
                $this->session->set_flashdata('message', 'Disimpan.');
                redirect('guru/absensi');
            }
        } elseif ($this->input->post('button') == 'update') {
            if (!empty($_POST['Pilihan'])) {
                foreach ($_POST['Pilihan'] as $kegiatan => $pilih) {

                    $this->db->where('tgl', $this->input->post('tgl'));
                    $this->db->where('nis', $this->input->post('nis'));
                    $this->db->where('id_kegiatan', $kegiatan);
                    $this->db->delete('isi_kegiatan');

                    $data = array(
                        'id' => null,
                        'tgl' => $this->input->post('tgl', true),
                        'nis' => $this->input->post('nis', true),
                        'id_kegiatan' => $kegiatan,
                        'tindakan' => $pilih
                    );
                    $this->db->insert('isi_kegiatan', $data);
                }
                $this->session->set_flashdata('message', 'Diperbaharui.');
                redirect('guru/absensi');
            }
        }
    }

    public function Hapus_data_siswa($id)
    {
        $this->Session_model->Guru_login();
        $this->model_siswa->Delete_siswa($id);
        $this->session->set_flashdata('message', 'Dihapus.');
        redirect('gurun/Tampil_data_siswa');
    }

    public function Tambah_data_siswa()
    {
        $this->Session_model->Guru_login();
        $this->load->model('Data_siswa', 'model_siswa');
        $this->model_siswa->Tambah_data_siswa();
        // $this->model_siswa->get_kelas2();
        $this->session->set_flashdata('message', 'Ditambahkan.');
        redirect('guru/Tampil_data_siswa');
    }

    public function Tampil_data_siswa()
    {
        $this->Session_model->Guru_login();
        $user = $this->Identitas_model->userGuru();
        foreach ($user as $row) {
            $nama = $row->nama_guru;
            $image = $row->image;
            $id_kelas = $row->id_kelas;
        }


        $data = [
            'row' => $this->model_siswa->getSiswa($id_kelas),
            'kelas2' => $this->model_siswa->getkelas()

        ];



        $data['user'] = $nama;
        $data['image'] = $image;
        $data['role_id'] = 'guru';
        $data['title'] = 'Data Siswa';
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('guru/Tampil_data_siswa', $data);
        $this->load->view('templates/user_footer');
    }

    public function process_siswa()
    {
        $this->Session_model->Guru_login();
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {
            $this->model_siswa->add($post);
        } else if (isset($_POST['Edit_siswa'])) {
            $this->model_siswa->Edit_siswa($post);
            $this->session->set_flashdata('message', 'Diperbaharui.');
            redirect('guru/Tampil_data_siswa');
        }
    }
}
