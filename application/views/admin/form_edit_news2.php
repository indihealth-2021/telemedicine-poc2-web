
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-md-12">
            <!-- /.card -->

            <div class="card">
              <div class="card-header col-lg-12 " style="background-color: #1F60A8; color: #fff">
              <div class="card-title">Edit Berita</div>
            </div>
              <!-- <form method="post" id="form-add-news"> -->
             <?php echo form_open_multipart('admin/News/update');  ?>
                                <div class="card-body">
                                      <div class="form-group">
                                      <div class="col-lg-12 mb-2">
                                        <label for="formGroupExampleInput" style="font-family: calibri"><b>Judul</b></label>
                                        <input type="text" class="form-control" name="judul" id="judul" value="<?php echo $data->judul;?>">
                                        <input type="text" class="form-control" name="id" id="id" value="<?php echo $data->id;?>" hidden>
                                      </div>
                                        <div class="form-group">
                                          <div class="col-lg-6">
                                          <label for="formGroupExampleInput" style="font-family: calibri"><b>Foto</b></label><br/>
                                          <img class="mb-3" src="<?php echo base_url('assets/images/news/').$data->foto ?>" style="max-width: 150px; height:auto;">
                                          <div class="custom-file">
                                          <input type="file" class="custom-file-input" name="foto" id="file_upload">
                                          <label class="custom-file-label" id="filename">Choose file</label>
                                          </div>
                                        </div>  
                                        </div>
                                      <div class="form-group">
                                        <div class="col-lg-12">
                                        <label for="formGroupExampleInput" style="font-family: calibri"><b>Berita</b></label>
                                      <textarea class="ckeditor" id="ckedtor" name="berita"><?php echo $data->berita;?></textarea>  
                                      </div>                                   
                                      </div>
                                      </div>
                                      </div>  
                                      <div class="col-lg-12">
                                        <div class="row mb-5 mt-2 justify-content-center">
                                          <div class="col-lg-4 mb-3">
                                            <button type="submit" class="btn btn-primary w-100" style="background-color: #1F60A8">UBAH</button>
                                          </div>
                                          <div class="col-lg-4">
                                            <a href="<?php echo base_url('admin/News');?>"><button type="button" style="background-color: #1F60A8" class="btn btn-primary w-100" id="form-close">BATAL</button></a>
                                          </div>
                                        </div>  
                                        </div>
                                    </div>       
                           <?php echo form_close();  ?>
                                </div>
                                </div>
                            </div>
                        </div>
              
            <!-- /.card -->

          </div>
          <!-- /.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
