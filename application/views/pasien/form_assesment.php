  <!-- Main content -->
  <div class="page-wrapper">
    <div class="content">
        <div class="row mb-3">
            <div class="col-sm-12 col-12 ">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('pasien/pasien');?>"class="text-black">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('pasien/Assesment/menu_assesment') ?>"class="text-black">Assesment</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href=""class="text-black font-bold-7">Isi Assesment</a></li>
                </ol>
            </nav>
            </div>
            <div class="col-sm-12 col-12">
                <p class="page-title font-16">Assesment</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= form_open('pasien/Assesment/update'); ?>
                    <?php $assesmentFor = isset($_GET['id_jadwal_konsultasi']) ? ucwords($jadwal_konsultasi->nama_dokter).' - '.strtoupper($jadwal_konsultasi->poli_dokter).' [ '.(new DateTime($jadwal_konsultasi->tanggal))->format('d-m-Y').' '.$jadwal_konsultasi->jam.' ]' : 'Semua Konsultasi' ?>
                    <p class="font-16 font-bold-4">Data Assesment Pasien</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="form-group form-focus-asses">
                                    <label class="focus-label">Berat Badan</label>
                                    <input type="number" class="form-control floating" name="berat_badan" <?php if($assesment){ echo 'value='.$assesment->berat_badan; } ?> placeholder="Isi Berat Badan Disini">
                                    <label class="focus-label-right">Kg</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="form-group form-focus-asses">
                                    <label class="focus-label">Tinggi Badan</label>
                                    <input type="number" class="form-control floating" name="tinggi_badan" <?php if($assesment){ echo 'value='.$assesment->tinggi_badan; } ?> placeholder="Isi Tinggi Badan Disini" >
                                    <label class="focus-label-right">Cm</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="form-group form-focus-asses">
                                    <label class="focus-label">Tekanan Darah</label>
                                    <input type="text" class="form-control floating"name="tekanan_darah" <?php if($assesment && !isset($assesment_old)){ echo 'value="'.$assesment->tekanan_darah.'"'; } ?> placeholder="Isi Tekanan Darah Disini" >
                                    <label class="focus-label-right">mmHg</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                              <div class="form-group form-focus-asses">
                                    <label class="focus-label">Suhu</label>
                                    <input type="text" class="form-control floating" name="suhu" <?php if($assesment && !isset($assesment_old)){ echo 'value="'.$assesment->suhu.'"'; } ?> placeholder="Isi Suhu Disini" >
                                    <label class="focus-label-right">Celcius</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <div class="form-group font-14">
                                    <label for="" class="text-abu col-form-label">Merokok</label><br>
                                    <label class="radio-inline">
                                        <input  type="radio" name="merokok" id="optionsRadiosInline1" value=1 <?php if($assesment){if($assesment->merokok == 1){echo "checked";}}?>> Ya
                                    </label><br>
                                    <label class="radio-inline">
                                        <input  type="radio" name="merokok" id="optionsRadiosInline2" value=0 <?php if($assesment){if($assesment->merokok == 0){echo "checked";}}?>> Tidak
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <div class="form-group font-14">
                                    <label for="" class="text-abu col-form-label">Minum Alkohol</label><br>
                                    <label class="radio-inline">
                                        <input  type="radio" name="alkohol" id="optionsRadiosInline1" value=1 <?php if($assesment){if($assesment->alkohol == 1){echo "checked";}} ?>> Ya
                                    </label><br>
                                    <label class="radio-inline">
                                        <input  type="radio" name="alkohol" id="optionsRadiosInline2" value=0 <?php if($assesment){if($assesment->alkohol == 0){echo "checked";}}  ?>> Tidak
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <div class="form-group font-14">
                                    <label for="" class="text-abu col-form-label">Kecelakaan</label><br>
                                    <label class="radio-inline">
                                        <input  type="radio" name="kecelakaan" id="optionsRadiosInline1" value=1 <?php if($assesment){if($assesment->kecelakaan == 1 ){ echo "checked";  }}?>> Pernah 
                                    </label><br>
                                    <label class="radio-inline">
                                        <input   type="radio" name="kecelakaan" id="optionsRadiosInline2" value=0 <?php if($assesment){if($assesment->kecelakaan == 0 ){ echo "checked"; }} ?>> Tidak Pernah
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <div class="form-group font-14">
                                    <label for="" class="text-abu col-form-label">Di Rawat</label><br>
                                    <label class="radio-inline">
                                        <input   type="radio" name="dirawat" id="optionsRadiosInline2" value=1 <?php if($assesment){if($assesment->dirawat == 1 ){echo "checked"; }}    ?>> Pernah
                                    </label><br>
                                    <label class="radio-inline">
                                        <input   type="radio" name="dirawat" id="optionsRadiosInline2" value=0 <?php if($assesment){if($assesment->dirawat == 0 ){echo "checked"; }}    ?>> Tidak Pernah
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <div class="form-group font-14">
                                    <label for="" class="text-abu col-form-label">Operasi</label><br>
                                    <label class="radio-inline">
                                        <input  type="radio" name="operasi" id="optionsRadiosInline1" value=1 <?php if($assesment){if($assesment->operasi == 1){echo "checked"; }}?>> Pernah 
                                    </label><br>
                                    <label class="radio-inline">
                                        <input   type="radio" name="operasi" id="optionsRadiosInline2" value=0 <?php if($assesment){if($assesment->operasi == 0){echo "checked";    }}?>> Tidak Pernah
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <div class="form-group font-14">
                                    <label for="" class="text-abu col-form-label">Riwayat Penyakit</label><br>
                                    <label class="radio-inline">
                                        <input  type="radio" name="select_rp" id="rp-1" value=1 <?php if($assesment){if($assesment->riwayat_penyakit){echo "checked"; }}?>> Ada 
                                    </label><br>
                                    <label class="radio-inline">
                                        <input   type="radio" name="select_rp" id="rp-0" value=0 <?php if($assesment){if(!$assesment->riwayat_penyakit){echo "checked";    }}?>> Tidak Ada
                                    </label>
                                    <input type="text" name="riwayat_penyakit" class="form-control" id="riwayat-penyakit" value="<?= $assesment ? ($assesment->riwayat_penyakit ? $assesment->riwayat_penyakit:''):'' ?>" placeholder="Riwayat Penyakit" <?= $assesment ? ($assesment->riwayat_penyakit ? 'required':'hidden'):'hidden' ?>>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <div class="form-group font-14">
                                    <label for="" class="text-abu col-form-label">Riwayat Alergi</label><br>
                                    <label class="radio-inline">
                                        <input type="radio" name="select_ra" id="ra-1" value=1 <?php if($assesment){if($assesment->riwayat_alergi){echo "checked"; }}?>> Ada 
                                    </label><br>
                                    <label class="radio-inline">
                                        <input type="radio" name="select_ra" id="ra-0" value=0 <?php if($assesment){if(!$assesment->riwayat_alergi){echo "checked";    }}?>> Tidak Ada
                                    </label>
                                    <input type="text" name="riwayat_alergi" class="form-control" value="<?= $assesment ? ($assesment->riwayat_alergi ? $assesment->riwayat_alergi:''):'' ?>" id="riwayat-alergi" placeholder="Riwayat Alergi" <?= $assesment ? ($assesment->riwayat_alergi ? 'required':'hidden'):'hidden' ?>>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-5">
                                <div class="form-group form-focus-asses">
                                    <label class="focus-label">Keluhan</label>
                                    <textarea rows="4" class="form-control floating" name="keluhan" required><?php if($assesment && !isset($assesment_old)){ echo $assesment->keluhan; } ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mt-2">
                                <button type="button" id="open-fpl-modal" data-toggle="modal" data-target="#fpl-modal" class="btn btn-block btn-outline-dark"><i class="fa fa-plus"></i> File Pemeriksaan ( Jika Ada )</button>
                            </div>
                        </div>
                        <?php 
                            if(isset($id_jadwal_konsultasi)){
                            echo "<input type='hidden' name='id_jadwal_konsultasi' value=".$id_jadwal_konsultasi.">";
                            }
                        ?>
                    </div>
                    <div class="row mt-5 pt-5">
                        <div class="col-md-12 ml-3">
                        <button class="btn btn-simpan mr-5" type="submit" id="btn-edit-pasien">Simpan</button>
                        <a href="<?php echo base_url('admin/Pasien') ?>" class="btn btn-batal">Batal</a>
                        </div>
                    </div>
                <?= form_close(); ?>
            </div>
            <div class="col-md-6">
                <p class="font-16">Data Dokter</p>
                <div class="row mx-auto">
                    <a href="#">
                        <div class="card-profile ml-3 my-2">
                            <div class="d-inline-flex">
                                <div class="doctor-img px-3 my-4">
                                    <div class="avatar"><img alt="" src="<?php echo $jadwal_konsultasi->foto_dokter ? base_url('assets/images/users/'.$jadwal_konsultasi->foto_dokter):base_url('assets/dashboard/img/user.jpg') ?>"></div>
                                </div>
                                <div class="p-2 ml-3 my-auto font-black">
                                    <span class="font-16"><?php echo ucwords($jadwal_konsultasi->nama_dokter);?></span>
                                    <div class="font-12">
                                        <span>STR : <?php echo $jadwal_konsultasi->str_dokter ?></span><br>
                                        <p><?php echo $jadwal_konsultasi->poli_dokter?></span><br>
                                        <span><?php echo (new DateTime($jadwal_konsultasi->tanggal))->format('d-m-Y');?> <?php echo $jadwal_konsultasi->jam ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>  

<!-- Modal -->
<div class="modal fade" id="fpl-modal" tabindex="-1" role="dialog" aria-labelledby="fpl-modal-label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="height: auto !important;">
      <div class="modal-header">
        <h5 class="modal-title" id="fpl-modal-label">File Pemeriksaan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-12" id="msg-fpl"></div>
        <form id="form-fpl">
            <div class="custom-file col-12">
                <input type="file" name="file_pemeriksaan_luar" class="custom-file-input"  id="fpl-upload" size="10024" accept="image/png,image/jpeg,image/jpg,image/png,image/jfif,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel,application/zip" style="width: 100% !important; height: 100% !important;" required>
                <label class="custom-file-label" for="customFile" id="filename">
                    Pilih file...
                </label>
                <input type="hidden" name="id_jadwal_konsultasi" value="<?= $id_jadwal_konsultasi ?>">
            </div>
            <button type="submit" class="btn btn-block bg-tele text-light col-12 mt-2">Upload <img id="loading-fpl" src="<?= base_url('assets/dashboard/img/loading.gif') ?>" width="15px" hidden></button>
        </form>
        <div class="dropdown-divider mt-4"></div>
        <table class="table table-striped">
            <thead>

            </thead>
            <tbody id="tbody-fpl">
                <?php foreach($file_pemeriksaan_luar as $fpl){ ?>
                    <tr>
                        <td><a href="<?= base_url('assets/files/file_pemeriksaan_luar/'.$fpl->file) ?>" target="_blank" class="text-dark font-16"><i class="fa fa-paperclip"></i> <?= $fpl->file ?></a></td>
                        <td width="5%"><button type="button" class="btn btn-block btn-danger" onclick="return delete_fpl(this);" data-id-fpl="<?= $fpl->id ?>"><i class="fa fa-trash"></i></button></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary mr-4" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>


    <?php if($this->session->flashdata('msg')){ echo "<script>alert('".$this->session->flashdata('msg')."')</script>"; } ?>
    <style>
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