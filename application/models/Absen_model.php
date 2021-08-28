<?php

class Absen_model extends CI_model
{
    public function getTanggal()
    {
        $jumHari = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
        echo '<tr><th rowspan="2" style="vertical-align : middle;text-align:center;">Nama Kegiatan</th>';
            echo '<th colspan="'.$jumHari.'" class="text-center">'. date('F').'</th>';
        echo '</tr>';
        for ($i = 1; $i <= $jumHari; $i++) :
            if (strlen($i) == 1) {
                $i = '0' . $i;
            }
            $date = $i . '-' . date('m-Y');
            $hari = date('l', strtotime($date));
            if($hari == 'Sunday' || $hari == 'Saturday'){
                $btn = 'danger';
            }else{
                $btn = 'primary';
            }
            
            echo '<th scope="col"><a href="' . base_url('murid/isi_kegiatan/' . $date) . '"><b>' . $i . '</b></a></th>';
        endfor;
    }

    public function getData($kegiatan,$identitas)
    {
        $i = 1;
        $jumHari = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
        echo '<tbody>';
        foreach ($kegiatan as $row) :
            echo '<tr>
                    <td scope="row"><pre>' . $row['nama_kegiatan'] . '</pre></td>';
            for ($j = 1; $j <= $jumHari; $j++) :
                if (strlen($j) == 1) {
                    $j = '0' . $j;
                }
                echo '<td style="vertical-align : middle;text-align:center;">' . $this->IsiKegiatan_model->isi($row['id'], $identitas, $j . '-' . date('m-Y')) . '</td>';
            endfor;
            echo '</tr>';
        endforeach;
        echo '</tbody>';
    }
}
