<!-- Main content -->
<div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-5 col-5">
              <h4 class="page-title">Detail Rekam Medis</h4>
          </div>
          <div class="col-sm-7 col-7">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: whitesmoke; float: right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('dokter/Dashboard');?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Rekam Medis</li>
                </ol>
            </nav>
          </div>
      </div>            
                <div class="row">
                    <div class="col-lg-12 offset-lg-0 card-box text-black">
                        <form>
                            <div class="row">
                                <div class="col-sm-12">
                                    <h3 align="center" class="mb-5 pt-4"><u><b>REKAM MEDIS</b></u></h3>     
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-4">No Registrasi</label>
                                        <div class="col-md-8 col-8">
                                            <p>: <?php echo $rekam_medis->id_registrasi ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-4">Tanggal Konsultasi</label>
                                        <div class="col-md-8 col-8">
                                            <p>: <?php $tanggal_konsul = $rekam_medis->tanggal_konsultasi ? (new DateTime($rekam_medis->tanggal_konsultasi))->format('d-m-Y H:i:s'):'-'; 
                                                echo $tanggal_konsul;
                                            ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-4">Dokter</label>
                                        <div class="col-md-8 col-8">
                                            <p>: <?php echo $rekam_medis->nama_dokter ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-4">Poli</label>
                                        <div class="col-md-8 col-8">
                                            <p>: <?php echo ucwords($rekam_medis->poli) ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <hr>
                                    <h4><i class="fa fa-user"></i> <b>Data Pasien</b></h4>
                                    <hr>
                                </div>
                                <div class="col-sm-12 col-12">
                                    <div class="form-group row">
                                        <label class="col-md-2 col-4">No Rekam Medis</label>
                                        <div class="col-md-8 col-8">
                                            <p>: <?php echo $rekam_medis->no_medrec ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-12">
                                    <div class="form-group row">
                                        <label class="col-md-2 col-4">Nama</label>
                                        <div class="col-md-8 col-8">
                                            <p>: <?php echo ucwords($rekam_medis->nama_pasien) ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="form-group row">
                                    <?php 
                                      $tanggal_lahir = new DateTime($rekam_medis->tanggal_lahir_pasien);
                                      $tanggal_lahir = $tanggal_lahir->format('d-m-Y');
                                    ?>
                                        <label class="col-md-4 col-4">Tempat / Tanggal Lahir</label>
                                        <div class="col-md-8 col-8">
                                            <p>: <?php echo ucwords($rekam_medis->tempat_lahir_pasien) ?>, <?php echo $tanggal_lahir ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-12">
                                    <div class="form-group row">
                                        <label class="col-md-2 col-4">Jenis Kelamin</label>
                                        <div class="col-md-8 col-8">
                                            <p>: <?php echo $rekam_medis->jk_pasien ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <hr>
                                    <h4><i class="fa fa-stethoscope"></i> <b>Pemeriksaan</b></h4>
                                    <hr>
                                </div>
                                <div class="col-sm-12 col-12">
                                    <div class="form-group row">
                                        <label class="col-md-2 col-4">Keluhan</label>
                                        <div class="col-md-8 col-8">
                                            <p>: <?php echo $rekam_medis->keluhan ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-12">
                                    <div class="form-group row">
                                        <label class="col-md-2 col-4">Diagnosa</label>
                                        <div class="col-md-6 col-6">
                                            <p>: <?php echo '('.$rekam_medis->diagnosis_code.') '.$rekam_medis->diagnosis ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label">Resep Obat </label>
                                        <div class="col-md-9 mt-2" style="margin-left: -15px">
                                            <ol><?php echo $rekam_medis->list_obat ?></ol>
                                        </div>
                                    </div>
                                </div>
                                <?php if($rekam_medis->order_status != null){ ?>
                                    <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-md-2 col-4">Order Status</label>
                                        <div class="col-md-8 col-8">
                                            <p>: <?php echo $rekam_medis->order_status == 1 ? 'DELIVERED':'PENDING' ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </form>
                            <div class="m-t-20 text-right">
                                <a href="<?php echo base_url('dokter/HistoryMedisPasien/index/all') ?>" type="button" class="btn btn-primary">Kembali <i class="fa fa-chevron-right"></i></a>
                            </div>
                    </div>
                </div>
                </div>
                </div>