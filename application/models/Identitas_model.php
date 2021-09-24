<?php

class Identitas_model extends CI_model
{
    public function user(){
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('siswa', 'user.id= siswa.id');
        $this->db->join('kelas', 'siswa.id_kelas= kelas.id');
        $this->db->where('email', $this->session->userdata('email'));
        return $this->db->get()->result();
    }

    public function siswa($nis)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('siswa', 'user.id= siswa.id');
        $this->db->join('kelas', 'siswa.id_kelas= kelas.id');
        $this->db->where('nis', $nis);
        return $this->db->get()->result();
    }

    public function userGuru()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('guru', 'user.id= guru.id');
        $this->db->join('kelas', 'guru.id_kelas= kelas.id');
        $this->db->where('email', $this->session->userdata('email'));
        return $this->db->get()->result();
    }

    public function userAdmin()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('admin', 'user.id= admin.id');
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

    public function cekAkunGuru($id)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('guru', 'user.id= guru.id');
        $this->db->where('user.id', $id);
        return $this->db->get()->result();
    }
}