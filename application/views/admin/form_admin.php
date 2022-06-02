
    <!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-12 col-12 ">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('admin/admin');?>"class="text-black">Dashboard</a></li>
                    <li class="breadcrumb-item " aria-current="page"><a href="<?php echo base_url('admin/admin/manage_admin') ?>" class="text-black">User Management</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('admin/Admin/form_admin') ?>" class="text-black font-bold-7">Tambah Admin</a></li>
                </ol>
            </nav>
          </div>
      </div> 
      <div class="row">
        <div class="col-lg-12">
          <?= form_open_multipart('admin/Admin/addAdmin', 'id="form-add-admin" onsubmit="return ubah();" autocomplete="off"'); ?>
            <p class="title-form">Akun</p>
            <div class="row">
              <div class="col-md-4">
                <?php $old = $this->session->flashdata('old_form'); $error = $this->session->flashdata('error'); ?>
                <div class="form-group form-focus">
                    <label class="focus-label">Username</label>
                    <input type="text" class="form-control floating" value="" name="username" id="username" <?php //echo $error != 'username' && $error != 'usernameAndEmail' ? 'value="'.$old['username'].'"' : '' ?> required placeholder="Masukan Username">
                </div>
              </div> 
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Email</label>
                    <input type="email" class="form-control floating" name="email" id="email" <?php //echo $error != 'email' && $error != 'usernameAndEmail' ? 'value="'.$old['email'].'"' : '' ?> required placeholder="Masukan Email">
                </div>
              </div> 
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Password</label>
                    <input type="password" class="form-control floating" value="" name="password" id="password" required placeholder="Masukan Password">
                </div>
              </div> 
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Konfirmasi Password</label>
                    <input type="password" class="form-control floating" name="confirmasipassword" id="confirmasipassword" required placeholder="Masukan Password">
                </div>
              </div> 
            </div>

            <p class="title-form">Tipe Admin</p>
            <div class="row">
              <div class="col-sm-12 font-14">
                <div class="form-group gender-select">
                  <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" value='2' name="id_user_level" id="id_user_level" required>Admin Farmasi
                    </label>
                  </div>
                  <div class="form-check-inline pl-2">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" value='1' name="id_user_level" id="id_user_level" required>Super Admin
                    </label>
                  </div>
                </div>
              </div>
            </div>

            <p class="title-form">Informasi Pribadi</p>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Nama Lengkap</label>
                    <input type="text" class="form-control floating" name="name" id="name" <?php echo isset($old) ? 'value="'.$old['name'].'"' : ''; ?> required placeholder="Masukan Nama Lengkap Disini">
                </div>
              </div> 
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Tempat Lahir</label>
                    <input type="text" class="form-control floating" name="lahir_tempat" id="lahir_tempat" <?php echo isset($old) ? 'value="'.$old['lahir_tempat'].'"' : ''; ?> required placeholder="Masukan Tempat Lahir Disini">
                </div>
              </div> 
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Tanggal Lahir</label>
                    <input type="date" class="form-control floating" name="lahir_tanggal" id="lahir_tanggal" <?php echo isset($old) ? 'value="'.$old['lahir_tanggal'].'"' : ''; ?> required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="row">
                  <div class="col-sm-12 font-14">
                    <label class="gen-label text-label-form">Jenis Kelamin :</label>
                    <div class="form-group gender-select">
                      <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="jenis_kelamin" class="form-check-input" value="Perempuan" <?php if($old){ echo strtolower($old['jenis_kelamin']) == 'perempuan' ? 'checked' : ''; } ?> required>
                                  Laki-laki
                        </label>
                      </div>
                      <div class="form-check-inline pl-5">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="jenis_kelamin" class="form-check-input" value="Perempuan" <?php if($old){ echo strtolower($old['jenis_kelamin']) == 'perempuan' ? 'checked' : ''; } ?> required>
                                  Perempuan
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Provinsi</label>
                      <select class="form-control floating" name="alamat_provinsi" id="provinsi">
                        <option>Pilih Provinsi</option>
                      </select>
                </div>
              </div> 
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Kabupaten/Kota</label>
                      <select class="form-control floating" name="alamat_kota" id="kotkab">
                        <option>Pilih Kab/Kota</option>
                      </select>
                </div>
              </div> 
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Kecamatan</label>
                      <select class="form-control floating" name="alamat_kecamatan" id="kecamatan">
                        <option>Pilih Kecamatan</option>
                      </select>
                </div>
              </div> 
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Kelurahan</label>
                      <select class="form-control floating" name="alamat_kelurahan" id="kelurahan">
                        <option>Pilih Kelurahan</option>
                      </select>
                </div>
              </div> 
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Kode Pos</label>
                    <input type="text" class="form-control floating" name="kode_pos" <?php echo isset($old) ? 'value="'.$old['kode_pos'].'"' : ''; ?> required placeholder="Masukan Kode Pos">
                </div>
              </div> 
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Alamat Jalan</label>
                    <input type="text" class="form-control floating" name="alamat_jalan" id="alamat_jalan" <?php echo isset($old) ? 'value="'.$old['alamat_jalan'].'"' : ''; ?> required placeholder="Masukan Alamat Jalan">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group form-focus">
                    <label class="focus-label">Nomor Telepon</label>
                    <input type="number" class="form-control floating" name="telp" id="telp" <?php echo isset($old) ? 'value="'.$old['telp'].'"' : ''; ?> required placeholder="Masukan Nomor Telepon">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <div class="profile-upload">
                    <div class="upload-img">
                      <img alt="" src="/assets/dashboard/img/user.jpg">
                    </div>
                    <div class="upload-input">
                      <input type="file" class="form-control" name="foto" id="foto" size="10024" accept=".gif,.jpg,.jpeg,.jfif,.png" required>
                    </div>
                  </div>
                </div>
              </div>  
            </div>
            <div class="row">
              <div class="col-sm-12 font-14">
                <label class="gen-label text-label-form">Status :</label>
                <div class="form-group gender-select">
                  <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="aktif" id="status" value=1 <?php if($old){ echo $old['aktif'] == 1 ? 'checked' : ''; } ?> required>Aktif
                    </label>
                  </div>
                  <div class="form-check-inline pl-2">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="aktif" id="status" value=0 <?php if($old){ echo $old['aktif'] == 0 ? 'checked' : ''; } ?> required>Non Aktif
                    </label>
                  </div>
                </div>
              </div>
            </div>

            <div class="row mt-5">
              <div class="mx-auto">
                <input type="number" class="form-control" name="id_user_kategori" id="id_user_kategori" value="5" hidden>
                <button class="btn btn-simpan" id="btn-add-admin">Simpan</button>
                <a href="<?php echo base_url('admin/admin/manage_admin') ?>"><button type="button" class="btn btn-batal ml-4"  id="btn-add-admin">Batal</button></a>
              </div>
            </div>
          <?= form_close(); ?>
        </div>
      </div> 

<script>
function ubah(){
  var password_baru = document.getElementById('password').value;
  var konfirmasi_password = document.getElementById('confirmasipassword').value;

  if(password_baru.length < 8){
    alert('Password minimal berisi 8 karakter!')
    // event.preventDefault();
    return false;
  }
  else{
    if(password_baru != konfirmasi_password){
      alert('Password dan Konfirmasi Password tidak sama!');
      // event.preventDefault();
      return false;
    }
    else{
      return true;
    }
  }
}
</script>

<?php echo $this->session->flashdata('msg_add_admin') ? "<script>alert('".$this->session->flashdata('msg_add_admin')."')</script>" : ''; ?>