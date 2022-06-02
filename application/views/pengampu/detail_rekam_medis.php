<!-- Main content -->
  <div class="page-wrapper">
    <div class="content">
      <div class="row mb-3">
        <div class="col-sm-12 col-12 ">
          <nav aria-label="">
              <ol class="breadcrumb" style="background-color: transparent;">
                  <li class="breadcrumb-item active"><a href=""class="text-black">Pengampu</a></li>
                  <li class="breadcrumb-item" aria-current="page"><a href=""class="text-black">Rekam Medis</a></li>
                  <li class="breadcrumb-item" aria-current="page"><a href=""class="text-black font-bold-7">Detail Rekam Medis</a></li>
              </ol>
          </nav>
        </div>
        <div class="col-sm-12 col-12">
            <h3 class="page-title">Detail Rekam Medis</h3>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <p class="text-center font-24 mb-5 pt-4"><u><b>REKAM MEDIS</b></u></p> 
          <div class="row font-14 font-bold-7">
            <div class="col-md-6">
              <div class="form-group row">
                  <label class="col-md-3 col-4">No Registrasi</label>
                  <div class="col-md-9 col-8">
                      <p>: <?php echo $rekam_medis->id_registrasi ?></p>
                  </div>
                  <label class="col-md-3 col-4">Dokter</label>
                  <div class="col-md-9 col-8">
                      <p>: <?php echo $rekam_medis->nama_dokter ?></p>
                  </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                  <label class="col-md-4 col-4">Tanggal Konsultasi</label>
                  <div class="col-md-8 col-8">
                        <p>: <?php $tanggal_konsul = $rekam_medis->tanggal_konsultasi ? (new DateTime($rekam_medis->tanggal_konsultasi))->format('d-m-Y H:i:s'):'-'; 
                            echo $tanggal_konsul;
                        ?></p>
                  </div>
                  <label class="col-md-4 col-4">Poli</label>
                  <div class="col-md-8 col-8">
                      <p>: <?php echo ucwords($rekam_medis->poli) ?></p>
                  </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 mb-3">
              <p class="font-24 font-bold-7">Data Pasien</p>
            </div>
            <div class="col-md-6 font-14 font-bold-4">
              <div class="form-group row">
                  <label class="col-md-4 col-4">No Rekam Medis</label>
                  <div class="col-md-8 col-8">
                      <p>: <?php echo $rekam_medis->no_medrec ?></p>
                  </div>
                  <label class="col-md-4 col-4">Nama</label>
                  <div class="col-md-8 col-8">
                      <p>: <?php echo ucwords($rekam_medis->nama_pasien) ?></p>
                  </div>
                  <?php 
                    $tanggal_lahir = new DateTime($rekam_medis->tanggal_lahir_pasien);
                    $tanggal_lahir = $tanggal_lahir->format('d-m-Y');
                  ?>
                  <label class="col-md-4 col-4">Tempat / Tanggal Lahir</label>
                  <div class="col-md-8 col-8">
                      <p>: <?php echo ucwords($rekam_medis->tempat_lahir_pasien) ?>, <?php echo $tanggal_lahir ?></p>
                  </div>
                  <label class="col-md-4 col-4">Jenis Kelamin</label>
                  <div class="col-md-8 col-8">
                      <p>: <?php echo $rekam_medis->jk_pasien ?></p>
                  </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 mb-3">
              <p class="font-24 font-bold-7">Pemeriksaan</p>
            </div>
            <div class="col-md-12 font-14 font-bold-4">
              <div class="form-group row">
                  <label class="col-md-2 col-4">Keluhan</label>
                  <div class="col-md-10 col-10">
                      <p>: <?php echo $rekam_medis->keluhan ?></p>
                  </div>
                  <label class="col-md-2 col-4">Diagnosa</label>
                  <div class="col-md-10 col-10">
                      <p>: <?php echo '('.$rekam_medis->diagnosis_code.') '.$rekam_medis->diagnosis ?></p>
                  </div>
                  <?php 
                    $tanggal_lahir = new DateTime($rekam_medis->tanggal_lahir_pasien);
                    $tanggal_lahir = $tanggal_lahir->format('d-m-Y');
                  ?>
                  <label class="col-md-2 col-4">Resep Obat</label>
                  <div class="col-md-10 col-10">
                      <?php echo $rekam_medis->list_obat ? '<ol>'.$rekam_medis->list_obat.'</ol>' : '<p>: -</p>' ?>
                  </div>
                  <?php if($rekam_medis->order_status != null){ ?>
                      <label class="col-md-2 col-4">Order Status</label>
                      <div class="col-md-8 col-8">
                          <p>: <?php echo $rekam_medis->order_status == 1 ? 'DELIVERED':'PENDING' ?></p>
                      </div>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>