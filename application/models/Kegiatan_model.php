<?php

class Kegiatan_model extends CI_model
{
    public function getAllKegiatan($id)
    {
        $this->db->where('id_kelas',$id);
        return $this->db->get('kegiatan')->result_array();
    }

    public function tambahDataKegiatan()
    {
        $data = array(
            'id' => null,
            'nama_kegiatan' => $this->input->post('nama', true),
            'ket' => $this->input->post('ket', true),
            'id_kelas' => $this->input->post('id_kelas', true),
        );
        $this->db->insert('kegiatan', $data);
    }

    public function hapusDataKegiatan($id)
    {
        //$this->db->where('id', $id);
        $this->db->delete('kegiatan', ['id' => $id]);
    }

    public function getKegiatanById($id)
    {
        return $this->db->get_where('kegiatan', ['id' => $id])->row_array();
    }

    public function ubahDataKegiatan()
    {
        $data = array(
            'nama_kegiatan' => $this->input->post('nama', true),
            'ket' => $this->input->post('ket', true)
        );
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('kegiatan', $data);
    }

    public function cariDataKegiatan()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('nama_kegiatan', $keyword);
        $this->db->or_like('ket', $keyword);
        return $this->db->get('kegiatan')->result_array();
    }
}
