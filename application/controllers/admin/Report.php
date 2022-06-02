<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{
    var $menu = 4;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('pdf');
        $this->load->library('all_controllers');
        $this->load->library('my_pagination');
    }

  public function telemedicine_income()
  {
    $poli = $this->input->get('poli');
    $dokter = $this->input->get('dokter');
    $cara_bayar = $this->input->get('cara_bayar');
    $from = $this->input->get('from');
    $to =$this->input->get('to');

    $data['list_poli'] = $this->db->query('SELECT DISTINCT
                                                nominal.poli, nominal.id
                                                FROM diagnosis_dokter
                                                    INNER JOIN detail_dokter ON detail_dokter.id_dokter = diagnosis_dokter.id_dokter
                                                    INNER JOIN nominal ON nominal.id = detail_dokter.id_poli')->result();

    $data['list_dokter'] = $this->db->query('SELECT DISTINCT
                                                diagnosis_dokter.id_dokter,
                                                dokter.name as nama_dokter
                                                FROM diagnosis_dokter
                                                    INNER JOIN master_user dokter ON dokter.id = diagnosis_dokter.id_dokter')->result();


    $this->db->select('
                       jk.id_registrasi,
                       jk.tanggal,
                       jk.jam,
                       jk.id_pasien,
                       jk.id_dokter,
                       bp.biaya_adm,
                       bp.biaya_konsultasi,
                       bp.status as status_pembayaran_konsultasi,
                       bp.metode_pembayaran as metode_pembayaran_konsultasi,
                       bpo.id_jadwal_konsultasi,
                       bpo.metode_pembayaran as metode_pembayaran_obat,
                       bpo.status status_pembayaran_obat,
                       dp.no_medrec,
                       dd.id_poli,
                       n.poli,
                       ');
    $this->db->from('jadwal_konsultasi jk');
    $this->db->join('bukti_pembayaran bp','bp.id_registrasi = jk.id_registrasi');
    $this->db->join('bukti_pembayaran_obat bpo','bpo.id_jadwal_konsultasi = jk.id','left');
    $this->db->join('detail_pasien dp','dp.id_pasien = jk.id_pasien');
    $this->db->join('detail_dokter dd','dd.id_dokter = jk.id_dokter');
    $this->db->join('nominal n','n.id = dd.id_poli');
    $this->db->where('bp.status',true);
    //Filter
    if(!empty($poli))
    {
      $this->db->where('dd.id_poli', $poli);
    }
    if(!empty($dokter))
    {
      $this->db->where('jk.id_dokter', $dokter);
    }
    if(!empty($cara_bayar))
    {
      $this->db->where('bp.metode_pembayaran', $cara_bayar);
    }
    if(!empty($from) && !empty($to))
    {
      $from = explode("/", $from);
      $from = implode("-", $from);
      $from = new DateTime($from);
      $fromIndo = $from->format('d/m/Y');
      $from = $from->format("Y-m-d");
      $to = explode("/", $to);
      $to = implode("-", $to);
      $to = new DateTime($to);
      $toIndo = $to->format('d/m/Y');
      $to = $to->format('Y-m-d');
      $this->db->where("bp.created_at BETWEEN  ".$this->db->escape($from)." AND ".$this->db->escape($to)."");
    }

    ///
    $data['user'] = $this->db->query('SELECT id, name,id_user_level, foto, id_user_kategori FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
    $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();
    //Declare Variable
    $data['laporan'] = $this->db->get()->result();
    $data['view'] = 'admin/report_pemasukan';
    $data['title'] = 'Pemasukan Telemedicine';


    $this->load->view('template', $data);
  }
}
