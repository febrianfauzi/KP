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
    }
//     public function index()
//     {
//         $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
//         $data['role_id'] = 'admin';
//         $data['title'] = 'Dashboard';

//         $this->load->view('templates/user_header', $data);
//         $this->load->view('templates/user_sidebar', $data);
//         $this->load->view('admin/index', $data);
//         $this->load->view('templates/user_footer');
//     }
	public function index()
    {
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
        $user = $this->Identitas_model->userAdmin();
        foreach ($user as $row) {
            $nama = $row->nama;
            $image = $row->image;
        }
        
        
        $data = [
            'kelas' => $this->model_kelas->Tampil_data_kelas(),
          
           
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
        $post = $this->input->post(null, TRUE);
        if(isset($_POST['add'])){
            $this->model_kelas->add($post);
        } else if(isset($_POST['Edit_kelas'])){
            $this->model_kelas->Edit_kelas($post);
        }
        if($this->db->affected_rows() > 0){
            echo "<script>alert('Data berhasil disimpan');</script>";
        }
        echo "<script>window.location='".site_url('admin/Tampil_data_kelas')."';</script>";
    }

    public function Tambah_data_kelas()
    {
            $this->load->model('Data_kelas', 'model_kelas');
            $this->model_kelas->Tambah_data_kelas();
            
    }

    public function Edit_data_kelas($id)
    {
        $this->load->model('Data_kelas', 'model_kelas');
            $this->model_kelas->Tambah_data_kelas();
    }

    public function Hapus_data_kelas($id)
    {
        $this->model_kelas->Delete_kelas($id);
        if($this->db->affected_rows() > 0){
            echo "<script>alert('Data berhasil dihapus'):</script>";
        }
        echo "<script>window.location='".site_url('admin/Tampil_data_kelas')."':</script>";
        redirect('admin/Tampil_data_kelas');
    }
    
    public function Tampil_data_guru()
    {
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
        $post = $this->input->post(null, TRUE);
        if(isset($_POST['add'])){
            $this->model_guru->add($post);
        } else if(isset($_POST['Edit_guru'])){
            $this->model_guru->Edit_guru($post);
        }
        if($this->db->affected_rows() > 0){
            echo "<script>alert('Data berhasil disimpan');</script>";
        }
        echo "<script>window.location='".site_url('admin/Tampil_data_guru')."';</script>";
    }

    public function Tambah_data_guru()
    {
            $this->load->model('Data_guru', 'model_guru');
            $this->model_guru->Tambah_data_guru();
       
            
    }

    public function Edit_data_guru()
    {
        $this->load->model('Data_guru', 'model_guru');
            $this->model_guru->Tambah_data_guru();
    }

    public function Hapus_data_guru($id)
    {
        $this->model_guru->Delete_guru($id);
        if($this->db->affected_rows() > 0){
            echo "<script>alert('Data berhasil dihapus'):</script>";
        }
        echo "<script>window.location='".site_url('admin/Tampil_data_siswa')."':</script>";
        redirect('admin/Tampil_data_guru');
    }
    public function Tampil_data_siswa()
    {
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
        $post = $this->input->post(null, TRUE);
        if(isset($_POST['add'])){
            $this->model_siswa->add($post);
        } else if(isset($_POST['Edit_siswa'])){
            $this->model_siswa->Edit_siswa($post);
        }
        if($this->db->affected_rows() > 0){
            echo "<script>alert('Data berhasil disimpan');</script>";
        }
        echo "<script>window.location='".site_url('admin/Tampil_data_siswa')."';</script>";
    }


    public function Tambah_data_siswa()
    {
            $this->load->model('Data_siswa', 'model_siswa');
            $this->model_siswa->Tambah_data_siswa();
            $this->model_siswa->get_kelas2();
            
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
        $this->model_siswa->Delete_siswa($id);
        if($this->db->affected_rows() > 0){
            echo "<script>alert('Data berhasil dihapus'):</script>";
        }
        echo "<script>window.location='".site_url('admin/Tampil_data_siswa')."':</script>";
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
}
