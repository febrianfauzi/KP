<?php

class Session_model extends CI_model
{
    public function Admin_login(){
        if($this->session->role_id !== '1'){
            
        }
    }

    public function Guru_login(){
        if ($this->session->role_id !== '2') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Harap Login Terlebih Dahulu</div>');
            redirect('auth/indexGuru');
        }
    }

    public function Siswa_login(){
        if ($this->session->role_id !== '3') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Harap Login Terlebih Dahulu</div>');
            redirect('auth/indexSiswa');
        }
    }
}