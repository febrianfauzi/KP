<?php

class Photo_model extends CI_model
{
    public function gantiFoto(){
        $id = $this->input->post('id', true);
        $foto = $_FILES['foto'];
        $name = $id . '.png';
        $config['upload_path']          = './assets/photo';
        $config['allowed_types']        = 'jpeg|jpg|png';
        $config['overwrite']            = true;
        $config['file_name']            = $name;
        $config['max_size']             = 2048;

        $this->load->library('upload', $config);

        if ($foto = '') {

        } else {
            if (!$this->upload->do_upload('foto')) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal merubah foto, Pastikan file berbentuk jpeg / jpg / png dan kurang dari 2 MB</div>');
            } else {
                // $this->session->unset_userdata('photo');
                $data = array(
                'image' => $name
            );
            $this->db->where('id', $id);
            $this->db->update('user', $data);
            
            $this->session->set_userdata('photo', $name);
            $this->session->set_userdata('photo', $name);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Foto Berhasil Diubah</div>');
            }
        }
    }
}