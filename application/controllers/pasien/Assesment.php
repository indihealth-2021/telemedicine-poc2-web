<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assesment extends CI_Controller {
	public $data;

    public function __construct() {
        parent::__construct();       
	$this->load->library(array('Key')); 
    }

    public function index(){
        if(!$this->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        if($valid->id_user_kategori != 0){
            if($valid->id_user_kategori == 2){
                redirect(base_url('dokter/Dashboard'));
            }
            else{
                redirect(base_url('admin/Admin'));
            }
        }
        $id_jadwal_konsultasi = $this->input->get('id_jadwal_konsultasi');
        if($id_jadwal_konsultasi){
            $jk = $this->db->query('SELECT jadwal_konsultasi.*, d.name as nama_dokter, d.str as str_dokter, d.foto as foto_dokter, nominal.poli as poli_dokter FROM jadwal_konsultasi LEFT JOIN master_user d ON jadwal_konsultasi.id_dokter = d.id LEFT JOIN detail_dokter ON detail_dokter.id_dokter = d.id LEFT JOIN nominal ON detail_dokter.id_poli = nominal.id WHERE jadwal_konsultasi.id = '.$id_jadwal_konsultasi)->row();
            if(!$jk){
                redirect(base_url('pasien/Pasien'));
            }
	        $data['jadwal_konsultasi'] = $jk;
            $assesment = $this->db->query('SELECT assesment.*, d.name as nama_dokter, d.str as str_dokter, d.foto as foto_dokter, n.poli as poli_dokter FROM assesment LEFT JOIN master_user d ON assesment.id_dokter = d.id LEFT JOIN detail_dokter ddr ON ddr.id_dokter = d.id LEFT JOIN nominal n ON ddr.id_poli = n.id WHERE assesment.id_pasien = '.$this->session->userdata('id_user').' AND id_jadwal_konsultasi = '.$id_jadwal_konsultasi.' ORDER BY updated_at DESC, created_at DESC')->row();
            if(!$assesment){
                $assesment = $this->db->query('SELECT assesment.* FROM assesment WHERE assesment.id_pasien = '.$this->session->userdata('id_user').' ORDER BY updated_at DESC, created_at DESC')->row();  
                $data['assesment_old'] = 'ok';            
            }
            $data['id_jadwal_konsultasi'] = $id_jadwal_konsultasi;
        }
        else{
            // $assesment = $this->db->query('SELECT assesment.* FROM assesment WHERE assesment.id_pasien = '.$this->session->userdata('id_user').' ORDER BY updated_at DESC, created_at DESC')->row();
            // $data['assesment_old'] = 'ok';
            redirect(base_url('pasien/Pasien'));
        }
        $jadwal_konsultasi = $this->db->query('SELECT id FROM jadwal_konsultasi WHERE id_pasien = '.$this->session->userdata('id_user'))->row();
        $data['assesment'] = $assesment;
	    $data['user'] = $this->db->query('SELECT id, name, foto FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        $data['view'] = 'pasien/form_assesment';
        $data['title'] = 'Assesment';
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();
        $data['id_jadwal_konsultasi'] = $id_jadwal_konsultasi;
        $data['file_pemeriksaan_luar'] = $this->db->query('SELECT fpl.id, fpl.file FROM file_pemeriksaan_luar fpl WHERE fpl.id_jadwal_konsultasi = ?', $id_jadwal_konsultasi)->result();
        $data['js_addons'] = '
            <script>
                $(document).ready(function(){
                    $("input[name=select_rp]").change(function(){
                        riwayat_penyakit = $(this).val();
                        if(riwayat_penyakit == 1){
                            $("input[name=riwayat_penyakit]").val("");
                            $("input[name=riwayat_penyakit]").prop("hidden", false);
                            $("input[name=riwayat_penyakit]").prop("required", true);
                        }else{
                            $("input[name=riwayat_penyakit]").val("");
                            $("input[name=riwayat_penyakit]").prop("hidden", true);
                            $("input[name=riwayat_penyakit]").prop("required", false);
                        }
                    });
        
                    $("input[name=select_ra]").change(function(){
                        riwayat_alergi = $(this).val();
                        if(riwayat_alergi == 1){
                            $("input[name=riwayat_alergi]").val("");
                            $("input[name=riwayat_alergi]").prop("hidden", false);
                            $("input[name=riwayat_alergi]").prop("required", true);
                        }else{
                            $("input[name=riwayat_alergi]").val("");
                            $("input[name=riwayat_alergi]").prop("hidden", true);
                            $("input[name=riwayat_alergi]").prop("required", false);
                        }
                    });

                    $("#fpl-modal").on("shown.bs.modal", function(e){
                        console.log(e.currentTarget);
                        $("#msg-fpl").hide();
                    });

                    $("#fpl-upload").change(function() {
                        var file = $("#fpl-upload")[0].files[0].name;
                        var file_substr = file.length > 40 ? file.substr(0, 39)+"...":file;
                        $("#filename").html("<span title=\'" + file + "\'>" + file_substr + "</span>");
                    });   

                    $("#form-fpl").submit(function(e){
                        e.preventDefault();

                        let formData = new FormData();
                        const id_jadwal_konsultasi = $("input[name=id_jadwal_konsultasi]").val();
                        formData.append("file_pemeriksaan_luar", $(this).find("input[name=file_pemeriksaan_luar]")[0].files[0]);
                        console.log(baseUrl+"pasien/Assesment/upload_attachment/"+id_jadwal_konsultasi);
                        $.ajax({
                            url: baseUrl+"pasien/Assesment/upload_attachment/"+id_jadwal_konsultasi,
                            method: "POST",
                            data: formData,
                            contentType: false,
                            processData: false,
                            beforeSend: function(data){
                                $("#loading-fpl").prop("hidden", false);
                            },
                            success: function(data){
                                $("#loading-fpl").prop("hidden", true);
                                data = JSON.parse(data);
                                console.log(data);

                                $("#filename").html("Pilih file...");
                                $("#fpl-upload").val("");

                                if(!data.success){
                                    $("#msg-fpl").attr("class", "col-12 alert bg-danger text-dark");
                                    $("#msg-fpl").html(data.message);
                                    $("#msg-fpl").show().fadeOut(5000);
                                }else{
                                    $("#msg-fpl").attr("class", "col-12 alert bg-success text-dark");
                                    $("#msg-fpl").html(data.message);
                                    $("#msg-fpl").show().fadeOut(5000);

                                    const data_file = JSON.parse(data.data);
                                    const tbody_fpl = $("#tbody-fpl");
                                    const template_fpl = `
                                        <tr>
                                            <td><a href=\''.base_url('assets/files/file_pemeriksaan_luar/').'${data_file.file_name}\' target=\'_blank\' class=\'text-dark font-16\'><i class=\'fa fa-paperclip\'></i> ${data_file.file_name}</a></td>
                                            <td width=\'5%\'><button type=\'button\' class=\'btn btn-block btn-danger\' onclick=\'return delete_fpl(this)\' data-id-fpl=\'${data_file.file_id}\'><i class=\'fa fa-trash\'></i></button></td>
                                        </tr>
                                    `;
                                    tbody_fpl.append(template_fpl);
                                }
                            },
                            error: function(err){
                                console.log("Laporkan ke admin!");
                            }
                        });
                    });
                });

                function delete_fpl(e){
                    const id_fpl = $(e).data("id-fpl");
                    $.ajax({
                        url: baseUrl+"pasien/Assesment/delete_attachment/"+id_fpl,
                        method: "GET",
                        success: function(data){
                            data = JSON.parse(data);
                            console.log(data);
                            
                            if(data.success){
                                $("#msg-fpl").attr("class", "col-12 alert bg-success text-dark");
                                $("#msg-fpl").html(data.message);
                                $("#msg-fpl").show().fadeOut(5000);

                                e.parentNode.parentNode.remove();
                            }else{
                                $("#msg-fpl").attr("class", "col-12 alert bg-danger text-dark");
                                $("#msg-fpl").html(data.message);
                                $("#msg-fpl").show().fadeOut(5000);
                            }
                        },
                        error: function(err){
                            $("#msg-fpl").attr("class", "col-12 alert bg-danger text-dark");
                            $("#msg-fpl").html("File tidak dapat dihapus!");
                            $("#msg-fpl").show().fadeOut(5000);
                        }
                    });
                }
            </script>
        ';

        if(!$jadwal_konsultasi){
            $data['view'] = 'pasien/assesment_error';
            $this->load->view('template', $data);
        }
        else{
            $this->load->view('template', $data);
        }
    }

    public function menu_assesment(){
        if(!$this->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        if($valid->id_user_kategori != 0){
            if($valid->id_user_kategori == 2){
                redirect(base_url('dokter/Dashboard'));
            }
            else{
                redirect(base_url('admin/Admin'));
            }
        }
        $data['user'] = $this->db->query('SELECT id, name, foto FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        $data['view'] = 'pasien/menu_assesment';
        $data['title'] = 'Menu Assesment';
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();
        $data['list_jadwal_konsultasi'] = $this->db->query('SELECT jadwal_konsultasi.id, jadwal_konsultasi.tanggal, jadwal_konsultasi.jam, d.name as nama_dokter, d.foto as foto_dokter, d.str as str_dokter, nominal.poli FROM jadwal_konsultasi INNER JOIN master_user d ON jadwal_konsultasi.id_dokter = d.id LEFT JOIN detail_dokter ON detail_dokter.id_dokter = d.id LEFT JOIN nominal ON detail_dokter.id_poli = nominal.id WHERE jadwal_konsultasi.id_pasien = '.$this->session->userdata('id_user'))->result();

        $this->load->view('template', $data);
    }

    public function update(){
        if(!$this->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        if($valid->id_user_kategori != 0){
            if($valid->id_user_kategori == 2){
                redirect(base_url('dokter/Dashboard'));
            }
            else{
                redirect(base_url('admin/Admin'));
            }
        }
        $data = $this->input->post();
        $jadwal_konsultasi = $this->db->query('SELECT id,id_dokter FROM jadwal_konsultasi WHERE id_pasien = '.$this->session->userdata('id_user'))->result();
        $assesments = $this->db->query('SELECT assesment.id_jadwal_konsultasi FROM assesment INNER JOIN jadwal_konsultasi ON assesment.id_jadwal_konsultasi = jadwal_konsultasi.id WHERE assesment.id_pasien = '.$this->session->userdata('id_user'))->result();


        if(!$jadwal_konsultasi){
            show_404();
        }
        else{
            $id_jadwal_konsultasi = $this->input->post('id_jadwal_konsultasi');
            if($id_jadwal_konsultasi){
                $jk = $this->db->query('SELECT id, id_dokter FROM jadwal_konsultasi WHERE id = '.$id_jadwal_konsultasi.' AND id_pasien = '.$this->session->userdata('id_user'))->row();
				$dokter = $this->db->query('SELECT reg_id FROM master_user WHERE id_user_kategori = 2 AND id = '.$jk->id_dokter)->row();
                if(!$jk || !$dokter){
                    show_404();
                }
				$data['name'] = 'unshow';
				$data['sub_name'] = 'submit_assesment_pasien';
				$data['id_user'] = json_encode(array($jk->id_dokter));
                $fpl = $this->db->query('SELECT fpl.id, fpl.file FROM file_pemeriksaan_luar fpl INNER JOIN jadwal_konsultasi jk ON jk.id = fpl.id_jadwal_konsultasi WHERE fpl.id_jadwal_konsultasi = ? AND jk.id_pasien = ?', array($id_jadwal_konsultasi, $this->session->userdata('id_user')))->result();
                $data['file_pemeriksaan_luar'] = json_encode($fpl);
				$msg_notif = json_encode($data);
				$this->key->_send_fcm($dokter->reg_id, $msg_notif);

				unset($data['name']);
				unset($data['sub_name']);
				unset($data['id_user']);
                unset($data['select_ra']);
                unset($data['select_rp']);
                unset($data['file_pemeriksaan_luar']);
                
                $data['berat_badan'] = $data['berat_badan'] == 0 ? NULL:$data['berat_badan'];
                $data['tinggi_badan'] = $data['tinggi_badan'] == 0 ? NULL:$data['tinggi_badan'];
                $data['tekanan_darah'] = $data['tekanan_darah'] == '' ? NULL:$data['tekanan_darah'];
                $data['suhu'] = $data['suhu'] == '' ? NULL:$data['suhu'];
                $data['riwayat_penyakit'] = $data['riwayat_penyakit'] == '' ? NULL:$data['riwayat_penyakit'];
                $data['riwayat_alergi'] = $data['riwayat_alergi'] == '' ? NULL:$data['riwayat_alergi'];
				
				$data['id_pasien'] = $this->session->userdata('id_user');
				$data['id_dokter'] = $jk->id_dokter;

				$assesment = $this->db->query('SELECT * FROM assesment WHERE id_jadwal_konsultasi = '.$jk->id)->row();
				if($assesment){
					$this->all_model->update('assesment', $data, array('id_jadwal_konsultasi'=>$id_jadwal_konsultasi));
				}
				else{
					$this->db->insert('assesment', $data);	
				}
                $this->session->set_flashdata('msg_assesment', 'Data Berhasil Disimpan');
            }
            else{
                foreach($jadwal_konsultasi as $jk){
                    $assesment = $this->db->query('SELECT * FROM assesment WHERE id_jadwal_konsultasi = '.$jk->id)->row();
                    if($assesment){
			$dokter = $this->db->query('SELECT reg_id FROM master_user WHERE id_user_kategori = 2 AND id = '.$jk->id_dokter)->row();
			$data['name'] = 'unshow';
			$data['sub_name'] = 'submit_assesment_pasien';
			$data['id_user'] = json_encode(array($jk->id_dokter));
			$msg_notif = json_encode($data);
			$this->key->_send_fcm($dokter->reg_id, $msg_notif);

			unset($data['name']);
			unset($data['sub_name']);
			unset($data['id_user']);

                        $update = $this->all_model->update('assesment', $data, array('id_jadwal_konsultasi'=>$jk->id));
                        if($update != 0)
                        {
                            if($update == -1){
                                $this->session->set_flashdata('msg_assesment', 'Data gagal disimpan');
                            }
                            else{
                                $this->session->set_flashdata('msg_assesment','Data berhasil disimpan');	
                            }							
                            
                        } else {
                            $this->session->set_flashdata('msg_assesment','Data tidak ada yang disimpan');								
                        }
                    }
                    else{
			$dokter = $this->db->query('SELECT reg_id FROM master_user WHERE id_user_kategori = 2 AND id = '.$jk->id_dokter)->row();
			$data['name'] = 'unshow';
			$data['sub_name'] = 'submit_assesment_pasien';
			$data['id_user'] = json_encode(array($jk->id_dokter));
			$msg_notif = json_encode($data);
			$this->key->_send_fcm($dokter->reg_id, $msg_notif);

			unset($data['name']);
			unset($data['sub_name']);
			unset($data['id_user']);		

                        $data['id_pasien'] = $this->session->userdata('id_user');
                        $data['id_jadwal_konsultasi'] = $jk->id;
                        $data['id_dokter'] = $jk->id_dokter;
                        $new_assesment = $this->db->insert('assesment', $data);
                        $this->session->set_flashdata('msg_assesment', 'Data berhasil disimpan, tunggu panggilan dari dokter yang telah dijadwalkan!');
                    }
                }
            }
        }
        redirect('pasien/Telekonsultasi/jadwal');
    }

    public function upload_attachment($id_jadwal_konsultasi){
        if(!$this->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        if($valid->id_user_kategori != 0){
            if($valid->id_user_kategori == 2){
                redirect(base_url('dokter/Dashboard'));
            }
            else{
                redirect(base_url('admin/Admin'));
            }
        }
        $fpl = $this->db->query('SELECT id FROM file_pemeriksaan_luar WHERE id_jadwal_konsultasi = ?', $id_jadwal_konsultasi)->result();
        if(count($fpl) >= 3){
            echo json_encode(array(
                'success' => false,
                'message' => 'Jumlah file yang diupload sudak maksimal!'
            ));
            return;
        }
        $file_pemeriksaan_luar = isset($_FILES['file_pemeriksaan_luar']) ? $_FILES['file_pemeriksaan_luar']:false;
        if(!$file_pemeriksaan_luar){
            echo json_encode(array(
                'success'=>false,
                'message'=>'<p>Pilih File Terlebih Dahulu!'
            ));
            return;
        }

        $randstr = uniqid();

        $config['upload_path']          = './assets/files/file_pemeriksaan_luar';
        $config['allowed_types']        = 'gif|jpg|png|jpeg|jfif|pdf|docx|doc|xlsx|xls|rar|zip';
        $config['max_size']             = 10024;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        $config['file_name']            = 'fpl_'.$id_jadwal_konsultasi.'_'.$randstr;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('file_pemeriksaan_luar')) {
            echo json_encode(array(
                'success'=>false,
                'message'=>json_encode($this->upload->display_errors('', ''))
            ));
            return;
        } else {
            $file_name = $this->upload->data('file_name');
            $data_file = array(
                'file' => $file_name,
                'id_jadwal_konsultasi' => $id_jadwal_konsultasi
            );
            $this->db->insert('file_pemeriksaan_luar', $data_file);
            $file_id = $this->db->insert_id();
            echo json_encode(array(
                'success'=>true,
                'message'=>'File berhasil diupload!',
                'data'=>json_encode(array(
                                'file_name' => $file_name,
                                'file_id' => $file_id
                            )
                        )
            ));
            return;
        }
    }

    public function delete_attachment($id_fpl){
        if(!$this->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        if($valid->id_user_kategori != 0){
            if($valid->id_user_kategori == 2){
                redirect(base_url('dokter/Dashboard'));
            }
            else{
                redirect(base_url('admin/Admin'));
            }
        }
        $fpl = $this->db->query('SELECT fpl.id, fpl.file FROM file_pemeriksaan_luar fpl INNER JOIN jadwal_konsultasi jk ON fpl.id_jadwal_konsultasi = jk.id WHERE jk.id_pasien = ? AND fpl.id = ?', array($this->session->userdata('id_user'),$id_fpl))->row();
        if(!$fpl){
            echo json_encode(array(
                'success'=>false,
                'message'=>'File tidak ditemukan!'
            ));
            return;
        }

        if($this->db->delete('file_pemeriksaan_luar', array('id'=>$id_fpl))){
            unlink(FCPATH."assets/files/file_pemeriksaan_luar/".$fpl->file);
            echo json_encode(array(
                'success'=>true,
                'message'=>'File berhasil dihapus!'
            ));
            return;
        }else{
            echo json_encode(array(
                'success'=>false,
                'message'=>'File gagal dihapus: '.$this->db->error()
            ));
            return;
        }
    }
}
