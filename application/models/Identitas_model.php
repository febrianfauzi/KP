<?php

class Identitas_model extends CI_model
{
    public function user(){
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('siswa', 'user.id= siswa.id');
<<<<<<< HEAD
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
=======
        $this->db->where('email', $this->session->userdata('email'));
        return $this->db->get()->result();
>>>>>>> e7eeca2cd4c3f208d7d4a29f222823dc84719e3b
    }

    public function userGuru()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('guru', 'user.id= guru.id');
<<<<<<< HEAD
        $this->db->join('kelas', 'guru.id_kelas= kelas.id');
        $this->db->where('email', $this->session->userdata('email'));
        return $this->db->get()->result();
    }

    public function userAdmin()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('admin', 'user.id= admin.id');
=======
>>>>>>> e7eeca2cd4c3f208d7d4a29f222823dc84719e3b
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
<<<<<<< HEAD

=======
>>>>>>> e7eeca2cd4c3f208d7d4a29f222823dc84719e3b
    public function cekAkunGuru($id)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('guru', 'user.id= guru.id');
        $this->db->where('user.id', $id);
        return $this->db->get()->result();
    }
}