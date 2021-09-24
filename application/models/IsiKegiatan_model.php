<?php

class IsiKegiatan_model extends CI_model
{
    // public function getAllKegiatan()
    // {
    //     return $this->db->get('kegiatan')->result_array();
    // }

    public function tambahDataKegiatan()
    {
        $data = array(
            'id' => null,
            'tgl' => $this->input->post('tgl', true),
            'nis' => $this->input->post('nis', true),
            'nama_kegiatan' => $this->input->post('nama', true),
            'tindakan' => $this->input->post('tindakan', true)
        );
        $this->db->insert('kegiatan', $data);
    }

    public function cekDataKegiatan($kegiatan, $identitas, $tgl)
    {
        $i = 1;
        foreach ($kegiatan as $row) :
            $checked = $this->IsiKegiatan_model->dataKegiatan($row['id'], $identitas, $tgl);
            if ($checked == 'Ya') {
                $radio = '<div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="Pilihan[' . $row['id'] . ']" id="' . $row['id'] . 'a" value="Ya" checked>
                            <label class="form-check-label" for="' . $row['id'] . 'a">Ya</label>
                            </div>
                            <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="Pilihan[' . $row['id'] . ']" id="' . $row['id'] . 'b" value="Tidak">
                            <label class="form-check-label" for="' . $row['id'] . 'b">Tidak</label>
                            </div>';
            } elseif ($checked == 'Tidak') {
                $radio = '<div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="Pilihan[' . $row['id'] . ']" id="' . $row['id'] . 'a" value="Ya">
                            <label class="form-check-label" for="' . $row['id'] . 'a">Ya</label>
                            </div>
                            <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="Pilihan[' . $row['id'] . ']" id="' . $row['id'] . 'b" value="Tidak" checked>
                            <label class="form-check-label" for="' . $row['id'] . 'b">Tidak</label>
                            </div>';
            }else{
                $radio = '<div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="Pilihan[' . $row['id'] . ']" id="' . $row['id'] . 'a" value="Ya">
                            <label class="form-check-label" for="' . $row['id'] . 'a">Ya</label>
                            </div>
                            <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="Pilihan[' . $row['id'] . ']" id="' . $row['id'] . 'b" value="Tidak">
                            <label class="form-check-label" for="' . $row['id'] . 'b">Tidak</label>
                            </div>';
            }
            echo '<tr>';
            echo '<td class="text-center">' . $i++ . '.</td>';
            echo '<td><pre>' . $row['nama_kegiatan'] . '</pre></td>';
            echo '<td>' . $radio . '</td>';
            echo '</tr>';
        endforeach;
    }

    public function dataKegiatan($id, $nis, $tgl)
    {
        $this->db->where('nis', $nis);
        $this->db->where('tgl', $tgl);
        $this->db->where('id_kegiatan', $id);
        $query = $this->db->get('isi_kegiatan')->result();
        foreach ($query as $q) {

            if ($q->tindakan == 'Ya') {
                $data = 'Ya';
            } elseif ($q->tindakan == 'Tidak') {
                $data = 'Tidak';
            }
            return $data;
        }
    }
    public function isi($id, $nis, $tgl)
    {
        $this->db->where('nis', $nis);
        $this->db->where('tgl', $tgl);
        $this->db->where('id_kegiatan', $id);
        $query = $this->db->get('isi_kegiatan')->result();

        foreach ($query as $q) {
            if ($q->tindakan == 'Ya') {
                $data = '<i class="fas fa-check green"></i>';
            } elseif ($q->tindakan == 'Tidak') {
                $data = '<i class="fas fa-times red"></i>';
            }
            return $data;
        }
    }
}
