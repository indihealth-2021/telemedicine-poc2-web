<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Telekonsultasi extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pengampu_model');
        $this->load->model('diampu_model');
        $this->load->model('pasien_model');
        $this->load->model('dokter_model');
        $this->load->model('RekamMedis_model');
        
        $this->load->library('all_controllers');
        $this->load->library('key');
    }

    public function konsultasi($id_diampu)
    {
        $this->all_controllers->check_user_pengampu();
        $data = $this->all_controllers->get_data_view(
            'Telekonsultasi',
            'pengampu/proses_telekonsultasi'
        );

        $diampu = $this->diampu_model->get($id_diampu);
        if (!$diampu) {
            redirect(base_url('pengampu/Pengampu'));
        }
        $data['diampu'] = $diampu;
        $id_pasien = $this->input->post('id_pasien');
        $pasien = $this->pasien_model->get_by_id($id_pasien);
        if($pasien){
            $data['nama_pasien'] = $pasien->name;
            $now = new DateTime('now');
            $tgl_lahir = new DateTime($pasien->lahir_tanggal);
            $diff = $now->diff($tgl_lahir);
            $data['usia_pasien'] = $diff->y;
            $data['list_rm'] = $this->RekamMedis_model->get_by_pasien($id_pasien);
        }else{
            $data['nama_pasien'] = '-';
            $data['usia_pasien'] = '-';
            $data['list_rm'] = [];
        }
        $data['id_diampu'] = $id_diampu;
        $data['room_name'] = $this->input->post('room_name');
        $data['dokter_diampu'] = $this->input->post('dokter_diampu');

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
                                $('#table_rekam_medis').DataTable({
                                  'paging': true,
                                  'lengthChange': true,
                                  'searching': true,
                                  'ordering': true,
                                  'info': true,
                                  'autoWidth': false,
                                  'responsive': true,
                                });
                              });

$(document).ready(function() {
  $('.chat-wrap-inner').scrollTop($('.chat-wrap-inner')[0].scrollHeight);
  $('#catatan_pengampu').keyup(function(e){
    $.ajax({
      method: 'POST',
      url: baseUrl+'pengampu/Telekonsultasi/pengampu_typing_cp',
      data: {id_diampu: id_dokter, catatan_pengampu: $(this).val()},
      success: function(data){
        console.log(data);
      },
      error: function(data){
        alert('Terjadi kesalahan sistem, silahkan hubungi administrator.');
      }
    });
  });

  $('#dokter_pengampu').keyup(function(e){
    $.ajax({
      method: 'POST',
      url: baseUrl+'pengampu/Telekonsultasi/pengampu_typing_dp',
      data: {id_diampu: id_dokter, dokter_pengampu: $(this).val()},
      success: function(data){
        console.log(data);
      },
      error: function(data){
        alert('Terjadi kesalahan sistem, silahkan hubungi administrator.');
      }
    });
  });
});
</script>
<script src='" . base_url('assets/js/message.js') . "'></script>
      ";
        $data['teleconsul_admin_js'] = "
        if (JSON.parse(JSON.parse(payload.data.body).id_user).includes(userid.toString())) {
          if (JSON.parse(JSON.parse(payload.data.body).name == 'unshow')) {
            if (JSON.parse(JSON.parse(payload.data.body).sub_name == 'diampu_choose_pasien')) {
              $.ajax({
                method: 'GET',
                url: baseUrl+'pengampu/Telekonsultasi/get_rekam_medis/'+JSON.parse(payload.data.body).id_pasien,
                success: function(data){
                  console.log(data);
                    if(data.status){
                      datatable = $('#table_rekam_medis').DataTable();
                      if(data.data.list_rm.length === 0){
                          datatable.clear().draw();
                          $('#usia').val(data.data.usia+' Tahun');
                          $('#pasien').val(data.data.nama_pasien);
                      }else{
                          $.each(data.data.list_rm, function(i, item){
                            data_table = [i+1, item.tanggal_konsultasi, item.poli, item.diagnosis, '<a target=\"_blank\" href=\"".base_url()."diampu/RekamMedis/detail/'+item.id_pasien+'/'+item.id_jadwal_konsultasi+'\" class=\"btn btn-primary btn-block\" type=\"button\">Detail</a>'];
                            datatable.clear().draw();
                            datatable.row.add(data_table);
                            datatable.columns.adjust().draw();
                          });
                          $('#usia').val(data.data.usia+' Tahun');
                          $('#pasien').val(data.data.nama_pasien);
                      }
                    }else{
                        datatable.clear().draw();
                        $('#usia').val('- Tahun');
                        $('#pasien').val('-');
                        console.log(data.message);
                    }
                },
                error: function(data){
                    console.log('ERROR: '+data);
                }
              });
            }
          }
        }
        ";

      $this->load->view('template', $data);
    }

    public function get_rekam_medis($id_pasien){
      $this->all_controllers->check_user_pengampu();
      
      $list_rm = $this->RekamMedis_model->get_by_pasien($id_pasien);
      $pasien = $this->pasien_model->get_by_id($id_pasien);
      if(!$pasien){
          $response['status'] = 0;
          $response['message'] = 'Pasien tidak ada!';
      }else{
          $now = new DateTime('now');
          $tgl_lahir = $pasien->lahir_tanggal;
          $tgl_lahir = new DateTime($tgl_lahir);
          $diff = $tgl_lahir->diff($now);
          $usia = $diff->y;

          $response['status'] = 1;
          $response['data']['list_rm'] = $list_rm;
          $response['data']['usia'] = $usia;
          $response['data']['nama_pasien'] = $pasien->name;
          $response['message'] = 'Pasien ditemukan!';
      }

      header('Content-Type: application/json');
      echo json_encode($response);
  }

  // cp = catatan pengampu
  public function pengampu_typing_cp(){
    $this->all_controllers->check_user_pengampu();

    $cp = $this->input->post('catatan_pengampu');
    $id_diampu = $this->input->post('id_diampu');
    $diampu = $this->diampu_model->get($id_diampu);

    $msg_notif = array(
      'name'=>'unshow',
      'sub_name'=>'pengampu_typing_cp',
      'id_user'=>json_encode(array($id_diampu)),
      'keterangan'=>'keterangan',
      'catatan_pengampu'=>$cp,
      'direct_link'=>'#'
    );
    $msg_notif = json_encode($msg_notif);
    $result = $this->key->_send_fcm($diampu->reg_id, $msg_notif);

    echo $result;
  }

    // dp = dokter pengampu
    public function pengampu_typing_dp(){
      $this->all_controllers->check_user_pengampu();
  
      $dp = $this->input->post('dokter_pengampu');
      $id_diampu = $this->input->post('id_diampu');
      $diampu = $this->diampu_model->get($id_diampu);
  
      $msg_notif = array(
        'name'=>'unshow',
        'sub_name'=>'pengampu_typing_dp',
        'id_user'=>json_encode(array($id_diampu)),
        'keterangan'=>'keterangan',
        'dokter_pengampu'=>$dp,
        'direct_link'=>'#'
      );
      $msg_notif = json_encode($msg_notif);
      $result = $this->key->_send_fcm($diampu->reg_id, $msg_notif);
  
      echo $result;
    }
}