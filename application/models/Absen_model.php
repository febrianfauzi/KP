<?php

class Absen_model extends CI_model
{
    public function getTanggal()
    {
        $bln = date('m');
        switch ($bln) {
            case 1:
                $bulan = 'Januari';
                break;
            case 2:
                $bulan = 'Februari';
                break;
            case 3:
                $bulan = 'Maret';
                break;
            case 4:
                $bulan = 'April';
                break;
            case 5:
                $bulan = 'Mei';
                break;
            case 6:
                $bulan = 'Juni';
                break;
            case 7:
                $bulan = 'Juli';
                break;
            case 8:
                $bulan = 'Agustus';
                break;
            case 9:
                $bulan = 'September';
                break;
            case 10:
                $bulan = 'Oktober';
                break;
            case 11:
                $bulan = 'November';
                break;
            case 12:
                $bulan = 'Desember';
                break;
            default:
                break;
        }
        if ($this->session->bulan && $this->session->tahun) {
            $b = $this->session->bulan;
            $t = $this->session->tahun;
            

            $jumHari = cal_days_in_month(CAL_GREGORIAN, $b, $t);
        } else {
            $jumHari = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
        }
        echo '<tr><th rowspan="2" style="vertical-align : middle;text-align:center; width:2%;">Nama Kegiatan</th>';
        echo '<th colspan="' . $jumHari . '" class="text-center">';
        if ($this->session->bulan && $this->session->tahun) {
            $this->Absen_model->getBulan($b);
        } else {
            echo $bulan;
        }
        echo '</th>';

        echo '</tr>';
        for ($i = 1; $i <= $jumHari; $i++) :
            if (strlen($i) == 1) {
                $i = '0' . $i;
            }
            if ($this->session->bulan && $this->session->tahun) {
                $date = $i . '-' . $this->session->bulan . '-' . $this->session->tahun;
            } else {
                $date = $i . '-' . date('m-Y');
            }

            $role = $this->session->role;
            echo '<th scope="col" class="text-center"><a href="' . base_url($role . '/isi_kegiatan/' . $date) . '"><b>' . $i . '</b></a></th>';
        endfor;
    }

    public function getData($kegiatan, $identitas)
    {
        $i = 1;
        $jumHari = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
        echo '<tbody>';
        foreach ($kegiatan as $row) :
            echo '<tr>
                    <td class="tx"  scope="row" style="width:25%;">' . $row['nama_kegiatan'] . '</td>';
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

    public function getDataDetail($kegiatan, $identitas, $bln, $thn)
    {
        $i = 1;
        if ($this->session->bulan && $this->session->tahun) {
            $jumHari = cal_days_in_month(CAL_GREGORIAN, $bln, $thn);
        } else {
            $jumHari = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
        }
        echo '<tbody>';
        foreach ($kegiatan as $row) :
            echo '<tr>
                    <td class="tx" scope="row" style="width:25%;">' . $row['nama_kegiatan'] . '</td>';
            for ($j = 1; $j <= $jumHari; $j++) :
                if (strlen($j) == 1) {
                    $j = '0' . $j;
                }
                echo '<td style="vertical-align : middle;text-align:center;">' . $this->IsiKegiatan_model->isi($row['id'], $identitas, $j . '-' . $bln . '-' . $thn) . '</td>';
            endfor;
            echo '</tr>';
        endforeach;
        echo '</tbody>';
    }

    public function getTahun($identitas)
    {
        $this->db->select('DISTINCT substring(tgl,-4) as tahun');
        $this->db->from('isi_kegiatan');
        $this->db->where('nis', $identitas);
        $this->db->order_by('tahun', 'DESC');
        $query = $this->db->get()->result();
        foreach ($query as $q) {
            echo '<option value="' . $q->tahun . '">' . $q->tahun . '</option>';
        }
    }

    public function getBulan($bln)
    {
        switch ($bln) {
            case 1:
                echo 'Januari';
                break;
            case 2:
                echo 'Februari';
                break;
            case 3:
                echo 'Maret';
                break;
            case 4:
                echo 'April';
                break;
            case 5:
                echo 'Mei';
                break;
            case 6:
                echo 'Juni';
                break;
            case 7:
                echo 'Juli';
                break;
            case 8:
                echo 'Agustus';
                break;
            case 9:
                echo 'September';
                break;
            case 10:
                echo 'Oktober';
                break;
            case 11:
                echo 'November';
                break;
            case 12:
                echo 'Desember';
                break;
            default:
                break;
        }
    }
}
