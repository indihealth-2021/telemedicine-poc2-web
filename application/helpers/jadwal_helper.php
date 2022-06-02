<?php
function cekJadwal($id_dokter)
{
   $ci=& get_instance();
    $ci->load->database();

    $day_now = dayEngConverter(date('D'));
    // $ci->db->select('id_dokter', 'hari', 'tanggal', 'waktu');
    $ci->db->where('id_dokter', $id_dokter);
    $ci->db->where('hari', $day_now);
    $get_data = $ci->db->get('jadwal_dokter')->row();
    if(empty($get_data))
    {
      return false;
    }

    $day=explode(' - ',$get_data->waktu);
    $day_jadwal = $get_data->hari;

    $dokter_start = strtotime(date('Y-m-d')." ".$day[0]);
    $dokter_end = strtotime(date('Y-m-d')." ".$day[1]);

    if(time() >= $dokter_start AND time() <= $dokter_end)
    {
      return true;
    } else{
      return false;
    }
}

function dayEngConverter($str)
{
   $day = str_replace('\'','',$str);
   $search  = array('Mon','Tue','Wed','Thu','Fri','Sat','Sun');
   $replace = array('Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at','Sabtu','Minggu');

   return str_replace($search, $replace, $day);
}
