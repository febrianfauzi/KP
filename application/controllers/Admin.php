<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Identitas_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->model('Data_kelas', 'model_kelas');
        $this->load->model('Data_siswa', 'model_siswa');
        $this->load->model('Data_guru', 'model_guru');
        $this->load->model('Absen_model');
        $this->load->model('Kegiatan_model');
        $this->load->model('IsiKegiatan_model');
        $this->load->model('Identitas_model');
        $this->load->model('Session_model');
    }

    public function login(){
        $data['title'] = 'Admin Login';

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required' => 'Email tidak boleh kosong',
            'valid_email' => 'Email harus valid, Contoh: @gmail.com, @yahoo.com, dll.'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'Password tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login_admin');
            $this->load->view('templates/auth_footer');
        } else {
            $this->loginAdmin();
        }
    }

    private function loginAdmin()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $data = [
                    'email' => $user['email'],
                    'role_id' => $user['role_id']
                ];
                $this->session->set_userdata($data);
                if ($user['role_id'] == 1) {
                    $this->session->set_userdata('role', 'admin');
                    redirect('admin');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
                redirect('auth/indexAdmin');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email yang digunakan belum terdaftar</div>');
            redirect('auth/indexAdmin');
        }
    }

    public function index()
    {
        if($this->session->role_id !== '1'){
            redirect('admin/login');
        }
        
        $user = $this->Identitas_model->userAdmin();
        foreach ($user as $row) {
            $nama = $row->nama;
            $image = $row->image;
        }

        $data['total_kelas'] = $this->model_kelas->Hitung_kelas();
        $data['total_guru'] = $this->model_guru->Hitung_guru();
        $data['total_siswa'] = $this->model_siswa->Hitung_siswa();

        $data['user'] = $nama;
        $data['image'] = $image;
        $data['role_id'] = 'admin';
        $data['title'] = 'Dashboard';


        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/user_footer');
    }

    public function Tampil_data_kelas()
    {
        $this->Session_model->Admin_login();
        $user = $this->Identitas_model->userAdmin();
        foreach ($user as $row) {
            $nama = $row->nama;
            $image = $row->image;
        }


        $data = [
            'kelas' => $this->model_kelas->Tampil_data_kelas()

        ];


        $data['user'] = $nama;
        $data['image'] = $image;
        $data['role_id'] = 'admin';
        $data['title'] = 'Data Kelas';
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('admin/Tampil_data_kelas', $data);
        $this->load->view('templates/user_footer');
    }

    public function process_kelas()
    {
        $this->Session_model->Admin_login();
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {
            $this->model_kelas->add($post);
        } else if (isset($_POST['Edit_kelas'])) {
            $this->model_kelas->Edit_kelas($post);
        }
        if ($this->db->affected_rows() > 0) {
            echo "<script>alert('Data berhasil disimpan');</script>";
        }
        echo "<script>window.location='" . site_url('admin/Tampil_data_kelas') . "';</script>";
    }

    public function Tambah_data_kelas()
    {
        $this->Session_model->Admin_login();
        $this->load->model('Data_kelas', 'model_kelas');
        $this->model_kelas->Tambah_data_kelas();
        
    }

    public function Edit_data_kelas($id)
    {
        $this->Session_model->Admin_login();
        $this->load->model('Data_kelas', 'model_kelas');
        $this->model_kelas->Tambah_data_kelas();
    }

    public function Hapus_data_kelas($id)
    {
        $this->Session_model->Admin_login();
        $this->model_kelas->Delete_kelas($id);
        $this->session->set_flashdata('message', 'Dihapus.');
        redirect('admin/Tampil_data_kelas');
    }

    public function Tampil_data_guru()
    {
        $this->Session_model->Admin_login();
        $user = $this->Identitas_model->userAdmin();
        foreach ($user as $row) {
            $nama = $row->nama;
            $image = $row->image;
        }


        $data = [
            'row' => $this->model_guru->get(),
            'kelas2' => $this->model_guru->getkelas()

        ];

        $data['user'] = $nama;
        $data['image'] = $image;
        $data['role_id'] = 'admin';
        $data['title'] = 'Data Guru';
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('admin/Tampil_data_guru', $data);
        $this->load->view('templates/user_footer');
    }

    public function process_guru()
    {
        $this->Session_model->Admin_login();
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {
            $this->model_guru->add($post);
        } else if (isset($_POST['Edit_guru'])) {
            $this->model_guru->Edit_guru($post);
            $this->session->set_flashdata('message', 'Diperbaharui.');
            redirect('admin/Tampil_data_guru');
        }
        
    }

    public function Tambah_data_guru()
    {
        $this->Session_model->Admin_login();
        $this->load->model('Data_guru', 'model_guru');
        $this->model_guru->Tambah_data_guru();
        $this->session->set_flashdata('message', 'Ditambahkan.');
        redirect('admin/Tampil_data_guru');
    }

    public function Edit_data_guru()
    {
        $this->Session_model->Admin_login();
        $this->load->model('Data_guru', 'model_guru');
        $this->model_guru->Tambah_data_guru();
        
    }

    public function Hapus_data_guru($id)
    {
        $this->Session_model->Admin_login();
        $this->model_guru->Delete_guru($id);
        $this->session->set_flashdata('message', 'Dihapus');
        redirect('admin/Tampil_data_guru');
    }
    public function Tampil_data_siswa()
    {
        $this->Session_model->Admin_login();
        $user = $this->Identitas_model->userAdmin();
        foreach ($user as $row) {
            $nama = $row->nama;
            $image = $row->image;
        }


        $data = [
            'row' => $this->model_siswa->get(),
            'kelas2' => $this->model_siswa->getkelas()

        ];



        $data['user'] = $nama;
        $data['image'] = $image;
        $data['role_id'] = 'admin';
        $data['title'] = 'Data Siswa';
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('admin/Tampil_data_siswa', $data);
        $this->load->view('templates/user_footer');
    }

    public function process_siswa()
    {
        $this->Session_model->Admin_login();
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {
            $this->model_siswa->add($post);
        } else if (isset($_POST['Edit_siswa'])) {
            $this->model_siswa->Edit_siswa($post);
            $this->session->set_flashdata('message', 'Diperbaharui.');
            redirect('admin/Tampil_data_siswa');
        }
        
    }


    public function Tambah_data_siswa()
    {
        $this->Session_model->Admin_login();
        $this->load->model('Data_siswa', 'model_siswa');
        $this->model_siswa->Tambah_data_siswa();
        // $this->model_siswa->get_kelas2();
        $this->session->set_flashdata('message', 'Ditambahkan.');
        redirect('admin/Tampil_data_siswa');
    }

    // public function Edit_data_siswa($id)
    // {
    //     $query = $this->model->getkelas2($id);
    //     if($query->num_rows() > 0) {
    //         // $kelas2 = $query->row();
    //         $query_kelas = $this->model->getkelas2();

    //         $data = array(
    //             'page' => 'Edit_siswa',
    //             'kelas3' => $query_kelas 
    //         );
    //     } else {
    //         echo "<script>alert('Data tidak ditemukan');";
    //         echo "window.location'".site_url('admin/Tampil_data_siswa')."';</script>";
    //     }
    // }

    public function Hapus_data_siswa($id)
    {
        $this->Session_model->Admin_login();
        $this->model_siswa->Delete_siswa($id);
        $this->session->set_flashdata('message', 'Dihapus.');
        redirect('admin/Tampil_data_siswa');
    }

    // public function ubah()
    // {
    //     $id = $this->input->post('id');
    // $data = array(
    //     'nis'  => $this->input->post('nis'),
    //     'nama' => $this->input->post('nama'),
    //     'id_kelas' => $this->input->post('id_kelas')
    // );
    // $this->model_admin->ubah($data,$id);
    // $this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Data Berhasil diubah <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    // redirect('admin');
    // }

    public function absensi()
    {
        $this->Session_model->Admin_login();

        if ($this->input->post('bulan')) {
            $data['bln'] = $this->input->post('bulan');
            $this->session->set_userdata('bulan', $this->input->post('bulan'));
        }
        if ($this->input->post('tahun')) {
            $data['thn'] = $this->input->post('tahun');
            $this->session->set_userdata('tahun', $this->input->post('tahun'));
        }

        $user = $this->Identitas_model->userAdmin();
        $data['kegiatan'] = $this->Kegiatan_model->getAllKegiatan();
        if(isset($_POST['nis'])){
            $this->session->set_userdata('siswa', $_POST['nis']);
        }
        $siswa = $this->Identitas_model->siswa($this->session->siswa);
        foreach ($user as $row) {
            $nama = $row->nama;
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
        $data['role_id'] = 'admin';
        
        $data['title'] = 'Absensi';
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('admin/absensi', $data);
        $this->load->view('templates/user_footer');
    }

    public function isi_kegiatan($tgl)
    {
        $this->Session_model->Admin_login();
        $user = $this->Identitas_model->userAdmin();
        foreach ($user as $row) {
            $nama = $row->nama;
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
        $data['role_id'] = 'admin';
        $data['title'] = 'Isi Kegiatan Murid';
        $data['kegiatan'] = $this->Kegiatan_model->getAllKegiatan();

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('admin/isi_kegiatan', $data);
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
                redirect('admin/absensi');
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
                redirect('admin/absensi');
            }
        }
    }
}



