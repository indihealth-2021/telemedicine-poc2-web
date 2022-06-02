<?php
function userName($uid)
{
   $ci=& get_instance();
    $ci->load->database();
    $ci->db->where('id', $uid);
    $get_data = $ci->db->get('master_user')->row();

    return $get_data->name;

}

function metodePembayaranName($id)
{
  switch ($id){
    case 1:
      $data = "Virtual Account";
    break;
    case 2:
      $data = "Transfer Bank (Cek Manual)";
    break;
    case 3:
      $data = "Dompet Digital";
    break;
    case 4:
      $data = "Owlexa";
    break;
    default:
      $data = "-";
    break;
   }

   return $data;
}

function getTotalObat($id_jadwal_konsultasi)
{
   $ci=& get_instance();
   $ci->load->database();

   $ci->db->select_sum('harga');
   $ci->db->where('id_jadwal_konsultasi',$id_jadwal_konsultasi);
   $res = $ci->db->get('resep_dokter')->row();
  // echo  var_dump($res->harga);
  // exit();
   return $res->harga == null ? "-":"Rp".number_format($res->harga);
}
