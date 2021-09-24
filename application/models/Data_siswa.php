<?php

class Data_siswa extends CI_model
{
    
    public function get($id = null)
    {
      

        $this->db->select('s.*, u.*,k.nama_kelas AS nama_kelas')->from('siswa AS s')->join('user AS u', 's.id=u.id')->join('kelas AS k', 's.id_kelas=k.id');
        if($id != null){
            $this->db->where('id', $id);
        }
        $this->db->order_by('s.id', 'desc'); 
        $query = $this->db->get()->result();
        return $query;
    }
    
    public function getkelas(){
        return $this->db->select('*')->from('kelas')->get()->result_array();        
    }



    public function Tambah_data_siswa()
    {
        $this->db->trans_start();
        // jalankan query

        $user = [
            'image' => 'default.jpg',
            'role_id' => 3
            
        ];
       
        $this->db->insert('user', $user);

        $last_id = $this->db->insert_id();

       
        
        
        $siswa = [
            'id' => $last_id,
            'nis' => $this->input->post('nis', true),
            'nama_siswa' => $this->input->post('nama', true),
            'id_kelas' => $this->input->post('kelas2', true)
            
        ];

        
        //insert db
        $this->db->insert('siswa', $siswa);

        
        
        $this->db->trans_complete();
        
        
    }

    public function Edit_siswa($post)
    {
        $this->db->trans_start();
    

        $where1 = array('id' => $this->input->post('id'));
        $data1 = array(
                'nama_siswa'=>$this->input->post('nama'),
                'id_kelas'=>$this->input->post('id_kelas'),
                'alamat'=>$this->input->post('alamat'));
        $this->db->update('siswa', $data1, $where1);
        
        $data2 = array('email'=>$this->input->post('email'));
        $this->db->update('user', $data2, $where1);
        $this->db->trans_complete();
      

    }

    public function Delete_siswa($id)
    {
        $this->db->trans_start();
        $this->db->delete('siswa',['id' => $id]);
        $this->db->delete('user',['id' => $id]);
        $this->db->trans_complete();
    }


    public function Hitung_siswa()
    {
        $query = $this->db->query("SELECT * FROM siswa");
        return $query->num_rows();
           
    }

       
}
?>