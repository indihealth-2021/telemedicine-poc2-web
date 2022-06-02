<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PengaturanWeb extends CI_Controller {
    var $menu = 9;

    public function __construct() {
        parent::__construct();
        $this->load->model('all_model');
        $this->load->library('all_controllers');
    }
    public function umum()
    {
      $settings['nama_faskes'] = $this->db->where('code','APP.NMFASKES')->get("master_web_component")->row()->content;
      $settings['address'] = $this->db->where('code','APP.ADDR')->get("master_web_component")->row()->content;
      $settings['phone'] = $this->db->where('code','APP.PHONE')->get("master_web_component")->row()->content;
      $settings['faks'] = $this->db->where('code','APP.FAKS')->get("master_web_component")->row()->content;
      $settings['email'] = $this->db->where('code','APP.EMAIL')->get("master_web_component")->row()->content;
      $settings['logo'] = $this->db->where('code','APP.LOGO')->get("master_web_component")->row()->content;
      $data = $this->all_controllers->get_data_view(
  			$title = "Pengaturan Web",
  			$view = "admin/pengaturan_web_umum"
          );
        $data['pengaturan'] = (object)$settings;

      $this->load->view('template', $data);
    }

    public function update()
    {
      $nama_faskes = $this->input->post('nama_faskes');
      $address =$this->input->post('alamat');
      $telp = $this->input->post('telp');
      $faks = $this->input->post('faks');
      $email = $this->input->post('email');
      $logo = $_FILES['img_logo']['name'];
      $fname = 'logo-'.date('Ymd').'-'.sha1($_SERVER['SERVER_NAME'].time());


      if(!empty($logo))
      {
        $config['upload_path']          = './assets/logo';
        $config['allowed_types']        = 'gif|jpg|png|jpeg|jfif';
        $config['max_size']             = 1024;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        $config['file_name']            = $fname;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

                	if (!$this->upload->do_upload('img_logo')) {

                      $this->session->set_flashdata('msg', $this->upload->display_errors());

               }
               else
               {
                 $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
                 $file_name = $upload_data['file_name'];
                 $this->db->where('code','APP.LOGO')->update('master_web_component', ['content' => $file_name]);


               }

      }


      $this->db->trans_start();

      $this->db->where('code','APP.NMFASKES')->update('master_web_component', ['content' => $nama_faskes]);
      $this->db->where('code','APP.ADDR')->update('master_web_component', ['content' => $address]);
      $this->db->where('code','APP.PHONE')->update('master_web_component', ['content' => $telp]);
      $this->db->where('code','APP.FAKS')->update('master_web_component', ['content' => $faks]);
      $this->db->where('code','APP.EMAIL')->update('master_web_component', ['content' => $email]);

      $this->db->trans_complete();
      $this->session->set_flashdata('msg', "Berhasil mengubah pengaturan.");
      redirect(base_url('admin/PengaturanWeb/umum'));
    }
    public function index(){
		$this->all_controllers->check_user_admin();
		$data = $this->all_controllers->get_data_view(
			$title = "Pengaturan Web",
			$view = "admin/pengaturan_web"
        );

        $data['css_addons'] = '<link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css').'"><link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css').'">';
        $data['js_addons'] = '
                                <script src="'.base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js').'"></script>
                                <script>
                                $(document).ready(function () {
                                    $("#hargaAdmInput").hide();
                                    $("#remindAtInput").hide();
                                    $("#remindEveryInput").hide();
                                    $("#table_pengaturan").DataTable({
                                    "responsive": true,
                                    "order": false,
                                    "autoWidth": false,
                                    "lengthChange": false,
                                    "searching": false,
                                    "pageLength": 5,
                                    "info": false,
                                    "paging": false
                                    });

                                    $("#table_pengingat").DataTable({
                                        "responsive": true,
                                        "order": false,
                                        "autoWidth": false,
                                        "lengthChange": false,
                                        "searching": false,
                                        "pageLength": 5,
                                        "info": false,
                                        "paging": false
                                        });

                                    $("#btnEditHargaAdm").click(function(e){
                                        $("#hargaAdmInput").show();
                                        $("#hargaAdmInput").find("input").val(hargaAdm);
                                        $("#helpTextHargaAdm").html(formatRupiah(hargaAdm.toString(), "Rp. ")+",00");
                                        $("#hargaAdmText").hide();
                                    });
                                    $("#btnEditRemindAt").click(function(e){
                                        $("#remindAtInput").show();
                                        $("#remindAtInput").find("input").val(remindAt);
                                        $("#remindAtText").hide();
                                    });
                                    $("#btnEditRemindEvery").click(function(e){
                                        $("#remindEveryInput").show();
                                        $("#remindEveryInput").find("input").val(remindEvery);
                                        $("#remindEveryText").hide();
                                    });

                                    $("#hargaAdmInputText").keyup(function(){
                                        $("#helpTextHargaAdm").html(formatRupiah(this.value, "Rp. ")+",00");
                                    });
                                    $("#hargaAdmInputText").change(function(){
                                        $("#helpTextHargaAdm").html(formatRupiah(this.value, "Rp. ")+",00");
                                    });

                                    $("#btnCloseHargaAdm").click(function(e){
                                        $("#hargaAdmInput").hide();
                                        $("#hargaAdmText").show();
                                    });
                                    $("#btnCloseRemindAt").click(function(e){
                                        $("#remindAtInput").hide();
                                        $("#remindAtText").show();
                                    });
                                    $("#btnCloseRemindEvery").click(function(e){
                                        $("#remindEveryInput").hide();
                                        $("#remindEveryText").show();
                                    });

                                    $("#btnOkHargaAdm").click(function(){
                                        if($("#hargaAdmInputText").val()){
                                            var valHargaAdmInputText = $("#hargaAdmInputText").val();
                                            $.ajax({
                                                method : "GET",
                                                url    : baseUrl+"admin/PengaturanWeb/update_harga_adm/"+valHargaAdmInputText,
                                                success : function(data){
                                                    hargaAdm = valHargaAdmInputText;
                                                    $("#hargaAdmText").html(formatRupiah(valHargaAdmInputText, "Rp. ")+",00");
                                                    $("#hargaAdmText").show();
                                                    $("#hargaAdmInput").hide();
                                                },
                                                error : function(data){
                                                        alert(data);
                                                }


                                            });
                                        }
                                    });
                                    $("#btnOkRemindAt").click(function(){
                                        if($("#remindAtInputText").val()){
                                            var valRemindAtInputText = $("#remindAtInputText").val();
                                            $.ajax({
                                                method : "GET",
                                                url    : baseUrl+"admin/PengaturanWeb/update_ingatkan_pada/"+valRemindAtInputText,
                                                success : function(data){
                                                    remindAt = valRemindAtInputText;
                                                    $("#remindAtText").html(valRemindAtInputText+" Menit");
                                                    $("#remindAtText").show();
                                                    $("#remindAtInput").hide();
                                                },
                                                error : function(data){
                                                        console.log(data);
                                                }


                                            });
                                        }
                                    });
                                    $("#btnOkRemindEvery").click(function(){
                                        if($("#remindEveryInputText").val()){
                                            var valRemindEveryInputText = $("#remindEveryInputText").val();
                                            $.ajax({
                                                method : "GET",
                                                url    : baseUrl+"admin/PengaturanWeb/update_ingatkan_setiap/"+valRemindEveryInputText,
                                                success : function(data){
                                                    remindEvery = valRemindEveryInputText;
                                                    $("#remindEveryText").html(valRemindEveryInputText+" Menit");
                                                    $("#remindEveryText").show();
                                                    $("#remindEveryInput").hide();
                                                },
                                                error : function(data){
                                                        console.log(data);
                                                }


                                            });
                                        }
                                    });

                                    function formatRupiah(angka, prefix){
                                        var number_string = angka.replace(/[^,\d]/g, "").toString(),
                                        split   		= number_string.split(","),
                                        sisa     		= split[0].length % 3,
                                        rupiah     		= split[0].substr(0, sisa),
                                        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

                                        // tambahkan titik jika yang di input sudah menjadi angka ribuan
                                        if(ribuan){
                                            separator = sisa ? "." : "";
                                            rupiah += separator + ribuan.join(".");
                                        }

                                        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
                                        return prefix == undefined ? rupiah : (rupiah ? "Rp. " + rupiah : "");
                                    }
                                });
                                </script>';
        $data['web'] = $this->db->query('SELECT * FROM master_web')->row();
        $this->load->view('template', $data);
    }

    public function update_harga_adm($hargaAdm){
		$this->all_controllers->check_user_admin();

        $master_web = $this->db->query('SELECT id FROM master_web')->row();
        $hargaAdm = array("harga_adm"=>$hargaAdm);
        $this->all_model->update('master_web', $hargaAdm, array('id'=>$master_web->id));

        echo $hargaAdm;
    }

    public function update_ingatkan_pada($ingatkan_pada){
        $this->all_controllers->check_user_admin();

        $master_web = $this->db->query('SELECT id FROM master_web')->row();
        $data = array("ingatkan_pada"=>$ingatkan_pada);
        $this->all_model->update('master_web', $data, array('id'=>$master_web->id));

        echo $ingatkan_pada;
    }

    public function update_ingatkan_setiap($ingatkan_setiap){
        $this->all_controllers->check_user_admin();

        $master_web = $this->db->query('SELECT id FROM master_web')->row();
        $data = array("ingatkan_setiap"=>$ingatkan_setiap);
        $this->all_model->update('master_web', $data, array('id'=>$master_web->id));

        echo $ingatkan_setiap;
    }
}
