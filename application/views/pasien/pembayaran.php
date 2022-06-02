<?php
$biaya_konsultasi = $registrasi->biaya_konsultasi_bukti ? $registrasi->biaya_konsultasi_bukti : $registrasi->biaya_konsultasi_poli;
$biaya_adm = $registrasi->biaya_adm_bukti ? $registrasi->biaya_adm_bukti : ($registrasi->biaya_adm_poli ? $registrasi->biaya_adm_poli : $web->harga_adm);
$total_harga = $biaya_konsultasi + $biaya_adm;
?>
<!-- Main content -->
<div class="page-wrapper">
  <div class="content">
    <div class="row mb-3">
      <div class="col-sm-12 col-12 ">
        <nav aria-label="">
          <ol class="breadcrumb" style="background-color: transparent;">
            <li class="breadcrumb-item active"><a href="<?php echo base_url('pasien/pasien'); ?>" class="text-black">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('pasien/JadwalTerdaftar') ?>" class="text-black">Jadwal Terdaftar</a></li>
            <li class="breadcrumb-item font-bold-7" aria-current="page"><a href="" class="text-black">Pembayaran</a></li>
          </ol>
        </nav>
      </div>
      <div class="col-sm-12 col-12">
        <h3 class="page-title">Pembayaran</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">

        <div class="bg-tele">
          <div class="d-mobile-none">
            <div class="row font-18 text-white pl-5">
              <label for="staticEmail" class="col-sm-2 col-form-label">Nama Pasien :</label>
              <div class="col-sm-10" style="margin-left: -45px;">
                <input type="text" readonly class="form-control-plaintext font-18 text-white" name="fullName" placeholder="Masukkan Nama Lengkap" value="<?php echo $user->name ?>">
              </div>
            </div>
          </div>

          <div class="d-mobile-show">
            <div class="row font-14 text-white pl-2">
              <label for="staticEmail" class="col-sm-2 col-4 col-form-label">Nama Pasien </label>
              <div class="col-sm-10 col-8">
                <input type="text" readonly class="form-control-plaintext font-14 text-white" name="fullName" placeholder="Masukkan Nama Lengkap" value=": <?php echo $user->name ?>">
              </div>
            </div>
          </div>

          <div style="background: #FFFFFF;border: 1px solid #59A799; height: auto;">
            <div class="profile-bayar p-4">
              <div class="profile-img-bayar">
                <div class="profile-img">
                  <img class="avatar" src="<?php echo $registrasi->foto_dokter ? base_url('assets/images/users/' . $registrasi->foto_dokter) : base_url('assets/telemedicine/img/default.png'); ?>" alt="">
                </div>
              </div>
              <div class="profile-basic d-mobile-none">
                <div class="row">
                  <div class="col-md-4 col-12">
                    <div class="">
                      <p class="font-18">Dokter</p>
                      <p class="font-24"><?php echo $registrasi->nama_dokter; ?></p>
                      <p class="font-18">Poli : <?php echo $registrasi->poli; ?></p>
                    </div>
                  </div>
                  <div class="col-md-3 col-12">
                    <div class="">
                      <p class="font-18 text-abu">Tanggal Konsultasi</p>
                      <span class="font-18"><?php echo $tanggal_konsultasi; ?></span>
                      <p class="font-18"><?php echo $waktu_konsultasi ? $waktu_konsultasi . ' - ' . $waktu_konsultasi_berakhir . ' WIB' : ''; ?></p>
                    </div>
                  </div>
                  <div class="col-md-5 col-12">
                    <div class="">
                      <p class="font-18 text-abu">No Registrasi</p>
                      <p class="font-18"><?php echo $registrasi->registrasi_id ?></p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="profile-basic d-mobile-show">
                <div class="row">
                  <div class="col-md-4 col-12">
                    <div class="">
                      <p class="font-16">Dokter</p>
                      <p class="font-22"><?php echo $registrasi->nama_dokter; ?></p>
                      <p class="font-16">Poli : <?php echo $registrasi->poli; ?></p>
                    </div>
                  </div>
                  <div class="col-md-3 col-12">
                    <div class="">
                      <p class="font-16 text-abu">Tanggal Konsultasi</p>
                      <span class="font-16"><?php echo $tanggal_konsultasi; ?></span>
                      <p class="font-16"><?php echo $waktu_konsultasi ? $waktu_konsultasi . ' - ' . $waktu_konsultasi_berakhir . ' WIB' : ''; ?></p>
                    </div>
                  </div>
                  <div class="col-md-5 col-12">
                    <div class="">
                      <p class="font-16 text-abu">No Registrasi</p>
                      <p class="font-16"><?php echo $registrasi->registrasi_id ?></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12 mt-5">
        <div class="bg-tele" style="background: #FFFFFF;border: 1px solid #59A799;">
          <div class="d-mobile-none">
            <div class="text-center" style=" border-bottom: 0.5px solid #59A799; border-top: 1px solid #59A799">
              <div class="row p-2 pt-3">
                <div class="col-md-8 text-right text-abu">Biaya Konsultasi</div>
                <div class="col-md-3 text-right"><?php echo 'Rp. ' . number_format($biaya_konsultasi, 2, ',', '.'); ?></div>
              </div>
            </div>
            <div class="text-center" style=" border-bottom: 0.5px solid #59A799;">
              <div class="row p-2 pt-3">
                <div class="col-md-8 text-right text-abu">Biaya Administrasi</div>
                <div class="col-md-3 text-right"><?php echo 'Rp. ' . number_format($biaya_adm, 2, ',', '.'); ?></div>
              </div>
            </div>
            <div class="text-center" style=" border-bottom: 2px solid #59A799;">
              <div class="row p-2 pt-3">
                <div class="col-md-8 text-right text-abu">Total Biaya</div>
                <div class="col-md-3 text-right font-22"><?php echo 'Rp. ' . number_format($total_harga, 2, ',', '.'); ?></div>
              </div>
            </div>
            <!-- <div class="text-center" style=" border-top: 3px solid #59A799;border-bottom: 0.5px solid #59A799;">
                <div class="row p-2 py-3">
                  <div class="col-md-4">Biaya Konsultasi</div>
                  <div class="col-md-4">Biaya Administrasi</div>
                  <div class="col-md-4">Total Biaya</div>
                </div>
              </div>
              <div class="text-center" style=" border-bottom: 0.5px solid #59A799;">
                <div class="row p-2 pt-3">
                  <div class="col-md-4"></div>
                  <div class="col-md-4"></div>
                  <div class="col-md-4">
                    <p class="font-24 font-bold">

                    </p>
                  </div>
                </div>
              </div> -->
            <!-- <div class="text-center" style=" border-bottom: 3px solid #59A799;">
                <div class="row p-2 py-4">
                  <div class="col-md-4"></div>
                  <div class="col-md-4"></div>
                  <div class="col-md-4"></div>
                </div>
              </div> -->
          </div>
          <div class="d-mobile-show">
            <div class="text-center" style=" border-top: 3px solid #59A799;border-bottom: 0.5px solid #59A799;">
              <div class="row p-2 py-3">
                <div class="col-md-4">Biaya Konsultasi</div>
                <div class="col-md-4"><?php echo 'Rp. ' . number_format($biaya_konsultasi, 2, ',', '.'); ?></div>
                <div class="col-md-4"></div>
              </div>
            </div>
            <div class="text-center" style=" border-bottom: 0.5px solid #59A799;">
              <div class="row p-2 pt-3">
                <div class="col-md-4">Biaya Administrasi</div>
                <div class="col-md-4"><?php echo 'Rp. ' . number_format($biaya_adm, 2, ',', '.'); ?></div>
                <div class="col-md-4"></div>
              </div>
            </div>
            <div class="text-center" style=" border-bottom: 3px solid #59A799;">
              <div class="row p-2 py-4">
                <div class="col-md-4">Total Biaya</div>
                <div class="col-md-4">
                  <p class="font-24 font-bold">
                    <?php
                    echo 'Rp. ' . number_format($total_harga, 2, ',', '.'); ?>
                  </p>
                </div>
                <div class="col-md-4"></div>
              </div>
            </div>
          </div>
          <div class="pt-5">
            <div class="">
              <div class="d-mobile-none pl-3">
                <div class="col-md-11 ml-3">
                  <div class="form-group row">
                    <label for="metode-pembayaran" class="col-md-3  mt-2 <?php echo $registrasi->id_status_pembayaran == 0 ? 'text-abu' : 'text-dark'; ?>">Metode Pembayaran </label>
                    <div class="col-md-6">
                      <div class="row">
                        <p class="text-abu mt-2">:&nbsp&nbsp</p>
                        <?php if ($registrasi->id_status_pembayaran == 0) { ?>
                          <select class="form-control form-select-bayar col-10" name="metode_pembayaran" id="metode-pembayaran">
                            <option value="0" selected>Pilih Metode</option>
                            <!-- <option value="1">Transfer Bank (Virtual Account)</option> -->
                            <option value="2">Transfer Bank (Upload Manual)</option>
                            <!-- <option value="3">Dompet Digital</option>
                            <option value="4">Owlexa</option> -->
                          </select>
                        <?php } else { ?>
                          <p class="mt-2"><?php echo $bukti_pembayaran->metode_pembayaran == 1 ? 'Transfer' : ($bukti_pembayaran->metode_pembayaran == 3 ? 'Virtual Account' : 'Owlexa'); ?></p>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="d-mobile-show pl-2">
                <div class="col-md-9">
                  <div class="form-group row">
                    <label for="metode-pembayaran" class="col-md-4 col-4 mt-2 <?php echo $registrasi->id_status_pembayaran == 0 ? 'text-abu' : 'text-dark'; ?>">Metode Pembayaran </label>
                    <div class="col-md-8 col-8">
                      <div class="row">
                        <p class="text-abu mt-2">:&nbsp&nbsp</p>
                        <?php if ($registrasi->id_status_pembayaran == 0) { ?>
                          <select class="form-control form-select-bayar col-10" name="metode_pembayaran" id="metode-pembayaran">
                            <option value="0" selected>Pilih Metode</option>
                            <!-- <option value="1">Transfer Bank (Virtual Account)</option> -->
                            <option value="2">Transfer Bank (Upload Manual)</option>
                            <!-- <option value="3">Dompet Digital</option>
                            <option value="4">Owlexa</option> -->
                          </select>
                        <?php } else { ?>
                          <p class="mt-2"><?php echo $bukti_pembayaran->metode_pembayaran == 1 ? 'Transfer' : ($bukti_pembayaran->metode_pembayaran == 3 ? 'Virtual Account' : 'Owlexa'); ?></p>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row pl-5">
              <?php if ($registrasi->id_status_pembayaran != 0) { ?>
                <div class="col-md-11">
                  <div class="form-group row">
                    <label class="col-md-3 col-4 mt-2 text-dark">Status </label>
                    <div class="col-md-7 col-8">
                      <div class="row">
                        <p class="text-abu mt-2">:&nbsp&nbsp</p>
                        <p class="mt-2"><?php echo $registrasi->id_status_pembayaran == 1 ? 'Lunas' : 'Sedang Diproses'; ?></p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-11">
                  <div class="form-group row">
                    <label class="col-md-3 col-4 mt-2 text-dark">Bukti Pembayaran / Claim Number / VA Number</label>
                    <div class="col-md-7 col-8">
                      <div class="row">
                        <p class="text-abu mt-2">:&nbsp&nbsp</p>
                        <p class="mt-2"><?php echo $bukti_pembayaran->metode_pembayaran == 1 ? '<img src="' . base_url('assets/images/bukti_pembayaran/' . $bukti_pembayaran->photo) . '" width="300px">' : ($bukti_pembayaran->metode_pembayaran == 2 ? $bukti_pembayaran->claim_number : $bukti_pembayaran->va_number); ?></p>
                      </div>

                    </div>
                  </div>
                </div>
            </div>
          <?php } ?>
          <!-- <div class="col-md-5">
                    <span class="text-abu font-16" id="note-transfer-konsultasi">Note : Silahkan Tranfers ke rekening 234456655567 Bank BNI Syariah Atas Nama Rumah Sakit Sejahtera</span>
                    </div> -->
          </div>

          <?php
          if ($registrasi->id_status_pembayaran == 0) {
          ?>
          <?= form_open('pasien/Pembayaran/bayar_va', 'id="form-va"'); ?>
              <div class="row pl-5">
                <div class="col-md-11" id="transfer_va">
                  <div class="form-group row">
                    <label for="metode-pembayaran" class="col-md-3 col-4 mt-2 text-abu">Pilih Bank</label>
                    <div class="col-md-7 col-6">
                      <div class="row">
                        <p class="text-abu mt-2">:&nbsp</p>
                        <div class="pl-3 mt-2">
                          <!-- <div class="form-check radio mb-4">
                                    <input class="form-check-input" type="radio" name="bank_id" value="1">
                                    <label class="form-check-label font-bank" style="margin-top: -20px">
                                      <img src="<?php echo base_url('assets/dashboard/img/pngicon/bca.png'); ?>" class="img-bank"> Bank BCA (Virtual Account)
                                    </label>
                                  </div>
                                  <div class="form-check mb-4">
                                    <input class="form-check-input" type="radio" name="bank_id" value="2">
                                    <label class="form-check-label font-bank" style="margin-top: -20px">
                                      <img src="<?php echo base_url('assets/dashboard/img/pngicon/mandiri.png'); ?>" class="img-bank">Bank Mandiri (Virtual Account)
                                    </label>
                                  </div>
                                  <div class="form-check mb-4">
                                    <input class="form-check-input" type="radio" name="bank_id" value="3">
                                    <label class="form-check-label font-bank" style="margin-top: -20px">
                                      <img src="<?php echo base_url('assets/dashboard/img/pngicon/bni.png'); ?>" class="img-bank">Bank BNI (Virtual Account)
                                    </label>
                                  </div>
                                  <div class="form-check mb-4">
                                    <input class="form-check-input" type="radio" name="bank_id" value="4">
                                    <label class="form-check-label font-bank" style="margin-top: -20px">
                                      <img src="<?php echo base_url('assets/dashboard/img/pngicon/bri.png'); ?>" class="img-bank">Bank BRI (Virtual Account)
                                    </label>
                                  </div> -->
                          <div class="form-check mb-4">
                            <input class="form-check-input" type="radio" name="bank_id" id="bank_22" value="22">
                            <label class="form-check-label font-bank" for="bank_22" style="margin-top: -20px">
                              <img src="<?php echo base_url('assets/dashboard/img/pngicon/permata.png'); ?>" class="img-permata">Bank Permata (Virtual Account)
                            </label>
                          </div>
                          <div class="form-check mb-4">
                            <input class="form-check-input" type="radio" name="bank_id" id="bank_28" value="28">
                            <label class="form-check-label font-bank" for="bank_28" style="margin-top: -20px">
                              <img src="<?php echo base_url('assets/dashboard/img/pngicon/bni.png'); ?>" class="img-permata">Bank BNI (Virtual Account)
                            </label>
                          </div>
                          <div class="form-check mb-4">
                            <input class="form-check-input" type="radio" name="bank_id" id="bank_37" value="37">
                            <label class="form-check-label font-bank" for="bank_37" style="margin-top: -20px">
                              <img src="<?php echo base_url('assets/dashboard/img/pngicon/cimb.png'); ?>" class="img-permata">Bank CIMB (Virtual Account)
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="metode-pembayaran" class="col-md-3 col-4 mt-2 text-abu">
                      Alamat Pengiriman Obat
                    </label>
                    <div class="col-md-7 pr-3 ml-0 col-8">
                      <div class="row">
                        <span class="text-abu mt-2">:&nbsp </span>
                        <textarea name="alamat_2" class="form-control col-10" readonly required></textarea>
                        <span class="edit-form form-text text-muted ml-2">
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="alamat_kustom_2" id="inlineRadio1_2" value="0" checked required>
                            <label class="form-check-label font-14" for="inlineRadio1_2">Alamat Anda</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="alamat_kustom_2" id="inlineRadio2_2" value="1" required>
                            <label class="form-check-label font-14" for="inlineRadio2_2">Alamat Lain</label>
                          </div>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <input type="hidden" name="id_registrasi" value="<?php echo $registrasi->registrasi_id ?>">
             <?= form_close(); ?>
            <div class="col-md-11" id="transfer_manual">
              <div class="form-group row">
                <label for="metode-pembayaran" class="col-md-3 col-4 mt-2 text-abu">Pilih Bank</label>
                <div class="col-md-7 col-6">
                  <div class="row">
                    <p class="text-abu mt-2">:&nbsp</p>
                    <div class="pl-3 mt-2">
                      <!-- <div class="form-check radio mb-4">
                                    <input class="form-check-input" type="radio" name="bank_id_2" value="1">
                                    <label class="form-check-label font-bank" style="margin-top: -20px">
                                      <img src="<?php echo base_url('assets/dashboard/img/pngicon/bca.png'); ?>" class="img-bank"> Bank BCA (Upload Manual)
                                    </label>
                                  </div>
                                  <div class="form-check mb-4">
                                    <input class="form-check-input" type="radio" name="bank_id_2" value="2">
                                    <label class="form-check-label font-bank" style="margin-top: -20px">
                                      <img src="<?php echo base_url('assets/dashboard/img/pngicon/mandiri.png'); ?>" class="img-bank">Bank Mandiri (Upload Manual)
                                    </label>
                                  </div>
                                  <div class="form-check mb-4">
                                    <input class="form-check-input" type="radio" name="bank_id_2" value="3">
                                    <label class="form-check-label font-bank" style="margin-top: -20px">
                                      <img src="<?php echo base_url('assets/dashboard/img/pngicon/bni.png'); ?>" class="img-bank">Bank BNI (Upload Manual)
                                    </label>
                                  </div>
                                  <div class="form-check mb-4">
                                    <input class="form-check-input" type="radio" name="bank_id_2" value="4">
                                    <label class="form-check-label font-bank" style="margin-top: -20px">
                                      <img src="<?php echo base_url('assets/dashboard/img/pngicon/bri.png'); ?>" class="img-bank">Bank BRI (Upload Manual)
                                    </label>
                                  </div> -->
                      <!-- <div class="form-check mb-4">
                        <input class="form-check-input" type="radio" name="bank_id_2" id="bank_22_2" value="22">
                        <label class="form-check-label font-bank" for="bank_22_2" style="margin-top: -20px">
                          <img src="<?php echo base_url('assets/dashboard/img/pngicon/permata.png'); ?>" class="img-permata">Bank Permata (Upload Manual)
                        </label>
                      </div> -->
                      <div class="form-check mb-4">
                        <input class="form-check-input" type="radio" name="bank_id_2" id="mandiri" value="2">
                        <label class="form-check-label font-bank" for="mandiri"  style="margin-top: -20px">
                          <img src="<?php echo base_url('assets/dashboard/img/pngicon/mandiri.png'); ?>" class="img-bank">Bank Mandiri (Upload Manual)
                        </label>
                      </div>
                      <!-- <div class="form-check mb-4">
                        <input class="form-check-input" type="radio" name="bank_id_2" id="bank_37_2" value="37">
                        <label class="form-check-label font-bank" for="bank_37_2" style="margin-top: -20px">
                          <img src="<?php echo base_url('assets/dashboard/img/pngicon/cimb.png'); ?>" class="img-permata">Bank CIMB (Upload Manual)
                        </label>
                      </div> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-11" id="dompet_digital">
              <div class="form-group row">
                <label for="metode-pembayaran" class="col-md-3 col-4 mt-2 text-abu">Pilih Platform</label>
                <div class="col-md-7 col-6">
                  <div class="row">
                    <p class="text-abu mt-2">:&nbsp</p>
                    <div class="pl-3">
                      <div class="form-check mt-2 mb-4">
                        <input class="form-check-input" type="radio" name="platform" value="1">
                        <label class="form-check-label font-bank" style="margin-top: -20px">
                          <img src="<?php echo base_url('assets/dashboard/img/pngicon/imkas.png'); ?>" class="img-platform"> IMKas
                        </label>
                      </div>
                      <div class="form-check mb-4">
                        <input class="form-check-input" type="radio" name="platform" value="2">
                        <label class="form-check-label font-bank" style="margin-top: -20px">
                          <img src="<?php echo base_url('assets/dashboard/img/pngicon/gopay.png'); ?>" class="img-platform"> GoPay
                        </label>
                      </div>
                      <div class="form-check mb-4">
                        <input class="form-check-input" type="radio" name="platform" value="3">
                        <label class="form-check-label font-bank" style="margin-top: -20px">
                          <img src="<?php echo base_url('assets/dashboard/img/pngicon/ovo.png'); ?>" class="img-platform">OVO
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-11">
              <?= form_open('pasien/Pembayaran/bayar_owlexa', 'id="form-owlexa"'); ?>
                <div class="">
                  <div class="row">
                    <div class="metode-owlexa col-md-11">
                      <div class="form-group row">
                        <label for="metode-pembayaran" class="col-md-3 col-4 text-abu">Nama Lengkap </label>
                        <div class="col-md-7 col-8">
                          <div class="row">
                            <p class="text-abu mt-2 pl-3">:&nbsp </p>
                            <input type="text" class="form-control col-10" name="fullName" placeholder="Masukkan Nama Lengkap" value="<?php echo $user->name ?>">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="metode-owlexa col-md-11">
                      <div class="form-group row">
                        <label for="metode-pembayaran" class="col-md-3 col-4 text-abu">Nomor Kartu </label>
                        <div class="col-md-7 col-8">
                          <div class="row">
                            <p class="text-abu mt-2 pl-3">:&nbsp </p>
                            <input type="number" class="form-control col-10" name="cardNumber" placeholder="Masukkan Nomor Kartu">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="metode-owlexa col-md-11">
                      <div class="form-group row">
                        <label for="metode-pembayaran" class="col-md-3 col-4 text-abu">Tanggal Lahir </label>
                        <div class="col-md-7 col-8">
                          <div class="row">
                            <p class="text-abu mt-2 pl-3">:&nbsp </p>
                            <input type="date" class="form-control col-10" name="birthDate" placeholder="Masukkan Tanggal Lahir" value="<?php echo $user->lahir_tanggal; ?>" readonly disabled>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="metode-owlexa col-md-11">
                      <div class="form-group row">
                        <label for="metode-pembayaran" class="col-md-3 col-4 text-abu">OTP </label>
                        <div class="col-md-7 col-8">
                          <div class="row">
                            <p class="text-abu mt-2 pl-3">:&nbsp </p>
                            <input type="number" class="form-control col-10" name="otp" placeholder="Masukkan OTP" aria-describedby="send_otp">
                            <p class="col-md-6 ml-3"><a href="#" id="btnSendOtp" class="form-text font-14"> <i class="fa fa-sign-in"> Send OTP</i> </a></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="metode-owlexa col-md-11">
                      <div class="form-group row">
                        <label for="metode-pembayaran" class="col-md-3 col-4 mt-2 text-abu">
                          Alamat Pengiriman Obat
                        </label>
                        <div class="col-md-7 pr-3 ml-0 col-8">
                          <div class="row">
                            <span class="text-abu mt-2 pl-3">:&nbsp </span>
                            <textarea class="form-control col-10" name="alamat" readonly required></textarea>
                            <span class="edit-form form-text text-muted ml-3">
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="alamat_kustom" id="inlineRadio1" value="0" checked required>
                                <label class="form-check-label font-14" for="inlineRadio1">Alamat Anda</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="alamat_kustom" id="inlineRadio2" value="1" required>
                                <label class="form-check-label font-14" for="inlineRadio2">Alamat Lain</label>
                              </div>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <input type="hidden" name="id_dokter" value="<?php echo $registrasi->id_dokter; ?>">
                    <input type="hidden" name="id_registrasi" value="<?php echo $registrasi->registrasi_id; ?>">
                    <input type="hidden" name="chargeValue" value="<?php echo $total_harga; ?>">
                  </div>
                </div>
                <!-- <div class="d-mobile-show pl-2">
                                  <div class="row">
                                    <div class="metode-owlexa col-md-9">
                                          <div class="form-group row">
                                              <label for="metode-pembayaran" class="col-md-3 col-4 text-abu">Nama Lengkap </label>
                                              <div class="col-md-8 col-7">
                                                  <div class="row">
                                                    <p class="text-abu mt-2">:&nbsp </p>
                                                      <input type="text" class="form-control col-10" name="fullName" placeholder="Masukkan Nama Lengkap" value="<?php echo $user->name ?>">
                                                  </div>
                                              </div>
                                          </div>
                                    </div>
                                    <div class="metode-owlexa col-md-9">
                                      <div class="form-group row">
                                              <label for="metode-pembayaran" class="col-md-3 col-4 text-abu">Nomor Kartu </label>
                                              <div class="col-md-8 col-7">
                                                  <div class="row">
                                                    <p class="text-abu mt-2">:&nbsp </p>
                                                      <input type="number" class="form-control col-10" name="cardNumber" placeholder="Masukkan Nomor Kartu">
                                                  </div>
                                              </div>
                                      </div>
                                    </div>
                                    <div class="metode-owlexa col-md-9">
                                      <div class="form-group row">
                                              <label for="metode-pembayaran" class="col-md-3 col-4 text-abu">Tanggal Lahir </label>
                                              <div class="col-md-8 col-7">
                                                  <div class="row">
                                                    <p class="text-abu mt-2">:&nbsp </p>
                                                      <input type="date" class="form-control col-10" name="birthDate" placeholder="Masukkan Tanggal Lahir" value="<?php echo $user->lahir_tanggal; ?>" readonly disabled>
                                                  </div>
                                              </div>
                                          </div>
                                    </div>
                                    <div class="metode-owlexa col-md-9">
                                      <div class="form-group row">
                                              <label for="metode-pembayaran" class="col-md-3 col-4 text-abu">OTP </label>
                                              <div class="col-md-8 col-7">
                                                  <div class="row">
                                                    <p class="text-abu mt-2">:&nbsp </p>
                                                      <input type="number" class="form-control col-10" name="otp" placeholder="Masukkan OTP" aria-describedby="send_otp">
                                                    <a href="#" id="btnSendOtp" class="form-text font-14">
                                                        <span class="ml-2 fa fa-sign-in"> Send OTP</span>
                                                    </a>
                                                  </div>
                                              </div>
                                          </div>
                                    </div>

                                    <input type="hidden" name="id_dokter" value="<?php echo $registrasi->id_dokter; ?>">
                                    <input type="hidden" name="id_registrasi" value="<?php echo $registrasi->registrasi_id; ?>">
                                    <input type="hidden" name="chargeValue" value="<?php echo $total_harga; ?>">
                                  </div>
                                </div> -->
               <?= form_close(); ?>
            </div>
            <div class="col-md-12 mt-5">
              <div class="pb-5 pr-5 text-center" style="float: right!important;">
                <a href="<?php echo base_url('pasien/JadwalTerdaftar') ?>" class="btn btn-batal-sm">Kembali</a>
                <!-- <button class="ml-3 btn btn-simpan-sm" type="button" <?php echo $registrasi->id_status_pembayaran == 0 ? 'id="btnKirim"' : '' ?>><?php echo $registrasi->id_status_pembayaran == 0 ? 'Bayar' : ($registrasi->id_status_pembayaran == 1 ? 'Lunas' : 'Diproses') ?></button> -->
                <?php if ($registrasi->id_status_pembayaran == 0) { ?>
                  <a href="#" class="ml-3 btn btn-simpan-sm" id="btnBayar" type="button">Bayar</a>
                <?php } ?>
              </div>
            </div>
        </div>

      </div>
    <?php } ?>



    </div>
  </div>
</div>

</div>
</div>
</div>
</div>

<div class="modal fade" id="jawaban" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="width: 300px">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Panggilan...</h5>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button> -->
      </div>
      <div class="modal-body" align="center">
        <i class="fa fa-phone fa-5x" style="color: #007Bff;">....</i>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal" id="jawab" data-id-jadwal-konsultasi="" data-room-name="" data-id-dokter="">Jawab</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" id="tolak" data-id-dokter="">Tolak</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="tac_modal_owlexa" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document" style="max-width: 800px;">
    <div class="modal-content" style="height: auto; width: auto;">
      <div class="modal-header">
        <p class="modal-title font-20" id="exampleModalScrollableTitle">SYARAT DAN KETENTUAN PEMBAYARAN OWLEXA</p>
      </div>
      <div class="modal-body">
        <div class="font-16 text-justify" style="overflow-y: scroll; max-height: 300px; padding: 5px;" id="tac_body_owlexa">

        </div>
        <hr>
        <input type="checkbox" value="" id="tac_checkbox_owlexa" disabled> <label for="tac_checkbox_owlexa"><b class="ml-3">Saya menyetujui syarat dan ketentuan</b></label>
      </div>
      <div class="modal-footer">
        <div style="float: right!important;">
          <button type="button" class="btn btn-simpan-sm" id="simpan_tac_owlexa" disabled>Simpan</button>
          <button type="button" class="btn btn-batal-sm mr-5" id="batal_tac_owlexa" data-dismiss="#tac_modal_owlexa">Batal</button>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
  var alamat_anda = "<?php echo $user->nama_provinsi && $user->nama_kota && $user->nama_kelurahan && $user->nama_kecamatan && $user->alamat_jalan && $user->kode_pos ? 'Jalan ' . ucwords(strtolower($user->alamat_jalan)) . ', Kel ' . ucwords(strtolower($user->nama_kelurahan)) . ', Kec ' . ucwords(strtolower($user->nama_kecamatan)) . ', Kab/Kota ' . ucwords(strtolower($user->nama_kota)) . ', Kode Pos ' . $user->kode_pos . ', Provinsi ' . ucwords(strtolower($user->nama_provinsi)) : 'Jalan ' . ucwords(strtolower($user->alamat_jalan)) . ', Kel ' . ucwords(strtolower($user->nama_kelurahan)) . ', Kec ' . ucwords(strtolower($user->nama_kecamatan)) . ', Kab/Kota ' . ucwords(strtolower($user->nama_kota)) . ', Kode Pos ' . $user->kode_pos . ', Provinsi ' . ucwords(strtolower($user->nama_provinsi)) . ' (Alamat Tidak Lengkap)'; ?>";
  var alamat_lain = "";
  var id_dokter = <?php echo $registrasi->id_dokter; ?>;
  var id_registrasi = "<?php echo $registrasi->registrasi_id; ?>";
  var chargeValue = <?php $total_harga = $registrasi->biaya_konsultasi_poli + $web->harga_adm;
                    echo $total_harga; ?>;
</script>
<?php echo $this->session->flashdata('msg_pmbyrn_2') ? $this->session->flashdata('msg_pmbyrn_2') : ''; ?>
<?php if ($this->session->flashdata('msg_pmbyrn')) { ?>
  <script>
    alert("<?php echo $this->session->flashdata('msg_pmbyrn'); ?>")
  </script>
<?php } ?>
<style>
  .img-permata {
    width: 70px;
    margin-left: 1.5rem;
    margin-right: 1.5rem;
  }

  @media (max-width: 769px) {
    .pl-5 {
      padding-left: .5rem !important;
    }

    .img-permata {
      width: 60px;
      margin-left: .5rem;
      margin-right: .5rem;
    }
  }
</style>
