
    <!-- Main content -->
<div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-12 col-12 ">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('admin/admin');?>" class="text-black">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('admin/PengaturanWeb') ?>" class="text-black font-bold-7">Pengaturan Web</a></li>
                </ol>
            </nav>
          </div>
          <div class="col-sm-12 col-12">
              <h3 class="page-title">Pengaturan Web</h3>
          </div>
          <div class="col-sm-12 col-12">
            <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <a class="nav-link "  style="font-size:18px !important; " aria-current="page" href="<?= base_url('admin/PengaturanWeb') ?>">Pengaturan Telemedicine</a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link active"  style="font-size:18px !important; " href="<?= base_url('admin/PengaturanWeb/umum') ?>">Pengaturan Umum</a>
                  </li>
                  <!-- <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                  </li> -->
                  </ul>
          </div>
      </div>
        <?= form_open_multipart('admin/PengaturanWeb/update', 'id="form_general_setting"'); ?>

  <div class="card">
    <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-6 col-sm-12 col-xs-12 col-6">

            <label>Nama Faskes</label>
            <input type="text" value="<?= $pengaturan->nama_faskes ?>"  required placeholder="cth: Rumah Sakit Sehat" class="form-control" name="nama_faskes">
            <hr>
          </div>


        </div>
        <div class="row">
          <div class="col-md-6 col-sm-12 col-xs-12 col-6">

            <label>Logo Aplikasi</label>
            <input type="file" class="form-control mb-2"  name="img_logo">
            <div style="width:150px; height:150px; background-image:url('<?= base_url('assets/logo/'.$pengaturan->logo)?>'); background-size:cover; background-position:center;"></div>
            <hr>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 col-sm-12 col-xs-12 col-6">

            <label>Email</label>
            <input type="email"  value="<?= $pengaturan->email ?>" class="form-control" placeholder="cth: info@domain.id" name="email">
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 col-sm-12 col-xs-12 col-6">

            <label>Telp</label>
            <input type="text"  value="<?= $pengaturan->phone ?>" placeholder="cth: (022) 123123" class="form-control" name="telp">
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 col-sm-12 col-xs-12 col-6">

            <label>Faks</label>
            <input type="text"  value="<?= $pengaturan->faks ?>"  placeholder="cth: (022) 456456" class="form-control" name="faks">
          </div>
        </div>

                <div class="row">
                  <div class="col-md-6 col-sm-12 col-xs-12 col-6">

                    <label>Alamat</label>
                    <textarea class="form-control"   placeholder="cth: Jl. M.H Thamrin" name="alamat"> <?= $pengaturan->address ?></textarea>
                  </div>
                </div>
      <div class="row">
        <div class="col-md-3 col-sm-12 col-xs-12 col-6">
          <hr>
        <button class="btn btn-success btn-block" type="submit">Simpan Perubahan</button>
        </div>
      </div>
  </div>
  </div>
</div>
</div>
<?= form_close(); ?>
<!-- /.col -->
</div>
<!-- /.row -->
</section>
<!-- /.content --><?php if ($this->session->flashdata('msg')) { ?>
    <script>
        Swal.fire({
        icon: 'success',
        text: '<?= $this->session->flashdata('msg') ?>'
      })
    </script>

<?php } ?>
