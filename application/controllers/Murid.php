<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Murid extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kegiatan_model');
        $this->load->model('IsiKegiatan_model');
        $this->load->model('Identitas_model');
        $this->load->model('Absen_model');
    }

    public function index()
    {
        $user = $this->Identitas_model->user();
        foreach ($user as $row) {
            $nama = $row->nama;
            $image = $row->image;
        }
        $data['user'] = $nama;
        $data['image'] = $image;
        $data['role_id'] = 'murid';
        $data['title'] = 'Beranda Murid';

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('murid/index', $data);
        $this->load->view('templates/user_footer');
    }

    public function profile()
    {
        $user = $this->Identitas_model->user();
        foreach ($user as $row) {
            $nama = $row->nama;
            $image = $row->image;
            $identitas = $row->nis;
            $email = $row->email;
            $kelas = $row->kelas;
        }
        $data['user'] = $nama;
        $data['image'] = $image;
        $data['email'] = $email;
        $data['kelas'] = $kelas;
        $data['identitas'] = $identitas;
        $data['role_id'] = 'murid';
        $data['title'] = 'Profil Murid';

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('murid/profile', $data);
        $this->load->view('templates/user_footer');
    }

    public function absensi(){
        $user = $this->Identitas_model->user();
        $data['kegiatan'] = $this->Kegiatan_model->getAllKegiatan();
        foreach ($user as $row) {
            $nama = $row->nama;
            $image = $row->image;
            $identitas = $row->nis;
            $kelas = $row->kelas;
        }
        $data['kelas'] = $kelas;
        $data['user'] = $nama;
        $data['image'] = $image;
        $data['identitas'] = $identitas;
        $data['role_id'] = 'murid';
        $data['title'] = 'Absensi Murid';

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('murid/absensi', $data);
        $this->load->view('templates/user_footer');
    }
    public function isi_kegiatan($tgl)
    {
        $user = $this->Identitas_model->user();
        foreach ($user as $row) {
            $nama = $row->nama;
            $image = $row->image;
            $identitas = $row->nis;
        }
        $data['tgl'] = $tgl;
        $data['user'] = $nama;
        $data['image'] = $image;
        $data['identitas'] = $identitas;
        $data['role_id'] = 'murid';
        $data['title'] = 'Isi Kegiatan Murid';
        $data['kegiatan'] = $this->Kegiatan_model->getAllKegiatan();

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('murid/isi_kegiatan', $data);
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
                redirect('murid/absensi');
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
                redirect('murid/absensi');
            }
        }
    }
}
