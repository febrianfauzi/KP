<?php

class Data_guru extends CI_model
{

    public function get($id = null)
    {


        $this->db->select('g.*, u.*,k.nama_kelas AS nama_kelas')->from('guru AS g')->join('user AS u', 'g.id=u.id')->join('kelas AS k', 'g.id_kelas=k.id');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $this->db->order_by('g.id','desc');
        $query = $this->db->get()->result();
        return $query;
    }

    public function getkelas()
    {
        return $this->db->select('*')->from('kelas')->get()->result_array();
    }



    public function Tambah_data_guru()
    {
        $this->db->trans_start();
        // jalankan query

        $user = [
            'image' => 'default.jpg',
            'role_id' => 2

        ];

        $this->db->insert('user', $user);

        $last_id = $this->db->insert_id();

        $guru = [
            'id' => $last_id,
            'nip' => $this->input->post('nip', true),
            'nama_guru' => $this->input->post('nama', true),
            'id_kelas' => $this->input->post('kelas2', true)

        ];

        //insert db
        $this->db->insert('guru', $guru);

        $this->db->trans_complete();

    }

    public function Edit_guru($post)
    {
        $this->db->trans_start();


        $where1 = array('id' => $this->input->post('id'));
        $data1 = array(
            'nama_guru' => $this->input->post('nama'),
            'id_kelas' => $this->input->post('id_kelas'),
            'alamat' => $this->input->post('alamat')
        );
        $this->db->update('guru', $data1, $where1);

        $data2 = array('email' => $this->input->post('email'));
        $this->db->update('user', $data2, $where1);
        $this->db->trans_complete();
        
    }

    public function Delete_guru($id)
    {
        $this->db->trans_start();
        $this->db->delete('guru', ['id' => $id]);
        $this->db->delete('user', ['id' => $id]);
        $this->db->trans_complete();
    }


    public function Hitung_guru()
    {
        $query = $this->db->query("SELECT * FROM guru");
        return $query->num_rows();
    }
}
