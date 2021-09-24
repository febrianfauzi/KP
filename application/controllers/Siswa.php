<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kegiatan_model');
        $this->load->model('IsiKegiatan_model');
        $this->load->model('Identitas_model');
        $this->load->model('Absen_model');
        $this->load->model('Session_model');
    }

    public function index()
    {
        $this->Session_model->Siswa_login();
        $user = $this->Identitas_model->user();
        foreach ($user as $row) {
            $nama = $row->nama_siswa;
            $image = $row->image;
        }
        $data['user'] = $nama;
        $data['image'] = $image;
        $data['role_id'] = 'siswa';
        $data['title'] = 'Beranda Siswa';

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('siswa/index', $data);
        $this->load->view('templates/user_footer');
    }

    public function profile()
    {
        $this->Session_model->Siswa_login();
        $user = $this->Identitas_model->user();
        foreach ($user as $row) {
            $nama = $row->nama_siswa;
            $image = $row->image;
            $identitas = $row->nis;
            $email = $row->email;
            $kelas = $row->nama_kelas;
        }
        $data['user'] = $nama;
        $data['image'] = $image;
        $data['email'] = $email;
        $data['kelas'] = $kelas;
        $data['identitas'] = $identitas;
        $data['role_id'] = 'siswa';
        $data['title'] = 'Profil siswa';

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('siswa/profile', $data);
        $this->load->view('templates/user_footer');
    }

    public function absensi()
    {
        $this->Session_model->Siswa_login();
        if ($this->input->post('bulan')) {
            $data['bln'] = $this->input->post('bulan');
            $this->session->set_userdata('bulan', $this->input->post('bulan'));
        }
        if ($this->input->post('tahun')) {
            $data['thn'] = $this->input->post('tahun');
            $this->session->set_userdata('tahun', $this->input->post('tahun'));
        }
        $user = $this->Identitas_model->user();
        $data['kegiatan'] = $this->Kegiatan_model->getAllKegiatan();
        foreach ($user as $row) {
            $nama = $row->nama_siswa;
            $image = $row->image;
            $identitas = $row->nis;
            $kelas = $row->nama_kelas;
        }
        $data['kelas'] = $kelas;
        $data['user'] = $nama;
        $data['image'] = $image;
        $data['identitas'] = $identitas;
        $data['role_id'] = 'siswa';
        $this->session->set_userdata('role', 'siswa');
        $data['title'] = 'Absensi siswa';

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('siswa/absensi', $data);
        $this->load->view('templates/user_footer');
    }
    public function isi_kegiatan($tgl)
    {
        $this->Session_model->Siswa_login();
        $user = $this->Identitas_model->user();
        foreach ($user as $row) {
            $nama = $row->nama_siswa;
            $image = $row->image;
            $identitas = $row->nis;
        }
        $data['tgl'] = $tgl;
        $data['user'] = $nama;
        $data['image'] = $image;
        $data['identitas'] = $identitas;
        $data['role_id'] = 'siswa';
        $data['title'] = 'Isi Kegiatan siswa';
        $data['kegiatan'] = $this->Kegiatan_model->getAllKegiatan();

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('siswa/isi_kegiatan', $data);
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
                redirect('siswa/absensi');
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
                redirect('siswa/absensi');
            }
        }
    }
}
