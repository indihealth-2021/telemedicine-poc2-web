<!-- Main content -->
<div class="page-wrapper">
    <div class="content">
        <div class="row mb-3">
            <div class="col-sm-12 col-12 ">
              <nav aria-label="">
                  <ol class="breadcrumb" style="background-color: transparent;">
                      <li class="breadcrumb-item active"><a href="<?php echo base_url('diampu/Diampu/list_pengampu') ?>"class="text-black">List Pengampu</a></li>
                      <li class="breadcrumb-item" aria-current="page"><a href="" class="text-black font-bold-7">Proses Telekonsultasi</a></li>
                  </ol>
              </nav>
            </div>
            <div class="col-sm-12 col-12">
                <h3 class="page-title">Proses Telekonsultasi</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="telekonsultasi-tab" data-toggle="tab" href="#telekonsultasi" role="tab" aria-controls="telekonsultasi" aria-selected="true">Telekonsultasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="rekammedis-tab" data-toggle="tab" href="#rekammedis" role="tab" aria-controls="rekammedis" aria-selected="false">Rekam Medis</a>
                    </li>
                </ul>
            </div>
        </div>  

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show" id="rekammedis" role="tabpanel" aria-labelledby="rekammedis-tab">
                <div class="row">
                    <div class="col-md-12">
                        <div class="blog-view">
                            <div class="card-box">
                                <h4>Rekam Medis</h4><br/>
                                <div class="table-responsive font-14">
                                    <table class="table table-border table-hover custom-table mb-0" id="table_rekam_medis">
                                            <thead class="text-tr">
                                                <tr class="text-center">          
                                                    <th width="2%">No</th>
                                                    <th>Tanggal Telekonsultasi</th>
                                                    <th>Poli</th>
                                                    <th>Diagnosa</th>
                                                    <th class="text-center">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade show active" id="telekonsultasi" role="tabpanel" aria-labelledby="telekonsultasi-tab">
                <div class="row">
                <div class="col-md-7">
                    <div class="card card-5 p-1 px-4 pt-3 pb-5">
                    <ul class="nav nav-tabs-konsul nav-tabs-bottom">
                            <li class="nav-item"><a class="nav-link active" href="#bottom-tab2" data-toggle="tab">Video</a></li>
                            <li class="nav-item"><a class="nav-link" href="#bottom-tab1" data-toggle="tab">Chat</a></li>
                        </ul>
                        
                    <div class="tab-content">
                            <div class="tab-pane show" id="bottom-tab1">
                                <div class="">
                                    <div class="col-lg-9 message-view chat-view">
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
                                                <form id="form-message" enctype="multipart/form-data">
                                                    <div class="message-bar">
                                                        <div class="message-inner">
                                                            <label class="images-upload px-3 mt-2">
                                                                <img src="<?php echo base_url('assets/dashboard/img/file.png'); ?>" alt="">
                                                                <input id="attachment_label" type="file" name="attachment" accept=".jpg,.jfif,.jpeg,.png,.txt,.docx,.doc,.pdf">
                                                            </label>
                                                            <div class="message-area">
                                                                <div class="input-group">
                                                                    <textarea class="form-control" name="message" placeholder="Type message..."></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button class="btn btn-send-mess mt-2" id="send">
                                                            <img src="<?php echo base_url('assets/dashboard/img/send.png'); ?>" width="20" height="auto" alt="">
                                                        </button>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-9" id="attachment_name">

                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane active" id="bottom-tab2">
                                <div class="row my-2 px-3">
                                    <button type="button" data-toggle="modal" data-target="#exampleModal" class="mb-2 btn btn-konsul" id="panggil_pengampu" data-dokter-diampu="" data-id-pengampu="<?php echo $pengampu->id ?>"><img src="<?php echo base_url('assets/dashboard/img/phone-call.png'); ?>" alt=""> Hubungi Pasien</button>
                                    <button type="button" class="btn btn-konsul mx-3 d-mobile-none" id="btn-stop-diampu" data-id-pengampu="<?php echo $pengampu->id ?>"><img src="<?php echo base_url('assets/dashboard/img/end-call.png'); ?>" alt=""> Akhiri Panggilan</button>
                                    <button type="button" class="btn btn-konsul mx-auto d-mobile-show" id="btn-stop-diampu" data-id-pengampu="<?php echo $pengampu->id ?>"><img src="<?php echo base_url('assets/dashboard/img/end-call.png'); ?>" alt=""> Akhiri Panggilan</button>

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
                                                        <button type="button" class="btn btn-batal" data-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--modal-->
                                </div>
                                <div class="">
                                    <div id="meet" width="800" height="700" style="background: #000;"></div>
                                        <!-- <video autoplay id="video-other" style="background-color: #000;" width="100%" height="100%"></video>                  
                                        <video autoplay id="video-ku" style="background-color: #000; position: absolute; bottom: 75px; right: 8px; width: 40%; height: 40%;"></video> -->
                                </div>
                            </div>
                    </div>
                    </div>
                </div>

                <!-- batas col-md-7 -->
                <div class="col-md-5">
                      <div class="card card-5 p-2 px-4">
                        <p style="border-bottom: 1px solid #DEDEDE;" class="py-2 font-14 text-bold">Opsi</p>
                        <div class="font-12">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">Pasien </div>
                                    <div class="col-md-8">
                                        <select class="form-control" id="pasien">
                                            <option value=-1>Pilih Pasien</option>
                                            <?php foreach ($list_pasien as $pasien) { ?>
                                                <option value=<?php echo $pasien->id ?>><?php echo $pasien->name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>  
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">Usia  </div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control-plaintext font-11" id="usia" value="- Tahun" name="" disabled readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">RS Pengampu  </div>
                                    <div class="col-md-8">
                                        <input type="text" readonly class="form-control-plaintext font-11" id="" value="<?php echo ucwords($pengampu->name) ?>" name="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">Dokter Diampu  </div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="dokter_diampu" value="" name="dokter_diampu">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">Dokter Pengampu  </div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="dokter_pengampu" value="" name="dokter_pengampu" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p style="border-bottom: 1px solid #DEDEDE;" class="py-2 font-14 text-bold">Catatan</p>
                        <div class="font-12">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">Diampu  </div>
                                    <div class="col-md-8">
                                        <textarea rows="4" class="font-12 form-control floating" id="catatan_diampu" value="" name="catatan_diampu"></textarea>
                                    </div>
                                </div>
                            </div>
                           <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">Pengampu  </div>
                                    <div class="col-md-8">
                                        <textarea rows="4" class="font-12 form-control floating" id="catatan_pengampu" value="" name="catatan_pengampu" disabled></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="pengampuError" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="width: 300px">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pasien Error</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                RS Pengampu: <b><?php echo ucwords($pengampu->name) ?></b> tidak dapat menerima panggilan saat ini, karena belum mengizinkan notifikasi di devicenya. <br />
                Email Pengampu: <b><?php echo $pengampu->email ?></b>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    function makeid(length) {
        var result = '';
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for (var i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }
    var uniqid = makeid(12);
    reg_id = '<?php echo $pengampu->reg_id; ?>';
    name = '<?php echo $user->name; ?>';
    var room_name = 'telemedicine_lintas_' + <?php echo $pengampu->id ?> + '_' + <?php echo $user->id ?> + '_' + uniqid;
    document.getElementById("user-call").value = '<?php echo $pengampu->id ?>';
    var userName = name;
    const domain = 'telekonsultasi2.telemedical.id';
    const options = {
        roomName: room_name,
        width: 550,
        height: 500,

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
</script>
<script type="text/javascript" src="<?php echo base_url('assets/js/conference.js'); ?>"></script>
<?php $foto_pasien = $pengampu->foto ? base_url('assets/images/users/' . $pengampu->foto) : base_url('assets/telemedicine/img/default.png'); ?>
<?php $foto_dokter = $user->foto ? base_url('assets/images/users/' . $user->foto) : base_url('assets/telemedicine/img/default.png'); ?>
<script>
    chat_locate = 'dokter';
    user_kategori = 'dokter';
    id_pasien = <?php echo $pengampu->id ?>;
    id_dokter = <?php echo $user->id ?>;
    foto_pasien = '<?php echo $foto_pasien ?>';
    foto_dokter = '<?php echo $foto_dokter ?>';
</script>
<script>
    function resizeInput() {
        $(this).attr('size', $(this).val().length);
    }
    $('input[type="text"]')
        .keyup(resizeInput)
        .each(resizeInput);

    $('input[type="number"]')
        .keyup(resizeInput)
        .each(resizeInput);
</script>

<div class="sidebar-overlay" data-reff=""></div>
<style>
    .images-upload>input {
        display: none;
    }

    .images-upload>img {
        cursor: pointer;
    }
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
    }
</style>
