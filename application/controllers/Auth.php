<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Identitas_model');
    }

    public function index(){
        $this->indexSiswa();
    }

    public function indexSiswa()
    {
        $data['title'] = 'User Login';

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required' => 'Email tidak boleh kosong',
            'valid_email' => 'Email harus valid, Contoh: @gmail.com, @yahoo.com, dll.'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'Password tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            $this->loginSiswa();
        }
    }

    private function loginSiswa()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if($user['role_id'] == 3) {
            if (password_verify($password, $user['password'])) {
                $data = [
                    'email' => $user['email'],
                    'role_id' => $user['role_id']
                ];
                $this->session->set_userdata($data);
                if ($user['role_id'] == 3) {
                    $this->session->set_userdata('role', 'siswa');
                    $this->session->set_userdata('photo', $user['image']);
                    redirect('siswa');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
                redirect('auth/indexSiswa');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email yang digunakan belum terdaftar</div>');
            redirect('auth/indexSiswa');
        }
    }

    public function registration()
    {
        $data['title'] = 'User Registration';

        $this->form_validation->set_rules('nis', 'NIS', 'required|trim', [
            'required' => 'NIS tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'required' => 'Email tidak boleh kosong',
            'valid_email' => 'Email tidak valid',
            'is_unique' => 'Email ini sudah penah digunakan!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[4]|matches[password2]', [
            'required' => 'Password tidak boleh kosong',
            'min_length' => 'Password harus lebih dari 4 karakter!',
            'matches' => 'Password dan Konfirmasi Password tidak sama!'
        ]);
        $this->form_validation->set_rules('password2', 'Confirm Password', 'required|trim|min_length[4]|matches[password]');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            $nis = $this->db->get_where('siswa', ['nis' => $this->input->post('nis')])->row_array();
            $this->db->where('nis', $this->input->post('nis', true));
            $query = $this->db->get('siswa')->result();
            foreach ($query as $row) {
                $id = $row->id;
            }
            $akun = $this->Identitas_model->cekAkunSiswa($id);
            foreach ($akun as $a) {
                $password = $a->password;
            }
            if ($password) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">NIS sudah digunakan</div>');
                redirect('auth/indexSiswa');
            } else {
                if ($nis) {
                    $data = [
                        'email' => $this->input->post('email', true),
                        'image' => 'default.jpg',
                        'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                        'role_id' => 3
                    ];
                    $this->db->where('id', $id);
                    $this->db->update('user', $data);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat!, Akun anda telah dibuat, Silahkan Login!</div>');
                    redirect('auth/indexSiswa');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">NIS belum terdaftar</div>');
                    redirect('auth/indexSiswa');
                }
            }
        }
    }

    public function indexGuru()
    {
        $data['title'] = 'User Login';

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required' => 'Email tidak boleh kosong',
            'valid_email' => 'Email harus valid, Contoh: @gmail.com, @yahoo.com, dll.'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'Password tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login_guru');
            $this->load->view('templates/auth_footer');
        } else {
            $this->loginGuru();
        }
    }

    public function loginGuru(){
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user['role_id'] == 2 ) {
            if (password_verify($password, $user['password'])) {
                $data = [
                    'email' => $user['email'],
                    'role_id' => $user['role_id']
                ];
                $this->session->set_userdata($data);
                if ($user['role_id'] == 2) {
                    $this->session->set_userdata('role', 'guru');
                    $this->session->set_userdata('photo', $user['image']);
                    redirect('guru');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
                redirect('auth/loginGuru');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email yang digunakan belum terdaftar</div>');
            redirect('auth/loginGuru');
        }
    }

    public function registrationGuru()
    {
        $data['title'] = 'User Registration';

        $this->form_validation->set_rules('nip', 'NIP', 'required|trim', [
            'required' => 'NIS tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'required' => 'Email tidak boleh kosong',
            'valid_email' => 'Email tidak valid',
            'is_unique' => 'Email ini sudah penah digunakan!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[4]|matches[password2]', [
            'required' => 'Password tidak boleh kosong',
            'min_length' => 'Password harus lebih dari 4 karakter!',
            'matches' => 'Password dan Konfirmasi Password tidak sama!'
        ]);
        $this->form_validation->set_rules('password2', 'Confirm Password', 'required|trim|min_length[4]|matches[password]');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration_guru');
            $this->load->view('templates/auth_footer');
        } else {
            $nip = $this->db->get_where('guru', ['nip' => $this->input->post('nip')])->row_array();
            $this->db->where('nip', $this->input->post('nip', true));
            $query = $this->db->get('guru')->result();
            foreach ($query as $row) {
                $id = $row->id;
            }
            $akun = $this->Identitas_model->cekAkunGuru($id);
            foreach ($akun as $a) {
                $password = $a->password;
            }
            if ($password) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">NIP sudah digunakan</div>');
                redirect('auth/indexGuru');
            } else {
                if ($nip) {
                    $data = [
                        'email' => $this->input->post('email', true),
                        'image' => 'default.jpg',
                        'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                        'role_id' => 2
                    ];
                    $this->db->where('id', $id);
                    $this->db->update('user', $data);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat!, Akun anda telah dibuat, Silahkan Login!</div>');
                    redirect('auth/indexGuru');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">NIP belum terdaftar</div>');
                    redirect('auth/indexGuru');
                }
            }
        }
    }

    public function lupa_password_siswa(){
        $data['title'] = 'Lupa Password';
        $data['role'] = '3';
        $this->load->view('templates/auth_header', $data);
        $this->load->view('auth/lupa_password');
        $this->load->view('templates/auth_footer');
    }

    public function lupa_password_guru()
    {
        $data['title'] = 'Lupa Password';
        $data['role'] = '2';
        $this->load->view('templates/auth_header', $data);
        $this->load->view('auth/lupa_password');
        $this->load->view('templates/auth_footer');
    }

    public function email_confirm(){
        $email = $this->input->post('email',true);
        $role = $this->input->post('role',true);

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if($user['role_id'] == $role){
            $data['title'] = 'Lupa Password';
            $data['id'] = $user['id'];
            $data['role'] = $role;
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/password_baru');
            $this->load->view('templates/auth_footer');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email tidak terdaftar</div>');
            if($role == 3){
                redirect('auth/lupa_password_siswa');
            }else{
                redirect('auth/lupa_password_guru');
            }
        }
    }

    public function change_password(){
        $data['title'] = 'Lupa Password';
        $id = $this->input->post('id',true);
        $data['id'] = $id;
        $role = $this->input->post('role', true);
        $data['role'] = $role;
        $password1 = $this->input->post('password1',true);
        $password2 = $this->input->post('password2',true);

        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[4]|matches[password2]', [
            'required' => 'Password tidak boleh kosong',
            'min_length' => 'Password harus lebih dari 4 karakter !',
            'matches' => 'Password dan Konfirmasi Password tidak sama !'
        ]);
        $this->form_validation->set_rules('password2', 'Confirm Password', 'required|trim|min_length[4]|matches[password1]');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/password_baru');
            $this->load->view('templates/auth_footer');
        } else {
            $data = array(
                'password' => password_hash($password1, PASSWORD_DEFAULT),
            );
            $this->db->where('id', $id);
            $this->db->update('user', $data);

            $data['title'] = 'Lupa Password';
            $data['role'] = $role;
            $this->load->view('templates/auth_header',$data);
            $this->load->view('auth/pass_success');
            $this->load->view('templates/auth_footer');
        }
    }

    public function logout_siswa()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->unset_userdata('role');
        $this->session->unset_userdata('photo');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah Logout!</div>');
        redirect('auth/indexSiswa');
    }

    public function logout_guru()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->unset_userdata('role');
        $this->session->unset_userdata('photo');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah Logout!</div>');
        redirect('auth/indexGuru');
    }

    public function logout_admin()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->unset_userdata('role');
        $this->session->unset_userdata('photo');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah Logout!</div>');
        redirect('admin/login');
    }
}