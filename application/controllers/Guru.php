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
<<<<<<< HEAD
            $kelas = $row->nama_kelas;
=======
            $kelas = $row->kelas;
>>>>>>> e7eeca2cd4c3f208d7d4a29f222823dc84719e3b
            $email = $row->email;
        }
        $data['user'] = $nama;
        $data['image'] = $image;
        $data['identitas'] = $identitas;
        $data['kelas'] = $kelas;
        $data['email'] = $email;
        $data['role_id'] = 'guru';
        $data['title'] = 'Profil Guru';

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('guru/profile', $data);
        $this->load->view('templates/user_footer');
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
        }
        $data['user'] = $nama;
        $data['image'] = $image;
        $data['role_id'] = 'guru';
        $data['title'] = 'Kegiatan';
        $data['kegiatan'] = $this->Kegiatan_model->getAllKegiatan();
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
        }
        $data['user'] = $nama;
        $data['image'] = $image;
        $data['role_id'] = 'guru';
        $data['title'] = 'Kegiatan';
        $data['Ukegiatan'] = $this->Kegiatan_model->getKegiatanById($id);
        $data['kegiatan'] = $this->Kegiatan_model->getAllKegiatan();

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
        $data['kegiatan'] = $this->Kegiatan_model->getAllKegiatan();
        if (isset($_POST['nis'])) {
            $this->session->set_userdata('siswa', $_POST['nis']);
        }
        $siswa = $this->Identitas_model->siswa($this->session->siswa);
        foreach ($user as $row) {
            $nama = $row->nama_guru;
            $image = $row->image;
        }
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
        $this->session->set_userdata('role', 'guru');
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
        $data['kegiatan'] = $this->Kegiatan_model->getAllKegiatan();

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
        }


        $data = [
            'row' => $this->model_siswa->get(),
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
