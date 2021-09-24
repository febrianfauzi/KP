<?php

class Data_kelas extends CI_model
{
    public function Tambah_data_kelas()
    {
        $this->db->trans_start();
        // jalankan query        
        
        $kelas = [
            'nama_kelas' => $this->input->post('nama_kelas', true)
        ];

        
        //insert db
        $this->db->insert('kelas', $kelas);

        $this->db->trans_complete();
        $this->session->set_flashdata('message', 'Ditambahkan.');

        redirect('admin/Tampil_data_kelas');
                
        
    }

    public function Tampil_jum_siswa($id)
    {

        $this->db->select('COUNT(id_kelas) as total')->from('siswa')->join('kelas', 'siswa.id_kelas=kelas.id');
        $this->db->where('id_kelas', $id);
        $hasil = $this->db->get();
        foreach($hasil->result() as $row){
            echo $row->total;
        }
    }

        public function Tampil_data_kelas()
        {
            // return $this->db->select('k.id AS id_kelas, k.nama AS nama_kelas, s.nama AS nama_murid, g.nama AS nama_guru')
            // ->from('kelas AS k')
            // ->join('siswa AS s', 'k.id=s.id_kelas')
            // ->join('guru AS g', 'k.id=g.id_kelas')

            // return $this->db->select('*')
            // ->from('kelas')
            
            // ->get()->result_array();
            $this->db->select('*')->from('kelas');
            // $this->db->group_by('nama_kelas');  
            $hasil = $this->db->get();
           return $hasil;

           
        }

        public function Delete_kelas($id)
    {
        $this->db->trans_start();
        $this->db->delete('kelas',['id' => $id]);
        $this->db->trans_complete();
    }
        public function Hitung_kelas()
        {
            $query = $this->db->query("SELECT * FROM kelas");
            return $query->num_rows();
               
        }
}
?>