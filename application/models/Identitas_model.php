<?php

class Identitas_model extends CI_model
{
    public function user(){
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('siswa', 'user.id= siswa.id');
        $this->db->where('email', $this->session->userdata('email'));
        return $this->db->get()->result();
    }

    public function userGuru()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('guru', 'user.id= guru.id');
        $this->db->where('email', $this->session->userdata('email'));
        return $this->db->get()->result();
    }

    public function cekAkunMurid($id){
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('siswa', 'user.id= siswa.id');
        $this->db->where('user.id', $id);
        return $this->db->get()->result();
    }
}