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
        $this->load->model('Photo_model');
        $this->load->library('form_validation');
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
            $id = $row->id_siswa;
            $id_kelas = $row->id_kelas;
            $alamat = $row->alamat;
        }
        $data['user'] = $nama;
        $data['image'] = $image;
        $data['email'] = $email;
        $data['kelas'] = $kelas;
        $data['alamat'] = $alamat;
        $data['identitas'] = $identitas;
        $data['id'] = $id;
        $data['id_kelas'] = $id_kelas;
        $data['role_id'] = 'siswa';
        $data['title'] = 'Profil siswa';
        $this->session->set_userdata('photo', $image);

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
        
        foreach ($user as $row) {
            $nama = $row->nama_siswa;
            $image = $row->image;
            $identitas = $row->nis;
            $kelas = $row->nama_kelas;
            $id_kelas = $row->id_kelas;
        }
        $data['kegiatan'] = $this->Kegiatan_model->getAllKegiatan($id_kelas);
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

    public function gantiPhoto(){
        $this->Photo_model->gantiFoto();
        redirect('siswa/profile');
    }

    public function gantiPassword(){
        $user = $this->Identitas_model->user();
        foreach ($user as $row) {
            $nama = $row->nama_siswa;
            $image = $row->image;
            $identitas = $row->nis;
            $email = $row->email;
            $kelas = $row->nama_kelas;
            $id = $row->id_siswa;
            $id_kelas = $row->id_kelas;
        }
        $data['user'] = $nama;
        $data['image'] = $image;
        $data['email'] = $email;
        $data['kelas'] = $kelas;
        $data['identitas'] = $identitas;
        $data['id'] = $id;
        $data['id_kelas'] = $id_kelas;
        $data['role_id'] = 'siswa';
        $data['title'] = 'Profil siswa';

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
            $this->load->view('siswa/profile', $data);
            $this->load->view('templates/user_footer');

        }else{
            $user = $this->db->get_where('user', ['id' => $id])->row_array();
            if (password_verify($oldpassword, $user['password'])) {
                $data = array(
                    'password' => password_hash($password1, PASSWORD_DEFAULT),
                );
                $this->db->where('id', $id);
                $this->db->update('user', $data);
                $this->session->set_flashdata('msgPass', '<div class="alert alert-success" role="alert">Password telah berhasil diubah</div>');
                redirect('siswa/profile');
            } else {
                $this->session->set_flashdata('msgPass', '<div class="alert alert-danger" role="alert">Password lama salah</div>');
                redirect('siswa/profile');
            }

        }
        
    }

    public function gantiProfile(){
        $id = $this->input->post('id',true);
        $nama = $this->input->post('nama', true);
        $id_kelas = $this->input->post('kelas', true);
        $email = $this->input->post('email', true);
        $alamat = $this->input->post('alamat', true);

        $data = array(
            'nama_siswa' => $nama,
            'id_kelas' => $id_kelas,
            'alamat' => $alamat
        );
        $this->db->where('id', $id);
        $this->db->update('siswa', $data);

        $data = array(
            'email' => $email
        );
        $this->db->where('id', $id);
        $this->db->update('user', $data);

        $this->session->set_userdata('email', $email);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profile telah berhasil diubah</div>');
        redirect('siswa/profile');
    }

    public function isi_kegiatan($tgl)
    {
        $this->Session_model->Siswa_login();
        $user = $this->Identitas_model->user();
        foreach ($user as $row) {
            $nama = $row->nama_siswa;
            $image = $row->image;
            $identitas = $row->nis;
            $id_kelas = $row->id_kelas;
        }
        $data['tgl'] = $tgl;
        $data['user'] = $nama;
        $data['image'] = $image;
        $data['identitas'] = $identitas;
        $data['role_id'] = 'siswa';
        $data['title'] = 'Isi Kegiatan siswa';
        $data['kegiatan'] = $this->Kegiatan_model->getAllKegiatan($id_kelas);

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
