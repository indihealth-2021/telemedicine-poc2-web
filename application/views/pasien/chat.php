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
<!-- Main content -->
  <div class="page-wrapper">
    <div class="content">
      <div class="row mb-3">
        <div class="col-sm-12 col-12 ">
          <nav aria-label="">
              <ol class="breadcrumb" style="background-color: transparent;">
                  <li class="breadcrumb-item"><a href="<?php echo base_url('pasien/Dashboard');?>"class="text-black">Dashboard</a></li>
                  <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('pasien/Telekonsultasi/jadwal');?>"class="text-black">Jadwal Telekonsultasi</a></li>
                  <li class="breadcrumb-item  active" aria-current="page"><a href=""class="text-black font-bold-7">Chat Dokter</a></li>
              </ol>
          </nav>
        </div>
        <div class="col-sm-12 col-12">
            <h3 class="page-title">Chat dengan <?= $dokter->name ?></h3>

        </div>
      </div>

      <div class="row justify-content-md-center">

            <div class="col-lg-9">
              <ul class="nav nav-tabs-konsul nav-tabs-bottom">

                  <li class="nav-item active"><a class="nav-link" href="#bottom-tab1" data-toggle="tab">Chat</a></li>
              </ul>
            </div>
            <div class="col-lg-9 message-view chat-view" >

                <div class="chat-window" >
                    <div class="card-box" >
                        <div class="chat-contents chat-content-wrap" >
                            <div class="chat-wrap-inner">
                                <div class="chat-box" >
                                    <div class="chats" id="messages" >
                                        <!--<div class="chat chat-right">
                                                    <div class="chat-body">
                                                        <div class="chat-bubble">
                                                            <div class="chat-content">
                                                                <p>Hello. What can I do for you?</p>
                                                                <span class="chat-time">8:30 am</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="chat-line">
                                                    <span class="chat-date">October 8th, 2015</span>
                                                </div>
                                                <div class="chat chat-right">
                                                    <div class="chat-body">
                                                        <div class="chat-bubble">
                                                            <div class="chat-content">
                                                                <p>Where?</p>
                                                                <span class="chat-time">8:35 am</span>
                                                            </div>
                                                        </div>
                                                        <div class="chat-bubble">
                                                            <div class="chat-content">
                                                                <p>OK, my name is Limingqiang. I like singing, playing basketballand so on.</p>
                                                                <span class="chat-time">8:42 am</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="chat chat-left">
                                                    <div class="chat-avatar">
                                                        <a href="#" class="avatar">
                                                            <img alt="<?php //echo $pasien->name
                                                                        ?>" src="<?php //echo base_url('assets/dashboard/img/patient-thumb-02.jpg');
                                                                                                            ?>" class="img-fluid rounded-circle">
                                                        </a>
                                                    </div>
                                                    <div class="chat-body">
                                                        <div class="chat-bubble">
                                                            <div class="chat-content img-content">
                                                                <div class="chat-img-group clearfix">
                                                                    <p>Uploaded 3 Images</p>
                                                                    <a class="chat-img-attach" href="#">
                                                                        <img width="182" height="137" alt="" src="assets/img/placeholder.jpg">
                                                                        <div class="chat-placeholder">
                                                                            <div class="chat-img-name">placeholder.jpg</div>
                                                                            <div class="chat-file-desc">842 KB</div>
                                                                        </div>
                                                                    </a>
                                                                    <a class="chat-img-attach" href="#">
                                                                        <img width="182" height="137" alt="" src="assets/img/placeholder.jpg">
                                                                        <div class="chat-placeholder">
                                                                            <div class="chat-img-name">842 KB</div>
                                                                        </div>
                                                                    </a>
                                                                    <a class="chat-img-attach" href="#">
                                                                        <img width="182" height="137" alt="" src="assets/img/placeholder.jpg">
                                                                        <div class="chat-placeholder">
                                                                            <div class="chat-img-name">placeholder.jpg</div>
                                                                            <div class="chat-file-desc">842 KB</div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <span class="chat-time">9:00 am</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>-->

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
                                        <input id="attachment_label" type="file" name="attachment" accept=".jpg,.jfif,.jpeg,.png,.txt,.docx,.doc,.pdf">
                                    </label>
                                    <div class="message-area">
                                        <div class="input-group">
                                            <textarea class="form-control border-sm" name="message" placeholder="Tulis Pesan Disini..."></textarea>
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
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>

  </div>
  <?php $foto_pasien = $user->foto ? base_url('assets/images/users/' . $user->foto) : base_url('assets/telemedicine/img/default.png'); ?>
  <?php $foto_dokter = $dokter->foto ? base_url('assets/images/users/' . $dokter->foto) : base_url('assets/telemedicine/img/default.png'); ?>
  <script>
      chat_locate = 'pasien';
      user_kategori = 'pasien';
      id_pasien = <?php echo $user->id ?>;
      id_dokter = <?php echo $dokter->id ?>;
      foto_pasien = '<?php echo $foto_pasien ?>';
      foto_dokter = '<?php echo $foto_dokter ?>';
      chat_id = `${id_dokter}_${id_pasien}`;
  </script>
  <!-- <script src='<?= base_url('assets/js/message.js') ?>'></script> -->
