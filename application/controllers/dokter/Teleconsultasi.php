<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Teleconsultasi extends CI_Controller
{
    var $menu = 2;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('all_model');
        $this->load->model('jadwal_telekonsultasi_model');

        $this->load->library(array('Key'));
        $this->load->library('session');
    }

    public function index()
    {
        if (!$this->session->userdata('is_login')) {
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        if ($valid->id_user_kategori != 2) {
            if ($valid->id_user_kategori == 0) {
                redirect(base_url('pasien/Pasien'));
            } else {
                redirect(base_url('admin/Admin'));
            }
        }
        $data['menu'] = $this->menu;
        $data['view'] = 'dokter/jadwal_konsultasi';
        $data['user'] = $this->all_model->select('master_user', 'row', 'id = ' . $this->session->userdata('id_user'));
        $data['title'] = 'Jadwal Telekonsultasi';
        $data['list_jadwal_konsultasi'] = $this->jadwal_telekonsultasi_model->get_all_by_id_dokter($this->session->userdata('id_user'));
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("' . $this->session->userdata('id_user') . '", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();


        $data['css_addons'] = '<link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">';
        $data['js_addons'] = '
                                <script src="' . base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js') . '"></script>
                                <script src="' . base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') . '"></script>
                                <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') . '"></script>
                                <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') . '"></script>
                                <script>
                                $(function () {
                                  var table_jadwal_telekonsultasi = $("#table_jadwal_telekonsultasi").DataTable({
                                    "paging": true,
                                    "lengthChange": false,
                                    "pageLength": 5,
                                    "searching": true,
                                    "ordering": true,
                                    "info": true,
                                    "autoWidth": true,
                                    "responsive": true,
                                  });
                                  $("#table_jadwal_telekonsultasi_filter").remove();
                                  $("#search").on("keyup", function(e){
                                    table_jadwal_telekonsultasi.search($(this).val()).draw();
                                  });
                                });
                              </script>';
        $this->load->view('template', $data);
    }

    private function _get_json_data($status = FALSE, $message = '', $data = NULL)
    {
        $result = new stdClass();

        $result->status = $status;
        $result->message = $message;
        $result->data = $data;

        return $result;
    }
    private function _get_user($username)
    {
        $where = array('username' => $username);

        return $this->all_model->select('master_user', 'row', $where);
    }
    public function teleconsultasi_pasien()
    {
        if (!$this->session->userdata('is_login')) {
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        if ($valid->id_user_kategori != 2) {
            if ($valid->id_user_kategori == 0) {
                redirect(base_url('pasien/Pasien'));
            } else {
                redirect(base_url('admin/Admin'));
            }
        }
        $data['menu'] = $this->menu;
        $data['view'] = 'dokter/teleconsultasi_pasien';
        $data['user'] = $this->all_model->select('master_user', 'row', 'id = ' . $this->session->userdata('id_user'));
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("' . $this->session->userdata('id_user') . '", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();

        $data['title'] = 'Telekonsultasi';
        $this->load->view('template', $data);
    }

    public function get_active_diagnoses()
    {
        $searchTerm = $this->input->get('searchTerm');

        $pglm = $this->input->get("page_limit");
        $page_lim = (empty($pglm) ? 10 : $pglm);
        $pg = $this->input->get("page");
        $page =  (empty($pg) ? 0 : $pg);
        $limit = $page * $page_lim;
        $cnt = $this->db->query("select id from master_diagnosa WHERE aktif = 1")->result();
        $filteredValues = $this->db->query("select id, nama as text FROM master_diagnosa WHERE aktif = 1 AND nama LIKE '%" . $searchTerm . "%' LIMIT $limit , $page_lim ;")->result_array();

        echo json_encode(array(
            'incomplete_results' => false,
            'items' => $filteredValues,
            'total' => count($cnt) // Total rows without LIMIT on SQL query
        ));
    }

    public function update_diagnose_pasien()
    {
        if (!$this->session->userdata('is_login')) {
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        if ($valid->id_user_kategori != 2) {
            if ($valid->id_user_kategori == 0) {
                redirect(base_url('pasien/Pasien'));
            } else {
                redirect(base_url('admin/Admin'));
            }
        }
        $data = $this->input->post();
        $data['id_dokter'] = $this->session->userdata('id_user');

        $diagnosis = $this->db->query('SELECT diagnosis FROM diagnosis_dokter WHERE id_jadwal_konsultasi = ' . $data['id_jadwal_konsultasi'] . ' AND id_pasien = ' . $data['id_pasien'])->row();
        if ($diagnosis) {
            $update = $this->all_model->update('diagnosis_dokter', $data, array('id_jadwal_konsultasi' => $data['id_jadwal_konsultasi']));
            if ($update != 0) {
                if ($update == -1) {
                    echo 'gagal';
                } else {
                    echo 'berhasil';
                }
            } else {
                echo 'tidak ada yang disimpan';
            }
        } else {
            $new_diagnosis = $this->db->insert('diagnosis_dokter', $data);
            echo 'berhasil';
        }

        $data_history = array("activity" => "Diagnosis", "id_user" => $this->session->userdata('id_user'), "target_id_user" => $data['id_pasien']);
        $this->db->insert('data_history_log_dokter', $data_history);
    }
    public function update_assesment_pasien()
    {
        if (!$this->session->userdata('is_login')) {
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        if ($valid->id_user_kategori != 2) {
            if ($valid->id_user_kategori == 0) {
                redirect(base_url('pasien/Pasien'));
            } else {
                redirect(base_url('admin/Admin'));
            }
        }
        $data = $this->input->post();
        $data['id_dokter'] = $this->session->userdata('id_user');
        $assesment = $this->db->query('SELECT * FROM assesment WHERE id_pasien = ' . $this->input->post('id_pasien') . ' AND id_jadwal_konsultasi = ' . $data['id_jadwal_konsultasi'])->row();
        if ($assesment) {
            $update = $this->all_model->update('assesment', $data, array('id_pasien' => $this->input->post('id_pasien'), 'id_jadwal_konsultasi' => $data['id_jadwal_konsultasi']));
            if ($update != 0) {
                if ($update == -1) {
                    echo 'gagal';
                } else {
                    echo 'berhasil';
                }
            } else {
                echo 'tidak ada yang disimpan';
            }
        } else {
            $data['id_pasien'] = $this->input->post('id_pasien');
            $new_assesment = $this->db->insert('assesment', $data);
            echo 'berhasil';
        }

        $data_history = array("activity" => "Assesment Pasien", "id_user" => $this->session->userdata('id_user'), "target_id_user" => $this->input->post('id_pasien'));
        $this->db->insert('data_history_log_dokter', $data_history);
    }
    public function update_resep_dokter_pasien()
    {
        if (!$this->session->userdata('is_login')) {
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        if ($valid->id_user_kategori != 2) {
            if ($valid->id_user_kategori == 0) {
                redirect(base_url('pasien/Pasien'));
            } else {
                redirect(base_url('admin/Admin'));
            }
        }
        $data = $this->input->post();
        $jml_data = count($data['keterangan']);
        for ($i = 0; $i < $jml_data; $i++) {
            $data_resep = array(
                "id_jadwal_konsultasi" => $data['id_jadwal_konsultasi'],
                "id_pasien" => $data['id_pasien'],
                "id_dokter" => $this->session->userdata('id_user'),
                "id_obat" => $data['id_obat'][$i],
                "jumlah_obat" => $data['jumlah_obat'][$i],
                "keterangan" => $data['keterangan'][$i]
            );
            $this->db->insert('resep_dokter', $data_resep);
        }
        $data_history = array("activity" => "Resep Dokter", "id_user" => $this->session->userdata('id_user'), "target_id_user" => $data['id_pasien']);
        $this->db->insert('data_history_log_dokter', $data_history);
    }

    public function data_pasien()
    {
        if (!$this->session->userdata('is_login')) {
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        if ($valid->id_user_kategori != 2) {
            if ($valid->id_user_kategori == 0) {
                redirect(base_url('pasien/Pasien'));
            } else {
                redirect(base_url('admin/Admin'));
            }
        }
        $data['menu'] = $this->menu;
        $data['view'] = 'dokter/data_pasien';
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("' . $this->session->userdata('id_user') . '", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();

        $this->load->view('template', $data);
    }

    public function send_data_konsultasi()
    {
        if (!$this->session->userdata('is_login')) {
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        if ($valid->id_user_kategori != 2) {
            if ($valid->id_user_kategori == 0) {
                redirect(base_url('pasien/Pasien'));
            } else {
                redirect(base_url('admin/Admin'));
            }
        }
        $id_dokter = $this->session->userdata('id_user');
        $data = $this->input->post();

        $data['tekanan_darah'] = isset($data['tekanan_darah']) ? $data['tekanan_darah'] : '-';
        $data['suhu'] = isset($data['suhu']) ? $data['suhu'] : '-';
        $data['merokok'] = isset($data['merokok']) ? $data['merokok'] : '0';
        $data['alkohol'] = isset($data['alkohol']) ? $data['alkohol'] : '0';
        $data['kecelakaan'] = isset($data['kecelakaan']) ? $data['kecelakaan'] : '0';
        $data['operasi'] = isset($data['operasi']) ? $data['operasi'] : '0';
        $data['dirawat'] = isset($data['dirawat']) ? $data['dirawat'] : '0';
        $data['keluhan'] = isset($data['keluhan']) ? $data['keluhan'] : '0';

        $data_assesment = array(
            "id_pasien" => $data['id_pasien'],
            "id_dokter" => $id_dokter,
            "id_jadwal_konsultasi" => $data['id_jadwal_konsultasi'],
            "berat_badan" => $data['berat_badan'],
            "tinggi_badan" => $data['tinggi_badan'],
            "tekanan_darah" => $data['tekanan_darah'],
            "suhu" => $data['suhu'],
            "merokok" => $data['merokok'],
            "alkohol" => $data['alkohol'],
            "kecelakaan" => $data['kecelakaan'],
            "operasi" => $data['operasi'],
            "dirawat" => $data['dirawat'],
            "keluhan" => $data['keluhan']
        );

        $assesment = $this->db->query('SELECT * FROM assesment WHERE id_pasien = ' . $data['id_pasien'] . ' AND id_jadwal_konsultasi = ' . $data['id_jadwal_konsultasi'])->row();
        if ($assesment) {
            $update = $this->all_model->update('assesment', $data_assesment, array('id_jadwal_konsultasi' => $data['id_jadwal_konsultasi'], 'id_pasien' => $data['id_pasien']));
            if ($update != 0) {
                if ($update == -1) {
                    echo 'gagal';
                } else {
                    echo 'berhasil';
                }
            } else {
                echo 'tidak ada yang disimpan';
            }
        } else {
            $new_assesment = $this->db->insert('assesment', $data_assesment);
            echo 'berhasil';
        }

        $data_history = array("activity" => "Assesment", "id_user" => $this->session->userdata('id_user'), "target_id_user" => $data['id_pasien']);
        $this->db->insert('data_history_log_dokter', $data_history);

        $data_diagnosis_dokter = array(
            "id_dokter" => $id_dokter,
            "id_pasien" => $data['id_pasien'],
            "id_jadwal_konsultasi" => $data['id_jadwal_konsultasi'],
            "id_registrasi" => $data['id_registrasi'],
            "diagnosis" => $data['diagnosis'],
        );
        $diagnosis = $this->db->query('SELECT diagnosis,id_registrasi FROM diagnosis_dokter WHERE id_jadwal_konsultasi = ' . $data['id_jadwal_konsultasi'] . ' AND id_pasien = ' . $data['id_pasien'])->row();
        if ($diagnosis) {
            $update = $this->all_model->update('diagnosis_dokter', $data_diagnosis_dokter, array('id_jadwal_konsultasi' => $data['id_jadwal_konsultasi'], 'id_pasien' => $data['id_pasien']));
            $id_registrasi = $diagnosis->id_registrasi;
            if ($update != 0) {
                if ($update == -1) {
                    echo 'gagal';
                } else {
                    echo 'berhasil';
                }
            } else {
                echo 'tidak ada yang disimpan';
            }
        } else {
            $new_diagnosis = $this->db->insert('diagnosis_dokter', $data_diagnosis_dokter);
            $new_diagnosis = $this->db->query('SELECT id_registrasi FROM diagnosis_dokter WHERE id = ' . $this->db->insert_id())->row();
            $id_registrasi = $new_diagnosis->id_registrasi;
            echo 'berhasil';
        }

        $planning = $data['planning'] != '' ? $data['planning']:null;
        $laboratorium = isset($data['laboratorium']) ? $data['laboratorium']:null;
        $radiologi = isset($data['radiologi']) ? $data['radiologi']:null;
        $pemeriksaan = $data['pemeriksaan'] != '' ? $data['pemeriksaan']:null;
        $kesimpulan = $data['kesimpulan'] != '' ? $data['kesimpulan']:null;
        $data_informasi_hasil_telekonsultasi = array(
            'id_jadwal_konsultasi' => $data['id_jadwal_konsultasi'],
            'laboratorium' => $laboratorium,
            'radiologi' => $radiologi,
            'pemeriksaan' => $pemeriksaan,
            'planning' => $planning
        );
        $this->db->insert('informasi_hasil_telekonsultasi', $data_informasi_hasil_telekonsultasi);

        $bukti_pembayaran = $this->db->query('SELECT id FROM bukti_pembayaran WHERE id_registrasi = "' . $id_registrasi . '"')->row();
        $this->all_model->update('bukti_pembayaran', array('selesai_konsultasi' => (new DateTime('now'))->format('Y/m/d H:i:s')), array('id' => $bukti_pembayaran->id));

        $data_history = array("activity" => "Diagnosis", "id_user" => $this->session->userdata('id_user'), "target_id_user" => $data['id_pasien']);
        $this->db->insert('data_history_log_dokter', $data_history);

        $jml_data_resep = count($data['keterangan']);
        for ($i = 0; $i < $jml_data_resep; $i++) {
            $obat = $this->db->query('SELECT harga_per_n_unit, harga FROM master_obat WHERE id = '.$data['id_obat'][$i])->row();
            $data_resep = array(
                "id_jadwal_konsultasi" => $data['id_jadwal_konsultasi'],
                "id_pasien" => $data['id_pasien'],
                "id_dokter" => $id_dokter,
                "id_obat" => $data['id_obat'][$i],
                "jumlah_obat" => $data['jumlah_obat'][$i],
                "harga_per_n_unit" => $obat->harga_per_n_unit,
                "harga" => $obat->harga,
                "keterangan" => $data['keterangan'][$i],
            );
            $this->db->insert('resep_dokter', $data_resep);
        }
        $data_history = array("activity" => "Resep Dokter", "id_user" => $this->session->userdata('id_user'), "target_id_user" => $data['id_pasien']);
        $this->db->insert('data_history_log_dokter', $data_history);

        echo "OK";
    }

    public function change_dokter()
    {
      $input_json = json_decode(file_get_contents('php://input'), true);
        $data = array(
          'id_dokter' => $input_json['id_dokter'],
        );

        $this->db->where('id', $input_json['id_konsultasi']);
        $this->db->where('id_dokter', $this->session->userdata('id_user'));
        $this->db->update('jadwal_konsultasi', $data);

        $konsul = $this->db->query('SELECT id_dokter,id_pasien,id_registrasi,tanggal,jam FROM jadwal_konsultasi WHERE id = ?',$input_json['id_konsultasi'])->row();
        $dokter = $this->db->query('SELECT id,name,reg_id FROM master_user WHERE id = ?',$input_json['id_dokter'])->row();
        $dokterself = $this->db->query('SELECT id,name,reg_id FROM master_user WHERE id = ?',$this->session->userdata('id_user'))->row();
        $pasien = $this->db->query('SELECT id,name,reg_id FROM master_user WHERE id = ?',$konsul->id_pasien)->row();
        $notifikasi = 'Jadwal Telekonsultasi dengan pasien '.$pasien->name.' pada ['.$konsul->tanggal.' '.$konsul->jam.'] dari '.$dokter->name.' telah dialihkan kepada anda.';
        $direct_link = base_url('dokter/Teleconsultasi');
        $now = (new DateTime('now'))->format('Y-m-d H:i:s');
        $data_notif = array("id_user"=>$dokter->id, "notifikasi"=>$notifikasi, "tanggal"=>$now, "direct_link"=>base_url('dokter/Teleconsultasi'));
        $this->db->insert('data_notifikasi', $data_notif);
        $id_notif = $this->db->insert_id();
        $msg_notif = array(
    			'name' => 'vp',
    			'id_notif' => $this->db->insert_id(),
    			'keterangan' => $notifikasi,
    			'tanggal' => $now,
          'id_user' => json_encode(array($dokter->id)),
    			'direct_link' => $direct_link,
    		);
        $msg_notif = json_encode($msg_notif);

        $this->key->_send_fcm($dokter->reg_id,$msg_notif);
        ///pasien fcm
        $notifikasi = 'Jadwal Telekonsultasi anda pada ['.$konsul->tanggal.' '.$konsul->jam.'] dengan '.$dokter->name.' telah dialihkan kepada '.$dokterself->name.'.';
        $direct_link = base_url('pasien/Teleconsultasi');
        $now = (new DateTime('now'))->format('Y-m-d H:i:s');
        $data_notif = array("id_user"=>$pasien->id, "notifikasi"=>$notifikasi, "tanggal"=>$now, "direct_link"=>base_url('pasien/Teleconsultasi'));
        $this->db->insert('data_notifikasi', $data_notif);
        $id_notif = $this->db->insert_id();
        $msg_notif = array(
          'name' => 'vp',
          'id_notif' => $this->db->insert_id(),
          'keterangan' => $notifikasi,
          'tanggal' => $now,
          'id_user' => json_encode(array($pasien->id)),
          'direct_link' => $direct_link,
        );
        $msg_notif = json_encode($msg_notif);

        $this->key->_send_fcm($pasien->reg_id,$msg_notif);
        return json_encode(['status' => 200, 'message' => 'Berhasil mengubah dokter']);
    }

    public function proses_teleconsultasi()
    {
        if (!$this->session->userdata('is_login')) {
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        if ($valid->id_user_kategori != 2) {
            if ($valid->id_user_kategori == 0) {
                redirect(base_url('pasien/Pasien'));
            } else {
                redirect(base_url('admin/Admin'));
            }
        }
        $id_pasien = $this->input->get('id_pasien');
        $id_jadwal_konsultasi = $this->input->get('id_jadwal_konsultasi');
        $data['id_jadwal_konsultasi'] = $id_jadwal_konsultasi;
        $jadwal_konsultasi = $this->db->query('SELECT id,id_registrasi FROM jadwal_konsultasi WHERE id = ' . $id_jadwal_konsultasi)->row();
        if(empty($jadwal_konsultasi))
        {
          redirect(base_url('dokter/Teleconsultasi'));
        }
        $data['id_registrasi'] = $jadwal_konsultasi->id_registrasi;
        if (!$jadwal_konsultasi) {
            show_404();
        }
        $data['menu'] = $this->menu;
        $data['view'] = 'dokter/proses_teleconsultasi';
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("' . $this->session->userdata('id_user') . '", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();

        $data['pasien'] = $this->db->query('SELECT * FROM master_user WHERE id = ' . $id_pasien)->row();
        $data['assesment'] = $this->db->query('SELECT a.id, a.berat_badan, a.tinggi_badan, a.tekanan_darah, a.suhu, a.merokok, a.alkohol, a.kecelakaan, a.operasi, a.dirawat, a.keluhan, a.riwayat_penyakit, a.riwayat_alergi FROM assesment a WHERE id_pasien = ' . $id_pasien . ' AND id_jadwal_konsultasi = ' . $id_jadwal_konsultasi)->row();
        if ($data['assesment']) {
            $data['assesment'] = $data['assesment'];
            $data['old_assesment'] = false;
        } else {
            $data['old_assesment'] = true;
            $data['assesment'] = $this->db->query('SELECT a.id, a.berat_badan, a.tinggi_badan, a.tekanan_darah, a.suhu, a.merokok, a.alkohol, a.kecelakaan, a.operasi, a.dirawat, a.keluhan, a.riwayat_penyakit, a.riwayat_alergi FROM assesment a WHERE id_pasien = ' . $id_pasien . " ORDER BY a.created_at DESC")->row();
        }
        $data['list_obat'] = $this->db->query('SELECT id, name, unit FROM master_obat WHERE active = 1 ORDER BY name')->result();
        $data['diagnosis'] = $this->db->query('SELECT master_diagnosa.id as id_diagnosa, master_diagnosa.nama as nama_diagnosa FROM diagnosis_dokter INNER JOIN master_diagnosa ON diagnosis_dokter.diagnosis = master_diagnosa.id WHERE id_jadwal_konsultasi = ' . $id_jadwal_konsultasi . ' AND id_pasien = ' . $id_pasien)->row();
        $data['file_pemeriksaan_luar'] = $this->db->query('SELECT * FROM file_pemeriksaan_luar WHERE id_jadwal_konsultasi = ?', $id_jadwal_konsultasi)->result();

        $birthDate = new DateTime($data['pasien']->lahir_tanggal);
        $now = new DateTime('today');
        $data['pasien']->age = $birthDate->diff($now)->y;
        $data['user'] = $this->all_model->select('master_user', 'row', 'id = ' . $this->session->userdata('id_user'));
        $data['detail_dokter'] = $this->db->query('SELECT n.use_diagnosa,n.durasi as durasi,id_poli  FROM detail_dokter dd INNER JOIN nominal n ON dd.id_poli = n.id WHERE dd.id_dokter = ?', $this->session->userdata('id_user'))->row();
        $data['dokter_pengganti'] = $this->db->query('SELECT u.name as name,id_dokter  from detail_dokter dd INNER JOIN  master_user u on dd.id_dokter  =  u.id where dd.id_poli = ? AND dd.id_dokter !=  ?' , [$data['detail_dokter']->id_poli,  $this->session->userdata('id_user')])->result();
        $data['title'] = 'Telekonsultasi';
        $data['css_addons'] = '
          <link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">
          <script src="https://meet.jit.si/external_api.js"></script>
          ';
        $data['js_addons'] = "
<script src='https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js'></script>
<script>

    <script src='" . base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js') . "'></script>
                                <script src='" . base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') . "'></script>
                                <script src='" . base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') . "'></script>
                                <script src='" . base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') . "'></script>
                                <script>
                                $(function () {
                                  $('#table_resep').DataTable({
                                    'paging': true,
                                    'lengthChange': true,
                                    'searching': true,
                                    'ordering': true,
                                    'info': false,
                                    'autoWidth': true,
                                    'responsive': true,
                                  });
                                });

function checkRemove() {
    if ($('div.resep-dokter').length == 1) {
        $('#remove').hide();
    } else {
        $('#remove').show();
    }
};
$(document).ready(function() {
    $('input[name=select_rp]').change(function(){
        riwayat_penyakit = $(this).val();
        if(riwayat_penyakit == 1){
            $('input[name=riwayat_penyakit]').val('');
            $('input[name=riwayat_penyakit]').prop('hidden', false);
            $('input[name=riwayat_penyakit]').prop('required', true);
        }else{
            $('input[name=riwayat_penyakit]').val('');
            $('input[name=riwayat_penyakit]').prop('hidden', true);
            $('input[name=riwayat_penyakit]').prop('required', false);
        }
    });

    $('input[name=select_ra]').change(function(){
        riwayat_alergi = $(this).val();
        if(riwayat_alergi == 1){
            $('input[name=riwayat_alergi]').val('');
            $('input[name=riwayat_alergi]').prop('hidden', false);
            $('input[name=riwayat_alergi]').prop('required', true);
        }else{
            $('input[name=riwayat_alergi]').val('');
            $('input[name=riwayat_alergi]').prop('hidden', true);
            $('input[name=riwayat_alergi]').prop('required', false);
        }
    });

    $('.chat-wrap-inner').scrollTop($('.chat-wrap-inner')[0].scrollHeight);
    checkRemove();
    $('#add').click(function() {
        $('div.resep-dokter:last').after($('div.resep-dokter:first').clone());
        $('div.resep-dokter:last').find('input').val('');
        checkRemove();

    });
    $('#remove').click(function() {
        $('div.resep-dokter:last').remove();
        checkRemove();
    });

    $('#formResepDokter').submit(function(e){
        var dataResep = $(this).serializeArray();
        var namaObat = $('select[name=id_obat] option:selected').text();
        var listResep = $('#listResep');
        var countTr = $('#listResep tr');
        countTr = countTr.length;
        if(countTr == null){
            countTr = 0;
        }
        countTr+=1;
        var templateListResep = '<tr><td>'+namaObat+'</td><td>'+dataResep[2].value+' '+dataResep[4].value+'</td><td>'+dataResep[3].value+'</td><td><button class=\'btn btn-secondary\' type=\'button\' onclick=\'return (this.parentNode).parentNode.remove();\' ><i class=\'fas fa-trash-alt\'></i></button></td><input type=\'hidden\' name=\''+dataResep[0].name+'[]\' value=\''+dataResep[0].value+'\'><input type=\'hidden\' name=\''+dataResep[1].name+'[]\' value=\''+dataResep[1].value+'\'><input type=\'hidden\' name=\''+dataResep[2].name+'[]\' value=\''+dataResep[2].value+'\'><input type=\'hidden\' name=\''+dataResep[3].name+'[]\' value=\''+dataResep[3].value+'\'></tr>';
        listResep.append(templateListResep);
        $(this)[0].reset();
        $('#ModalResep').modal('hide');
        alert('Resep telah ditambahkan!');
        e.preventDefault();
    });

    $('select[name=diagnosis]').select2({
          ajax: {
            url: '" . base_url('dokter/Teleconsultasi/get_active_diagnoses') . "',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    searchTerm: params.term, // search term
                    page_limit: 50,
                    page: params.page || 0
                };
            },
            processResults: function (data, params) {
                // console.log(params.page);
                // console.log(data.total);
                // console.log((params.page * 50) < data.total);
                params.page = params.page || 0;
                return {
                    results: data.items,
                    pagination: {
                        more: (params.page * 50) < data.total
                      }
                };
            },
            cache: true
        }
    });
});
</script>
<script>
firebase.auth().onAuthStateChanged(function(user) {
    if (user) {
        firebase.database()
        .ref('/chats/'+chat_id)
        .on('child_added', function(snapshot){
            console.log(snapshot.val());
            $('#messages').append(template_message(snapshot.val()));
            $('.chat-wrap-inner').scrollTop($('.chat-wrap-inner')[0].scrollHeight);
        });
    }
});
</script>
<script src='" . base_url('assets/js/message.js') . "'></script>
		";
        $data['teleconsul_admin_js'] = "
if(JSON.parse(JSON.parse(payload.data.body).id_user).includes(userid.toString())){
    if(JSON.parse(JSON.parse(payload.data.body).name == 'panggilan_konsultasi_berakhir_dokter')){
            console.log(JSON.parse(payload.data.body).chat_id);
            $.ajax({
                method : 'POST',
                url    : baseUrl+'dokter/Teleconsultasi/send_data_konsultasi',
                data   : JSON.parse(payload.data.body).data_konsultasi,
                success : function(data){
                    console.log('test');
                    console.log(data);
                    firebase.auth().signInAnonymously().catch(function(error) {
                    // Handle Errors here.
                        var errorCode = error.code;
                        var errorMessage = error.message;
                    // ...
                    });
                    firebase.auth().onAuthStateChanged(function(user) {
                        if (user) {
                                firebase.database()
                                .ref(JSON.parse(payload.data.body).chat_id)
                                .remove().then(function() {
										console.log('SUKSES Hapus Chat');
										location.href = '" . base_url('dokter/Teleconsultasi') . "';
										api.executeCommand('stopRecording', {
											mode: 'file' //recording mode to stop, `stream` or `file`
										});
									}).catch(function(error) {
										console.error('Error removing document: ', error);
								});
                        }
                    });
                },
                error : function(request, status, error){
                    console.log(request);
                    console.log(status);
                    console.log(error);
                }
            });
        }
    }
        ";
        $data['diagnoses'] = $this->db->query('SELECT * FROM master_diagnosa WHERE aktif = 1')->result();
        $this->load->view('template', $data);
    }
}
