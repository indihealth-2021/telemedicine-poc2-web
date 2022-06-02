<?php
$list_harga_obat = explode(',', $resep->harga_obat);
$list_harga_obat_per_n_unit = explode(',', $resep->harga_obat_per_n_unit);
$list_jumlah_obat = explode(',', $resep->jumlah_obat);
$jml_data = count($list_harga_obat);
$list_total_harga = [];
$total_harga = 0;
for ($i = 0; $i < $jml_data; $i++) {
  $list_total_harga[$i] = ($list_jumlah_obat[$i] / $list_harga_obat_per_n_unit[$i]) * $list_harga_obat[$i];
}

foreach ($list_total_harga as $tot_harga) {
  $total_harga += $tot_harga;
}
?>
<!-- Main content -->
<div class="page-wrapper">
  <div class="content">
    <div class="row mb-3">
      <div class="col-sm-12 col-12 ">
        <nav aria-label="">
          <ol class="breadcrumb" style="background-color: transparent;">
            <li class="breadcrumb-item active"><a href="<?php echo base_url('pasien/pasien'); ?>" class="text-black">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('pasien/ResepDokter') ?>" class="text-black">Resep Obat</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="" class="text-black font-bold-7">Pembayaran Obat</a></li>
          </ol>
        </nav>
      </div>
      <div class="col-sm-12 col-12">
        <h3 class="page-title">Pembayaran Obat</h3>
      </div>
    </div>
    <?php
    //if ($registrasi->id_status_pembayaran == 0) {
    ?>
    <div class="row">
      <div class="col-md-12">
        <div class="" style="background: #01A9AC;">
          <div class="row font-18 text-white pl-5">
            <label for="staticEmail" class="col-sm-2 col-6 col-form-label">Nama Pasien :</label>
            <div class="col-sm-10 col-6" style="margin-left: -45px;">
              <input type="text" readonly class="form-control-plaintext font-18 text-white" name="fullName" value="<?php echo $user->name ?>">
            </div>
          </div>
        </div>
        <div style="background: #DEDEDE;border: 1px solid #DEDEDE; height: auto;">
          <div class="profile-bayar p-4">
            <div class="profile-img-bayar">
              <div class="profile-img mx-auto">
                <img class="avatar" src="<?php echo $resep->foto_dokter ? base_url('assets/images/users/' . $resep->foto_dokter) : base_url('assets/telemedicine/img/default.png'); ?>" alt="">
              </div>
            </div>
            <div class="profile-basic">
              <div class="row">
                <div class="col-md-4 col-12">
                  <div class="">
                    <p class="font-18">Dokter</p>
                    <p class="font-24"><?php echo ucwords($resep->nama_dokter) ?></p>
                    <p class="font-18">Poli : <?php echo ucwords($resep->poli_dokter) ?></p>
                  </div>
                </div>
                <div class="col-md-3 col-12">
                  <div class="">
                    <p class="font-18 text-abu">Tanggal Konsultasi</p>
                    <?php
                    $tanggal_konsul = $resep->tanggal_konsultasi ? (new DateTime($resep->tanggal_konsultasi)) : '-';
                    ?>
                    <span class="font-18"><?php echo $tanggal_konsul != '-' ? $tanggal_konsul->format('D, d/m/Y') : '-' ?></span>
                    <p class="font-18"><?php echo $tanggal_konsul != '-' ? $tanggal_konsul->format('H:i') . ' WIB' : '-'; ?></p>
                  </div>
                </div>
                <div class="col-md-5 col-12">
                  <div class="">
                    <p class="font-18 text-abu">No Registrasi</p>
                    <p class="font-18"><?php echo $resep->id_registrasi ?></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div style="background: #F4F8F9;border: 1px solid #DEDEDE;">

          <div class="d-mobile-none">
            <div class="text-center" style=" border-top: 3px solid #01A9AC;border-bottom: 0.5px solid #01A9AC;">
              <div class="row p-2 py-3">
                <div class="col-md-4">Harga Obat</div>
                <div class="col-md-4">Biaya Pengiriman</div>
                <div class="col-md-4">Total Biaya</div>
              </div>
            </div>
            <div class="text-center" style=" border-bottom: 0.5px solid #01A9AC;">
              <div class="row p-2 pt-3">
                <div class="col-md-4"><?php echo 'Rp. ' . number_format($total_harga, 2, ',', '.'); ?></div>
                <div class="col-md-4"><?php echo 'Rp. ' . number_format($resep->biaya_pengiriman, 2, ',', '.'); ?></div>
                <div class="col-md-4">
                  <p class="font-24 font-bold">
                    <?php echo 'Rp. ' . number_format($total_harga += $resep->biaya_pengiriman, 2, ',', '.'); ?>
                  </p>
                </div>
              </div>
            </div>
            <div class="text-center" style=" border-bottom: 3px solid #01A9AC;">
              <div class="row p-2 py-4">
                <div class="col-md-4"></div>
                <div class="col-md-4"></div>
                <div class="col-md-4"></div>
              </div>
            </div>
          </div>
          <div class="d-mobile-show">
            <div class="text-center" style=" border-top: 3px solid #01A9AC;border-bottom: 0.5px solid #01A9AC;">
              <div class="row p-2 py-3">
                <div class="col-md-4">Harga Obat</div>
                <div class="col-md-4"><?php echo 'Rp. ' . number_format($total_harga, 2, ',', '.'); ?></div>
                <div class="col-md-4"></div>
              </div>
            </div>
            <div class="text-center" style=" border-bottom: 0.5px solid #01A9AC;">
              <div class="row p-2 pt-3">
                <div class="col-md-4">Biaya Pengiriman</div>
                <div class="col-md-4"><?php echo 'Rp. ' . number_format($resep->biaya_pengiriman, 2, ',', '.'); ?></div>
                <div class="col-md-4"></div>
              </div>
            </div>
            <div class="text-center" style=" border-bottom: 3px solid #01A9AC;">
              <div class="row p-2 py-4">
                <div class="col-md-4">Total Biaya</div>
                <div class="col-md-4">
                  <p class="font-24 font-bold">
                    <?php echo 'Rp. ' . number_format($total_harga += $resep->biaya_pengiriman, 2, ',', '.'); ?>
                  </p>
                </div>
                <div class="col-md-4"></div>
              </div>
            </div>
          </div>

          <div class="d-mobile-none pl-3">
            <div class="col-md-12 pt-5 ml-3">
              <div class="row">
                <div class="col-md-11">
                  <div class="form-group row">
                    <label for="metode-pembayaran" class="col-md-3 col-3 mt-2 text-abu">Resep </label>
                    <div class="col-md-7 col-8">
                      <div class="row">
                        <span class="text-abu">:</Span><span class="" style="margin-top: -15px">&nbsp <?php echo $resep->detail_obat ?></span>

                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-11">
                  <div class="form-group row">
                    <label for="metode-pembayaran" class="col-md-3 col-3 mt-2 text-abu">Alamat Pengiriman </label>
                    <div class="col-md-7 col-8">
                      <div class="row">
                        <p class="text-abu">:&nbsp</p> <?php echo $resep->alamat_pengiriman; ?>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-11">
                  <div class="form-group row">
                    <label for="metode-pembayaran" class="col-md-3 col-5 mt-2 text-abu"><?php echo $bukti_pembayaran_obat ? 'Metode Pembayaran' : 'Pilih Metode Pembayaran' ?> </label>
                    <div class="col-md-7 col-7">
                      <div class="row">
                        <p class="text-abu mt-2">:&nbsp </p>
                        <?php if (!$bukti_pembayaran_obat) { ?>
                          <select class="form-control form-select-bayar  col-10" name="metode_pembayaran" id="metode-pembayaran">
                            <option value="0" selected>Pilih Metode</option>
                            <!-- <option value="1">Transfer Bank (Virtual Account)</option> -->
                            <option value="2">Transfer Bank (Upload Manual)</option>
                            <!-- <option value="3">Dompet Digital</option>
                            <option value="4">Owlexa</option> -->
                          </select>
                        <?php } else { ?>
                          <p class="mt-2"><?php echo $bukti_pembayaran_obat->metode_pembayaran == 1 ? 'Transfer' : ($bukti_pembayaran_obat->metode_pembayaran == 3 ? 'Virtual Account' : 'Owlexa'); ?></p>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
                <?php
                if ($bukti_pembayaran_obat) {
                ?>
                  <div class="col-md-11">
                    <div class="form-group row">
                      <label for="metode-pembayaran" class="col-md-3 col-3 mt-2 text-abu">Bukti Pembayaran / Claim Number / VA Num </label>
                      <div class="col-md-7 col-8">
                        <div class="row">
                          <p class="text-abu">:&nbsp</p> <?php echo $bukti_pembayaran_obat->metode_pembayaran == 1 ? '<img src="' . base_url('assets/images/bukti_pembayaran_obat/' . $bukti_pembayaran_obat->foto) . '" width="300px">' : ($bukti_pembayaran_obat->metode_pembayaran == 2 ? $bukti_pembayaran_obat->claim_number : $bukti_pembayaran_obat->va_number); ?>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>

          <div class="d-mobile-show">
            <div class="pl-2 pt-5">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group row">
                    <label for="metode-pembayaran" class="col-md-3 col-3 mt-2 text-abu">Resep </label>
                    <div class="col-md-8 col-9">
                      <div class="row">
                        <span class="text-abu">:</Span><span class="" style="margin-top: -35px">&nbsp <?php echo $resep->detail_obat ?></span>

                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group row">
                    <label for="metode-pembayaran" class="col-md-3 col-3 mt-2 text-abu">Alamat Pengiriman </label>
                    <div class="col-md-8 col-9">
                      <div class="row">
                        <p class="text-abu">:&nbsp</p> <?php echo $resep->alamat_pengiriman; ?>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group row">
                    <label for="metode-pembayaran" class="col-md-3 col-3 mt-2 text-abu">Pilih Metode Pembayaran </label>
                    <div class="col-md-9 col-9">
                      <div class="row">
                        <p class="text-abu mt-2">:&nbsp </p>
                        <?php if (!$bukti_pembayaran_obat) { ?>
                          <select class="form-control form-select-bayar  col-10" name="metode_pembayaran" id="metode-pembayaran">
                            <option value="0" selected>Pilih Metode</option>
                            <!-- <option value="1">Transfer Bank (Virtual Account)</option> -->
                            <option value="2">Transfer Bank (Upload Manual)</option>
                            <!-- <option value="3">Dompet Digital</option>
                            <option value="4">Owlexa</option> -->
                          </select>
                        <?php } else { ?>
                          <p class="mt-2"><?php echo $bukti_pembayaran_obat->metode_pembayaran == 1 ? 'Transfer' : ($bukti_pembayaran->metode_pembayaran == 3 ? 'Virtual Account' : 'Owlexa'); ?></p>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <?php
          if (!$bukti_pembayaran_obat) {
          ?>
            <?= form_open('pasien/ResepDokter/bayar_va/'. $id_jadwal_konsultasi, 'id="form-va"'); ?>
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
                          <!-- <div class="form-check mb-4">
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
                          </div> -->
                          <div class="form-check mb-4">
                            <input class="form-check-input" type="radio" name="bank_id" value="2">
                            <label class="form-check-label font-bank" style="margin-top: -20px">
                              <img src="<?php echo base_url('assets/dashboard/img/pngicon/mandiri.png'); ?>" class="img-bank">Bank Mandiri (Virtual Account)
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
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
                      <div class="form-check mb-4">
                        <input class="form-check-input" type="radio" name="bank_id_2" id="bank_22_2" value="22">
                        <label class="form-check-label font-bank" for="bank_22_2" style="margin-top: -20px">
                          <img src="<?php echo base_url('assets/dashboard/img/pngicon/permata.png'); ?>" class="img-permata">Bank Permata (Virtual Manual)
                        </label>
                      </div>
                      <div class="form-check mb-4">
                        <input class="form-check-input" type="radio" name="bank_id_2" id="bank_28_2" value="28">
                        <label class="form-check-label font-bank" for="bank_28_2" style="margin-top: -20px">
                          <img src="<?php echo base_url('assets/dashboard/img/pngicon/bni.png'); ?>" class="img-permata">Bank BNI (Virtual Account)
                        </label>
                      </div>
                      <div class="form-check mb-4">
                        <input class="form-check-input" type="radio" name="bank_id_2" id="bank_37_2" value="37">
                        <label class="form-check-label font-bank" for="bank_37_2" style="margin-top: -20px">
                          <img src="<?php echo base_url('assets/dashboard/img/pngicon/cimb.png'); ?>" class="img-permata">Bank CIMB (Virtual Account)
                        </label>
                      </div>
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

            <?= form_open('pasien/ResepDokter/bayar_owlexa/' . $id_jadwal_konsultasi, 'id="form-owlexa"'); ?>
              <div class="col-md-12">
                <div class="row">

                  <div class="col-sm-11 pl-3 metode-owlexa">
                    <div class="form-group row">
                      <label for="metode-pembayaran" class="col-md-3 col-4 text-abu">Nama Lengkap </label>
                      <div class="col-md-7 col-8">
                        <div class="row">
                          <p class="text-abu mt-2">:&nbsp </p>
                          <input type="text" class="form-control col-10" name="fullName" placeholder="Masukkan Nama Lengkap" value="<?php echo $user->name ?>" disabled readonly>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-11 pl-3 metode-owlexa">
                    <div class="form-group row">
                      <label for="metode-pembayaran" class="col-md-3 col-4 text-abu">Nomor Kartu </label>
                      <div class="col-md-7 col-8">
                        <div class="row">
                          <p class="text-abu mt-2">:&nbsp </p>
                          <input type="number" class="form-control col-10" name="cardNumber" placeholder="Masukkan Nomor Kartu" value="<?php //echo $old['cardNumber'] ? $cardNumber:'';
                                                                                                                                        ?>" required>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-11 pl-3 metode-owlexa">
                    <div class="form-group row">
                      <label for="metode-pembayaran" class="col-md-3 col-4 text-abu">Tanggal Lahir </label>
                      <div class="col-md-7 col-8">
                        <div class="row">
                          <p class="text-abu mt-2">:&nbsp </p>
                          <input type="date" class="form-control col-10" name="birthDate" placeholder="Masukkan Tanggal Lahir" value="<?php echo $user->lahir_tanggal; ?>" readonly disabled>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-11 pl-3 metode-owlexa">
                    <div class="form-group row">
                      <label for="metode-pembayaran" class="col-md-3 col-4 text-abu">OTP </label>
                      <div class="col-md-7 col-8">
                        <div class="row">
                          <p class="text-abu mt-2">:&nbsp </p>
                          <input type="number" class="form-control col-10" name="otp" placeholder="Masukkan OTP" aria-describedby="send_otp" required>
                          <a href="#" id="btnSendOtp" class="form-text font-14">
                            <span class="ml-2 fa fa-sign-in"> Send OTP</span>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <input type="hidden" name="chargeValue" value="<?php echo $total_harga; ?>;">

                </div>
              </div>
             <?= form_close(); ?>

          <?php } ?>

        </div>
        <div class="mt-3 float-right">
          <a href="<?php echo base_url('pasien/ResepDokter') ?>" class="btn btn-batal-sm">Kembali</a>
          <!-- <button class="ml-3 btn btn-simpan-sm" type="button" <?php echo !$bukti_pembayaran_obat ? 'id="btnKirim"' : ($bukti_pembayaran_obat->status == 0 ? 'id="btnKirim"' : '') ?>><?php echo !$bukti_pembayaran_obat ? 'Bayar' : ($bukti_pembayaran_obat->status == 0 ? 'Diproses' : 'Lunas') ?></button> -->
          <?php if (!$bukti_pembayaran_obat) { ?>
            <a href="#" class="ml-3 btn btn-simpan-sm" id="btnBayar" type="button">Bayar</a>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>




  <?php if ($this->session->flashdata('msg_pmbyrn_obat')) { ?>
    <script>
      alert("<?php echo $this->session->flashdata('msg_pmbyrn_obat'); ?>")
    </script>
  <?php } ?>


  <style>
    div span li {
      margin-left: 10px;
    }

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
