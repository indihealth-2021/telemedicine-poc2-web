<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Telekonsultasi extends CI_Controller
{
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

    public function proses_telekonsultasi($id_pengampu)
    {
        $this->all_controllers->check_user_diampu();
        $data = $this->all_controllers->get_data_view(
            'Telekonsultasi',
            'diampu/proses_telekonsultasi'
        );

        $pengampu = $this->pengampu_model->get($id_pengampu);
        if (!$pengampu) {
            redirect(base_url('diampu/Diampu/list_pengampu'));
        }
        $data['pengampu'] = $pengampu;
        $data['list_dokter'] = $this->dokter_model->get_all(1);
        $data['list_pasien'] = $this->pasien_model->get_all(1);

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
  $('#pasien').change(function(e){
      $.ajax({
          method: 'GET',
          url: baseUrl+'diampu/Telekonsultasi/get_rekam_medis/'+$(this).val(),
          success: function(data){
              if(data.status){
                datatable = $('#table_rekam_medis').DataTable();
                if(data.data.list_rm.length === 0){
                    datatable.clear().draw();
                    $('#usia').val(data.data.usia+' Tahun');
                    $('#panggil_pengampu').attr('data-id-pasien', $('#pasien').val());
                }else{
                    $.each(data.data.list_rm, function(i, item){
                      data_table = [i+1, item.tanggal_konsultasi, item.poli, item.diagnosis, '<a target=\"_blank\" href=\"".base_url()."diampu/RekamMedis/detail/'+item.id_pasien+'/'+item.id_jadwal_konsultasi+'\" class=\"btn btn-primary btn-block\" type=\"button\">Detail</a>'];
                      datatable.clear().draw();
                      datatable.row.add(data_table);
                      datatable.columns.adjust().draw();
                    });
                    $('#usia').val(data.data.usia+' Tahun');
                    $('#panggil_pengampu').attr('data-id-pasien', $('#pasien').val());
                }
              }else{
                  datatable.clear().draw();
                  $('#usia').val('- Tahun');
                  console.log(data.message);
              }
          },
          error: function(data){
              console.log('ERROR: '+data);
          }
      });
      $.ajax({
          method: 'POST',
          url: baseUrl+'diampu/Telekonsultasi/choose_pasien',
          data: {id_pengampu: id_pasien, id_pasien: $(this).val()},
          success: function(data){
              console.log(data);
          },
          error: function(data){
              console.log('ERROR: '+data);
          }
      })
  });
  $('#catatan_diampu').keyup(function(e){
    $.ajax({
      method: 'POST',
      url: baseUrl+'diampu/Telekonsultasi/diampu_typing_cd',
      data: {id_pengampu: id_pasien, catatan_diampu: $(this).val()},
      success: function(data){
        console.log(data);
      },
      error: function(data){
        alert('Terjadi kesalahan sistem, silahkan hubungi administrator.');
      }
    });
  });

  $('#dokter_diampu').keyup(function(e){
    $.ajax({
      method: 'POST',
      url: baseUrl+'diampu/Telekonsultasi/diampu_typing_dd',
      data: {id_pengampu: id_pasien, dokter_diampu: $(this).val()},
      success: function(data){
        console.log(data);
        $('#panggil_pengampu').attr('data-dokter-diampu', $('#dokter_diampu').val());
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
        $data['teleconsul_admin_js'] = "";

      $this->load->view('template', $data);
    }

    public function get_rekam_medis($id_pasien){
        $this->all_controllers->check_user_diampu();
        
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
            $response['message'] = 'Pasien ditemukan!';
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function choose_pasien(){
        $this->all_controllers->check_user_diampu();

        $id_pasien = $this->input->post('id_pasien');
        $id_pengampu = $this->input->post('id_pengampu');
        $pengampu = $this->pengampu_model->get($id_pengampu);

        $msg_notif = array(
            'name'=>'unshow',
            'sub_name'=>'diampu_choose_pasien',
            'id_user'=>json_encode(array($id_pengampu)),
            'keterangan'=>'keterangan',
            'id_pasien'=>$id_pasien,
            'direct_link'=>'#'
          );
        $msg_notif = json_encode($msg_notif);
        
        $result = $this->key->_send_fcm($pengampu->reg_id, $msg_notif);
        
        echo $result;
    }

    //cd = catatan diampu
    public function diampu_typing_cd(){
        $this->all_controllers->check_user_diampu();
    
        $cd = $this->input->post('catatan_diampu');
        $id_pengampu = $this->input->post('id_pengampu');
        $pengampu = $this->pengampu_model->get($id_pengampu);
    
        $msg_notif = array(
          'name'=>'unshow',
          'sub_name'=>'diampu_typing_cd',
          'id_user'=>json_encode(array($id_pengampu)),
          'keterangan'=>'keterangan',
          'catatan_diampu'=>$cd,
          'direct_link'=>'#'
        );
        $msg_notif = json_encode($msg_notif);
        $result = $this->key->_send_fcm($pengampu->reg_id, $msg_notif);
    
        echo $result;
    }

        //dd = dokter diampu
        public function diampu_typing_dd(){
          $this->all_controllers->check_user_diampu();
      
          $dd = $this->input->post('dokter_diampu');
          $id_pengampu = $this->input->post('id_pengampu');
          $pengampu = $this->pengampu_model->get($id_pengampu);
      
          $msg_notif = array(
            'name'=>'unshow',
            'sub_name'=>'diampu_typing_dd',
            'id_user'=>json_encode(array($id_pengampu)),
            'keterangan'=>'keterangan',
            'dokter_diampu'=>$dd,
            'direct_link'=>'#'
          );
          $msg_notif = json_encode($msg_notif);
          $result = $this->key->_send_fcm($pengampu->reg_id, $msg_notif);
      
          echo $result;
      }
}
