
    <!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-12 col-12 ">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('pasien/pasien');?>"class="text-black">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('pasien/Pendaftaran?poli=&hari=all') ?>"class="text-black font-bold-7">Pendaftaran</a></li>
                </ol>
            </nav>
          </div>
          <div class="col-sm-12 col-12">
              <h3 class="page-title">Pendaftaran</h3>
          </div>
      </div>
            <div class="row">
                <div class="col-sm-12 col-12" style="float: right">

                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="bg-tab p-3">

                        <div class="row mb-3">
                            <div class="col-md-3 mx-3">
                                <div class="box">
                                  <div class="container-1 ">
                                      <span class="icon"><i class="fa fa-search font-16"></i></span>
                                      <input type="search" id="search" placeholder="Cari Dokter Disini" />
                                  </div>
                                </div>
                            </div>

                            <form method="GET" action=""></form>
                            <div class="col-md-3">
                                <select class="form-control form-control-select" name="hari" id="hari" onchange="hari_onchange();">
                                <?php $hari = $this->input->get('hari') ?>
                                <option value="all" <?php echo $hari == 'all' ? 'selected' : '' ?>>Semua Hari</option>
                                <option value="Senin" <?php echo $hari == 'Senin' ? 'selected' : '' ?>>Senin</option>
                                <option value="Selasa" <?php echo $hari == 'Selasa' ? 'selected' : '' ?>>Selasa</option>
                                <option value="Rabu" <?php echo $hari == 'Rabu' ? 'selected' : '' ?>>Rabu</option>
                                <option value="Kamis" <?php echo $hari == 'Kamis' ? 'selected' : '' ?>>Kamis</option>
                                <option value="Jum'at" <?php echo $hari == "Jum'at" ? 'selected' : '' ?>>Jum'at</option>
                                <option value="Sabtu" <?php echo $hari == "Sabtu" ? 'selected' : '' ?>>Sabtu</option>
                            </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control form-control-select" id="poli" name="poli" onchange="poli_onchange();">
                                <option value="" <?php $s = $this->input->get('poli') ? 'selected' : '';
                                                                echo $s; ?>>Semua Poli</option>
                                <?php
                                foreach ($data_poli as $poli) {
                                    $s = $this->input->get('poli') == $poli->poli ? 'selected' : '';
                                    echo "<option value='" . $poli->poli . "'" . $s . ">" . $poli->poli . "</option>";
                                }
                                ?>
                            </select>
                            </div>
                        </div>

                        <!-- <table cellspacing="5" cellpadding="5" border="0">
                        <tbody>
                            <form method="GET" action="https://telemedicinelintasdev.indihealth.com/pasien/Pendaftaran"></form>
                            <tr>
                                <td>
                                    <select class="form-control form-control-sm" name="hari" id="hari" onchange="hari_onchange();">
                                        <?php $hari = $this->input->get('hari') ?>
                                        <option>Pilih Hari</option>
                                        <option value="all" <?php echo $hari == 'all' ? 'selected' : '' ?>>Semua Hari</option>
                                        <option value="Senin" <?php echo $hari == 'Senin' ? 'selected' : '' ?>>Senin</option>
                                        <option value="Selasa" <?php echo $hari == 'Selasa' ? 'selected' : '' ?>>Selasa</option>
                                        <option value="Rabu" <?php echo $hari == 'Rabu' ? 'selected' : '' ?>>Rabu</option>
                                        <option value="Kamis" <?php echo $hari == 'Kamis' ? 'selected' : '' ?>>Kamis</option>
                                        <option value="Jum'at" <?php echo $hari == "Jum'at" ? 'selected' : '' ?>>Jum'at</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control form-control-sm" id="poli" name="poli" onchange="poli_onchange();">
                                        <option>Pilih Poli</option>
                                        <option value="" <?php $s = $this->input->get('poli') ? 'selected' : '';
                                                            echo $s; ?>>Semua</option>
                                        <?php
                                        foreach ($data_poli as $poli) {
                                            $s = $this->input->get('poli') == $poli->poli ? 'selected' : '';
                                            echo "<option value='" . $poli->poli . "'" . $s . ">" . $poli->poli . "</option>";
                                        }
                                        ?>
                                    </select>
                                </td>

                                <td>
                            <a href="https://telemedicinelintasdev.indihealth.com/pasien/JadwalTerdaftar" class="btn btn-sm btn-primary">Cek Jadwal Terdaftar</a>
                        </td>

                            </tr>
                        </tbody>
                    </table> -->
                        <div class="table-responsive">
                        <table class="table table-border table-hover custom-table mb-0" id="table_pendaftaran">
                            <thead class="text-tr">
                                <tr>
                                    <th class="text-left">No</th>
                                    <th>Dokter</th>
                                    <th>Poli</th>
                                    <th>Nominal</th>
                                    <th>Hari</th>
                                    <th>Waktu</th>
                                    <th>Tanggal</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="font-14">
                                <?php
                                if (count($list_jadwal_dokter) > 0) {
                                    foreach ($list_jadwal_dokter as $idx => $jadwal_dokter) {
                                        $foto = $jadwal_dokter['foto_dokter'] ? base_url('assets/images/users/'.$jadwal_dokter['foto_dokter']):base_url('assets/dashboard/img/user.jpg');
                                        $button = "<td class='text-center'><button class='btn btn-pilih' data-toggle='modal' data-target='#tac_modal' data-id-jadwal='" . $jadwal_dokter['id'] . "'>Pilih</button></td>";
                                        $nominal = $this->db->query('SELECT harga FROM nominal WHERE poli = "' . $jadwal_dokter["poli"] . '"')->row();
                                        echo "<tr>";
                                        echo "<td>" . ($idx + 1) . "</td>";
                                        echo "<td><img width='34' height='34' src=" . $foto . " class='rounded-circle m-r-5' alt=''><div class='ml-5' style='margin-top:-30px'>" . ucwords($jadwal_dokter['nama_dokter']) . "</div></td>";
                                        echo "<td>" . $jadwal_dokter["poli"] . "</td>";
                                        echo "<td>" . 'Rp ' . number_format($nominal->harga, 2, ',', '.') . "</td>";
                                        echo "<td>" . ucwords($jadwal_dokter['hari']) . "</td>";
                                        echo "<td>" . $jadwal_dokter['waktu'] . "</td>";
                                        $jadwal_dokter['tanggal'] = $jadwal_dokter['tanggal'] ? (new DateTime($jadwal_dokter['tanggal']))->format('d-m-Y') : 'Jadwal Rutin';
                                        echo "<td>" . $jadwal_dokter['tanggal'] . "</td>";
                                        echo $button;
                                        echo "</tr>";
                                    }
                                }
                                ?>
                                <!-- <tr>
                                        <td>1</td>
                                        <td><img width="28" height="28" src="<?php echo base_url('assets/dashboard/img/user.jpg'); ?>" class="rounded-circle m-r-5" alt="">Dokter</td>
                                        <td>ANAK</td>
                                        <td>Rp. 100.000,00</td>
                                        <td>Senin</td>
                                        <td>10:00 AM - 7:00 PM</td>
                                        <td>09-11-2020</td>
                                        <td class="text-center"><a href="" type="button" class="btn btn-primary btn-sm"><i class="fa fa-check-circle"></i> Pilih</a></td>
                                    </tr> -->
                            </tbody>
                        </table>
                    </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="modal fade" id="tac_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable" role="document" style="max-width: 800px;">
            <div class="modal-content" style="height: 500px; width: 800px;">
              <div class="modal-header text-modal-header">
                <h5 class="modal-title font-16" id="exampleModalScrollableTitle">SYARAT DAN KETENTUAN PENGGUNAAN</h5>
                <button stype="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span  aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="font-16 text-justify" style="overflow-y: scroll; max-height: 300px; padding: 5px;" id="tac_body">
                  <h5 class="text-center">
                    <b>PERSETUJUAN UMUM UNTUK PENERIMA PELAYANAN KESEHATAN<br/>
                    LAYANAN TELEMEDICINE<br/>
                    RS JIWA DR. RADJIMAN WEDIODININGRAT LAWANG</b>
                  </h5>
                  <ol>
                    <li>HAK DAN KEWAJIBAN PASIEN (UU No. 44 Tahun 2009 tentang Rumah Sakit Pasal 32)</li>
                        <ol type="a">
                          <li>Memperoleh informasi mengenai tata tertib dan peraturan yang berlaku di Rumah Sakit</li>
                          <li>Mendapatkan informasi tentang hak dan kewajiban pasien</li>
                          <li>Memperoleh layanan yang manusiawi, adil, jujur dan tanpa diskriminasi</li>
                          <li>Memperoleh layanan kesehatan yang bermutu sesuai dengan standar profesi dan standar prosedur operasional</li>
                          <li>Memperoleh layanan yang efektif dan efisien sehingga pasien terhindar dari kerugian fisik dan materi</li>
                          <li>Mengajukan pengaduan atas kualitas pelayanan yang didapatkan</li>
                          <li>Memilih dokter dan kelas perawatan sesuai dengan keinginannya dan peraturan yang berlaku di Rumah Sakit</li>
                          <li>Meminta konsultasi tentang penyakit yang dideritanya kepada dokter lain yang mempunyai surat ijin praktek (SIP) baik di dalam maupun di luar Rumah Sakit</li>
                          <li>Mendapat privasi dan kerahasiaan penyakit yang diderita termasuk data - data medisnya</li>
                          <li>Mendapat informasi yang meliputi diagnosis dan tata cara tindakan medis, tujuan tindakan medis, alternatif tindakan, risiko dan komplikasi yang mungkin terjadi dan prognosis terhadap tindakan yang dilakukan serta perkiraan biaya pengobatan</li>
                          <li>Memperikan persetujuan atau menolak atas tindakan yang akan dilakukan oleh tenaga kesehatan terhadap penyakit yang dideritanya</li>
                          <li>Didampingi keluarganya dalam keadaan kritis</li>
                          <li>Menjalankan ibadah sesuai dengan agama/kepercayaan yang dianutnya selama hal itu tidak mengganggu pasien lainnya</li>
                          <li>Memperoleh keamanan dan keselamatan dirinya selama dalam perawatan di Rumah Sakit</li>
                          <li>Mengajukan usul, saran, perbaikan atas perilaku Rumah Sakit terhadap dirinya</li>
                          <li>Menolak pelayanan bimbingan rohani yang tidak sesuai dengan agama dan kepercayaan yang dianutnya</li>
                          <li>Menggugat / menuntut Rumah Sakit apabila Rumah Sakit diduga memberikan pelayanan yang tidak sesuai dengan standar baik secara perdata maupun pidana</li>
                          <li>Mengeluhkan pelayanan Rumah Sakit yang tidak sesuai dengan standar pelayanan melalui media cetak dan elektronik sesuai dengan ketentuan</li>
                        </ol>
                    <li>KEWAJIBAN PASIEN (UU No. 29 Tahun 2004 Tentang praktik kedokteran Pasal 53)</li>
                        <ol type="a">
                          <li>Memberikan informasi yang lengkap dan jujur tentang masalah kesehatannya</li>
                          <li>Mematuhi nasihat dan petunjuk dokter atau dokter gigi.</li>
                          <li>Mematuhi ketentuan yang berlaku di sarana pelayanan kesehatan.</li>
                          <li>Memberi imbalan atas pelayanan yang diterima.</li>
                        </ol>
                    <li>Jenis layanan ini adalah:</li>
                        <ul>
                          <li>Pendaftaran online untuk telekonsultasi dengan psikiater/psikolog RS Jiwa Dr Radjiman Wediodiningrat Lawang (pemberi layanan);</li>
                          <li>Video call dan Chat dengan pemberi layanan;</li>
                          <li>Pemberian resep dan pengiriman obat dengan radius 10km dari RS Jiwa Dr Radjiman Wediodiningrat Lawang (tidak termasuk golongan benzodiazepine);</li>
                          <li>Pembayaran layanan secara online;</li>
                          <li>Layanan lain yang dapat kami tambahkan dari waktu ke waktu.</li>
                        </ul>
                    <li>Informasi mengenai data pribadi dan riwayat kesehatan anda tersimpan di dalam database milik RS. Kerahasiaan data Anda terjamin dan akan digunakan oleh Rumah Sakit untuk keperluan interaksi dengan dokter dan/atau keperluan pemesanan obat serta layanan lainnya (termasuk untuk kepentingan pendidikan dan penelitian, sepanjang tidak menyebut identitas pasien, kecuali pada penelitian yang memerlukan persetujuan pasien secara langsung dengan peneliti) sesuai dengan peraturan perundang-undangan yang berlaku.</li>
                    <li>Anda menyadari bahwa platform ini hanya bertujuan untuk layanan kesehatan, tidak boleh disalahgunakan oleh pasien dan atau pihak lain dari pasien sebagai barang bukti atau bahan hukum dalam proses hukum yang dijalani.</li>
                    <li>Anda menyadari bahwa tidak diperbolehkan melakukan rekaman video atau mengambil foto (gambar) selama proses telemedicine berlangsung dari awal hingga akhir. </li>
                    <li>Ketentuan terkait layanan:</li>
                      <ol type="a">
                        <li>Fitur ini memfasilitasi para dokter, psikolog, dan/atau psikolog klinis yang terdaftar pada Rumah Sakit dan memiliki SIP, untuk berinteraksi dengan Anda melalui video call, voice call maupun chat yang dapat diakses melalui Aplikasi dan Website.</li>
                        <li>Durasi layanan terbagi menjadi 2 tipe, yaitu durasi 30 menit dan 60 menit untuk masing-masing konsultasi dengan dokter/psikiater maupun psikolog dengan tarif yang berbeda.   </li>
                        <li>Layanan ini digunakan untuk pelanggan dengan pembiayaan mandiri (non-penjaminan). Pembayaran layanan paling lambat dilakukan 3 jam setelah pendaftaran Anda diverifikasi oleh admin. Jika dalam waktu 3 jam tersebut Anda belum melakukan pembayaran layanan maka pendaftaran akan dibatalkan oleh admin kami. </li>
                        <li>Anda tidak dapat membatalkan booking Chat dengan dokter, psikolog, atau psikolog klinis Kami. Jika ingin membatalkan, anda dapat menolak panggilan dari dokter kami. Konsekuensi dari proses ini adalah tidak adanya pengembalian dana sesuai dengan prosedur yang berlaku.</li>
                        <li>Jika Anda tidak hadir pada jadwal booking yang telah Anda pilih maka Anda menyetujui bahwa dana yang telah Anda bayarkan tidak dapat dikembalikan, teknis pengaturan ulang jadwal dilakukan dengan komunikasi melalui admin kami WA. 08113430567.</li>
                        <li>Kami akan mengirimkan pemberitahuan terkait janji Chat dengan Dokter melalui push notification pada perangkat elektronik Anda. Untuk dapat menerima push notification yang Kami kirimkan maka Anda harus mengaktifkan push notification tersebut. </li>
                        <li>Anda mengetahui dan menyetujui bahwa fitur ini tidak menggantikan pemeriksaan dan pengobatan dengan dokter pada umumnya atau tatap muka secara langsung. </li>
                        <li>Pemberian resep dan pengiriman obat hanya dapat dilayani pada radius 10km dari RS Jiwa Dr Radjiman Wediodiningrat Lawang (tidak termasuk golongan benzodiazepine);</li>
                        <li>Kami tidak menyarankan Anda menggunakan aplikasi ini untuk kondisi medis darurat.</li>
                        <li>Anda memahami bahwa Anda perlu memberikan informasi dan menjelaskan gejala atau keluhan fisik yang Anda alami secara lengkap, jelas dan akurat ketika melakukan percakapan dengan dokter rekanan Kami melalui fitur Chat dengan Dokter.</li>
                      </ol>
                  </ul>
                  <div class="mt-4">
                    <b>Dengan ini saya menyatakan bahwa saya telah menerima dan memahami informasi sebagaimana mestinya dan menyetujuinya. </b>
                  </div>
                </div>
                <hr>
                <input type="checkbox" value="" id="tac_checkbox" disabled> <label for="tac_checkbox"><b class="ml-3">Saya menyetujui syarat dan ketentuan penggunaan</b></label>
              </div>
              <div class="modal-footer">
                <div style="float: right!important;">
                  <a class="daftar-button"><button type="button" class="btn btn-simpan-sm mr-5" id="simpan_tac" disabled>Daftar</button></a>
                </div>
              </div>
            </div>
          </div>
        </div>

    <?php if ($this->session->flashdata('msg')) {
        echo "<script>alert('" . $this->session->flashdata('msg') . "')</script>";
    } ?>
    <?php echo $this->session->flashdata('msg_2') ? $this->session->flashdata('msg_2') : ''; ?>
    <?php if ($this->session->flashdata('msg_pmbyrn')) {
        echo "<script>alert('" . $this->session->flashdata('msg_pmbyrn') . "')</script>";
    } ?>

    <script>
        function poli_onchange() {
            location.href = "<?php echo base_url() ?>pasien/Pendaftaran?poli=" + document.getElementById('poli').value + "&hari=" + document.getElementById('hari').value;
        }

        function hari_onchange() {
            location.href = "<?php echo base_url() ?>pasien/Pendaftaran?poli=" + document.getElementById('poli').value + "&hari=" + document.getElementById('hari').value;
        }
    </script>
