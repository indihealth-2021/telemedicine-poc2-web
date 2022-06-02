<?php
function getComponent($code)
{
   $ci=& get_instance();
    $ci->load->database();
    $data = $ci->db->where('code',$code)->get("master_web_component")->row()->content;
    return empty($data) ? null:$data;

}
function getResep($id_jadwal_konsultasi,$id_pasien)
{
   $ci=& get_instance();
    $ci->load->database();
      $ci->db->select('rd.id_jadwal_konsultasi,rd.id_pasien,rd.id_dokter,rd.jumlah_obat,mo.name,mo.unit,rd.keterangan');
      $ci->db->from('resep_dokter as rd');
      $ci->db->join('master_obat as mo', ' rd.id_obat = mo.id');
      $ci->db->where('rd.id_jadwal_konsultasi', $id_jadwal_konsultasi);
      $ci->db->where('rd.id_pasien', $id_pasien);
      return  $ci->db->get()->result();
}