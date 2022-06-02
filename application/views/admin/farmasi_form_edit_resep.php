<!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-12 col-12 ">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('farmasi/farmasi');?>"class="text-black">Dashboard</a></li>
                    <li class="breadcrumb-item " aria-current="page"><a href="<?php echo base_url('admin/FarmasiVerifikasiObat') ?>" class="text-black">Verifikasi Obat</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="" class="text-black font-bold-7">Edit Obat</a></li>
                </ol>
            </nav>
          </div>
          <div class="col-sm-12 col-12">
              <h3 class="page-title">Edit Obat</h3>
          </div>
      </div>  
      
        <div class="row mb-5">
          <div class="col-md-3">
            <button type="button" class="btn btn-tele btn-block" data-toggle="modal" data-target="#ModalResep"><i class="fa fa-plus"></i> Tambah Obat</button>
          </div>
          <div class="col-md-3">
            <button type="button" class="btn btn-tele btn-block" onclick="location.reload()"><i class="fa fa-refresh"></i> Reload Data</button>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-12">
                <div class="input-group">
                  <select class="custom-select" id="pasien" name="pasien">
                      <option value="<?= $pasien->id ?>" selected><?= $pasien->name ?> ( <?= $pasien->no_medrec ?> )</option>
                  </select>
                  <div class="input-group-append">
                    <button class="btn bg-tele text-light" type="button" id="panggil-pasien">Panggil</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="row" id="konten-panggilan" hidden>
                <div class="col-md-12">
                  <div class="card card-5 p-1 px-4 pt-3 pb-5">
                    <ul class="nav nav-tabs-konsul nav-tabs-bottom">
                        <li class="nav-item"><a class="nav-link active" href="#bottom-tab2" data-toggle="tab">Video</a></li>
                        <li class="nav-item"><a class="nav-link" href="#bottom-tab1" data-toggle="tab">Chat</a></li>
                    </ul>
                    
                    <div class="tab-content">
                          <div class="tab-pane show" id="bottom-tab1">
                              <div class="">
                                  <div class="col-lg-12 message-view chat-view" style="width: 10% !important">
                                      <div class="chat-window">
                                          <div class="card-box">
                                              <div class="chat-contents chat-content-wrap">
                                                  <div class="chat-wrap-inner">
                                                      <div class="chat-box">
                                                          <div class="chats" id="messages">

                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="chat-footer">
                                            <?= form_open_multipart('', 'id="form-message"'); ?> 
                                                  <div class="message-bar">
                                                      <div class="message-inner">
                                                            <label class="images-upload px-3 mt-2">
                                                                <img src="<?php echo base_url('assets/dashboard/img/file.png'); ?>" alt="">
                                                                <input id="attachment_label" type="file" name="attachment" accept=".jpg,.jfif,.jpeg,.png,.txt,.docx,.doc,.pdf" style="display: none;">
                                                            </label>
                                                          <div class="message-area">
                                                              <div class="input-group">
                                                                  <textarea class="form-control" name="message" placeholder="Type message..."></textarea>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <input type="hidden" name="attachment" value=''>
                                                      <button class="btn btn-send-mess" id="send">
                                                        <img src="<?php echo base_url('assets/dashboard/img/send.png'); ?>" width="10" height="auto" alt="">
                                                      </button>
                                                  </div>
                                          </div>
                                          <?= form_close(); ?>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="tab-pane active" id="bottom-tab2">
                            <div class="row my-2 px-3">
                              

                                  </div>
                              <div class="">
                                  <div id="meet" width="800" height="700" style="background: #000;"></div>
                                  <!-- <video autoplay id="video-other" style="background-color: #000;" width="100%" height="100%"></video>                  
                                            <video autoplay id="video-ku" style="background-color: #000; position: absolute; bottom: 75px; right: 8px; width: 40%; height: 40%;"></video> -->
                              </div>
                          </div>
                      </div>
                      <!-- <button type="button" data-toggle="modal" data-target="#exampleModal" class="mb-2 btn btn-konsul" id="panggil" data-id-pasien="" data-id-jadwal-konsultasi=""><img src="<?php echo base_url('assets/dashboard/img/phone-call.png'); ?>" alt=""> Hubungi Pasien</button> -->
                      <div class="row mt-2">
                        <div class="col-md-12">
                          <button type="button" class="btn btn-outline-danger btn-block" id="btn-stop-farmasi" data-id-user="" data-pd='p'><img src="<?php echo base_url('assets/dashboard/img/end-call.png'); ?>" alt=""> Akhiri Panggilan</button>
                        </div>
                      </div>
                  </div>
              </div>
          </div>
</div>
          <div class="col-md-12 mt-4">
          <?= form_open('admin/FarmasiVerifikasiObat/submit_resep', 'class="email" id="myform"'); ?> 
            <div class="bg-tab">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-border table-hover custom-table mb-0" id="table_farmasi">                
                          <thead class="text-tr">
                          <tr>
                              <th>Nama Obat</th>
                              <th>Jumlah</th>
                              <th>Aturan Pakai</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody id="listResep">
                          <?php foreach($list_obat as $idx=>$obat){ ?>
                            <tr class="font-14">
                              <td><span title="<?php echo $obat->nama_obat ?>"><?php echo strlen($obat->nama_obat) > 50 ? substr($obat->nama_obat, 0, 49).'...':$obat->nama_obat ?></span> <?php echo $obat->active ? '':'<span class="badge badge-danger">Nonaktif</span>'; ?></td>
                              <input type="hidden" name="id_obat[]" value="<?php echo $obat->id_obat; ?>">
                              <td><?php echo $obat->jumlah_obat.' '.$obat->nama_unit ?></td>
                              <input type="hidden" name="jumlah_obat[]" value="<?php echo $obat->jumlah_obat ?>">
                              <td><?php echo $obat->aturan_pakai ?></td>
                              <input type="hidden" name="keterangan[]" value="<?php echo $obat->aturan_pakai ?>">
                              <td><a style="cursor: pointer;" type="button" onclick="return (this.parentNode).parentNode.remove();" >
                                <i><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M17.5 1.875H2.5C1.80964 1.875 1.25 2.43464 1.25 3.125V3.75C1.25 4.44036 1.80964 5 2.5 5H17.5C18.1904 5 18.75 4.44036 18.75 3.75V3.125C18.75 2.43464 18.1904 1.875 17.5 1.875Z" fill="black" fill-opacity="0.35"/>
                                <path d="M2.90818 6.25C2.86427 6.24976 2.82079 6.25878 2.7806 6.27648C2.74041 6.29417 2.70439 6.32013 2.67491 6.35268C2.64542 6.38522 2.62313 6.42362 2.60948 6.46536C2.59582 6.5071 2.59112 6.55124 2.59568 6.59492L3.62342 16.4605C3.62321 16.4634 3.62321 16.4663 3.62342 16.4691C3.67712 16.9255 3.89649 17.3462 4.2399 17.6514C4.58331 17.9567 5.02685 18.1252 5.48631 18.125H14.5133C14.9726 18.125 15.4159 17.9564 15.7592 17.6511C16.1024 17.3459 16.3217 16.9253 16.3754 16.4691V16.4609L17.4015 6.59492C17.4061 6.55124 17.4014 6.5071 17.3877 6.46536C17.3741 6.42362 17.3518 6.38522 17.3223 6.35268C17.2928 6.32013 17.2568 6.29417 17.2166 6.27648C17.1764 6.25878 17.133 6.24976 17.089 6.25H2.90818ZM12.6293 13.3082C12.6887 13.3659 12.736 13.4349 12.7686 13.5111C12.8011 13.5873 12.8181 13.6692 12.8187 13.752C12.8193 13.8349 12.8034 13.917 12.772 13.9937C12.7405 14.0703 12.6942 14.1399 12.6356 14.1985C12.577 14.2571 12.5073 14.3034 12.4307 14.3348C12.354 14.3662 12.2719 14.3821 12.189 14.3814C12.1062 14.3808 12.0243 14.3637 11.9481 14.3312C11.8719 14.2986 11.803 14.2512 11.7453 14.1918L9.99998 12.4465L8.25427 14.1918C8.13652 14.3062 7.97849 14.3697 7.81431 14.3685C7.65014 14.3674 7.49301 14.3016 7.3769 14.1856C7.26078 14.0695 7.19499 13.9124 7.19376 13.7482C7.19252 13.5841 7.25593 13.426 7.37029 13.3082L9.11599 11.5625L7.37029 9.8168C7.25593 9.699 7.19252 9.54093 7.19376 9.37675C7.19499 9.21258 7.26078 9.05549 7.3769 8.93942C7.49301 8.82335 7.65014 8.75764 7.81431 8.75648C7.97849 8.75531 8.13652 8.81879 8.25427 8.9332L9.99998 10.6785L11.7453 8.9332C11.863 8.81879 12.0211 8.75531 12.1853 8.75648C12.3494 8.75764 12.5066 8.82335 12.6227 8.93942C12.7388 9.05549 12.8046 9.21258 12.8058 9.37675C12.807 9.54093 12.7436 9.699 12.6293 9.8168L10.8836 11.5625L12.6293 13.3082Z" fill="black" fill-opacity="0.35"/>
                                </svg></i></a></td>
                            </tr>
                          <?php } ?>
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
          </div>
        </div>
                <div class="m-t-20">
                <input type="hidden" name="id_pasien" value="<?php echo $list_obat[0]->id_pasien; ?>">
                <input type="hidden" name="id_dokter" value="<?php echo $list_obat[0]->id_dokter; ?>">
                <input type="hidden" name="id_jadwal_konsultasi" value="<?php echo $id_jadwal_konsultasi; ?>">
                    <button type="submit" class="btn btn-simpan">Simpan Data</button>
                    <a href="<?php echo base_url('admin/FarmasiVerifikasiObat') ?>" type="button" class="btn btn-batal ml-5">Batalkan</a>
                </div>            
      <?= form_close(); ?>
          </div>
      </div>
            
          <!-- /.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    
    <div class="modal fade" id="ModalResep" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="height: auto">
      <div class="modal-header ">
        <h4 class="modal-title font-14 font-bold-7 px-3" id="exampleModalLabel">Resep Obat</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="pr-3">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formResepDokter">
          <div class="col-12">
          	<div class="row">
          		<div class="col-12">
          			<div class="form-group">
			           <label for="recipient-name" class="col-form-label font-12">Pilih Obat</label>
			            <?php foreach($list_master_obat as $obat){ ?>
			              <div id="obat-<?php echo $obat->id ?>" style="display: none"><?php echo $obat->unit ?></div>
			            <?php } ?>
			              <select name="id_obat" id="obat" class="form-control form-control-sm" onchange="obat_onchange();" required>
			              <option disabled selected value="">Pilih Obat</option>
			                    <?php foreach($list_master_obat as $obat){ ?>
			              <option value="<?php echo $obat->id ?>"><?php echo $obat->name ?></option>
			                    <?php } ?>
			              </select>
			          </div>	
          		</div>
          		<div class="col-12">
          			<div class="form-group">
			           <label for="message-text" class="col-form-label font-12">Jumlah Obat</label>
			           <input type="number" min=1 name="jumlah_obat" class="form-control form-control-sm" id="unit" placeholder="Jumlah" required>
			        </div>			
          		</div>
          		<div class="col-12">
	          		<div class="form-group">
			            <label for="message-text" class="col-form-label font-12">Aturan Pakai</label>
			            <textarea type="text" rows="3" name="keterangan" class="form-control form-control-sm" placeholder="Aturan Pakai" required></textarea>
			        </div>
	          	</div>
                <input type="hidden" name="satuan_obat" id="satuan_obat" value="">
          	</div>
          </div>
      </div>
      <div class="modal-footer">
        <div class="mx-auto">
          <button id="buttonTambahResep" class="btn btn-simpan-sm">Simpan</button> 
          <button type="button" class="btn btn-batal-sm ml-5" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="memanggil" tabindex="0" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" >
        <div class="modal-content" style="width: 400px">
            <div class="modal-header">
                <p class="modal-title font-24" id="exampleModalLabel">Memanggil...</p>
            </div>
            <div class="modal-body" align="center">
                <i class="fa fa-phone fa-5x text-tele">....</i>
                <div class="mt-5">
                    <button type="button" class="btn btn-batal-farmasi" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function obat_onchange(){
  var obat = document.getElementById('obat');
  var satuan = document.getElementById('obat-'+obat.value);
  var satuan_obat_hidden = document.getElementById('satuan_obat');
  
  var satuan_show = document.getElementById('unit');

  satuan_show.placeholder = "Jml ("+satuan.innerHTML+")";
  satuan_obat_hidden.value = satuan.innerHTML;
}
</script>
<?php if($this->session->flashdata('msg_hapus_obat')){ echo "<script>alert('".$this->session->flashdata('msg_hapus_obat')."')</script>"; } ?>

<script>
    chat_locate = 'farmasi';
    user_kategori = 'farmasi';
    id_pasien = '';
    id_dokter = <?php echo $user->id ?>;
    foto_pasien = '';
    foto_dokter = '';
    chat_id = '';
</script>
<script type="text/javascript">
    var room_name = '';
    function start_consultation(){
      name = '<?php echo $user->name; ?>';
      var userName = name;
      const domain = 'telekonsultasi.lintasarta.net';
      const options = {
          roomName: room_name,
          width: '100%',
          height: '400px',

          parentNode: document.querySelector('#meet')

      };
      const api = new JitsiMeetExternalAPI(domain, options);
      api.executeCommand('displayName', userName);
      api.executeCommand('toggleTileView');
      api.executeCommand('startRecording', {
          mode: 'file' //recording mode, either `file` or `stream`.
      });
      api.addEventListener('participantRoleChanged', function(event) {
          if (event.role === 'moderator') {
              api.executeCommand('toggleLobby', true);
          }
      });
      api.on('passwordRequired', function() {
          api.executeCommand('password', '123456');
      });

      function recordJitsi(e) {
          api.executeCommand('stopRecording', 'stream');
          var isRecording = e.getAttribute('data-is-recording');
          if (isRecording == "1") {
              api.executeCommand('stopRecording', 'stream');
              e.innerHTML = '<i class="fas fa-record-vinyl"></i> Mulai Rekam';
              e.setAttribute('data-is-recording', "0");
              e.style = 'background-color: green';
          } else {
              api.executeCommand('startRecording', 'stream');
              e.innerHTML = '<i class="fas fa-stop"></i> Stop Rekam';
              e.setAttribute('data-is-recording', "1");
              e.style = 'background-color:red;';
          }
      }
    }
</script>