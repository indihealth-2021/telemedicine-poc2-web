<!DOCTYPE html>
<html>
    <head>
        <title>Telemedicine | Home - Sign in</title>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSS only -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminLTE/plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/telemedicine/css/home.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/telemedicine/css/bootstrap.min.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/telemedicine/css/bootstrap.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/telemedicine/css/popupstyle.css'); ?>">
        <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
        <style>
* {
  box-sizing: border-box;
}

#myInput {
  background-image: url('/css/searchicon.png');
  background-position: 10px 12px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}

#myUL {
  list-style-type: none;
  padding: 0;
  margin: 0;
}


</style>
    </head>
    <body>
        <nav class=" nav navbar navbar-expand-lg navbar-light bg-light">
              <div class="container-fluid">
                <div class="navbar-header">
                  <a class=" nav navbar-brand" href="<?php echo base_url('Home');?>"> 
                  <img src="<?php echo base_url('assets/telemedicine/img/logo.png')?>" width="140" height="70">
                </a>  
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse nav navbar-default navbar-right" id="navbarTogglerDemo02">
                  <!-- <ul class="nav navbar-default navbar-right" style="padding-left: 100px">
                    <li class="nav-link">
                      <a href="<?php //echo base_url('Home');?>" style="text-decoration: none"><button type="button" class="btn btn-default navbar-btn"><i class="glyphicon glyphicon-user "></i>Home</button></a>
                    </li>
                    <li class="nav-link">
                      <a href="<?php //echo base_url('News');?>" style="text-decoration: none"><button type="button" class="btn btn-default navbar-btn"><i class="glyphicon glyphicon-user "></i>News</button></a>
                    </li>
                </ul> -->
              <form action="<?php echo base_url('login');?>" method="GET" >
              <ul class="nav navbar-default navbar-right" style="padding-left: 161px;">
                    <li class="nav-link " >
                      <a class="menu-landing" href="<?php echo base_url('Home');?>">
                      <?php if ($menu_landing == 1) {?>
                      <button type="button" class="btn btn-default navbar-btn active">Beranda</button></a>
                      <?php }else{ ?>
                      <button type="button" class="btn btn-default navbar-btn">Beranda</button></a>
                      <?php } ?>
                    </li>
                    <li class="nav-link ">
                      <a class="menu-landing" href="<?php echo base_url('News');?>">
                      <?php if ($menu_landing == 2) {?>
                      <button type="button" class="btn btn-default navbar-btn active">Berita</button>
                      <?php }else{ ?>
                      <button type="button" class="btn btn-default navbar-btn">Berita</button>
                      <?php } ?>
                      </a>
                    </li>
                    <li class="nav-link">
                    <a class="menu-landing"  href="<?php echo base_url('register');?>">
                    <?php if ($menu_landing == 3) {?>
                    <button type="button" class="btn btn-default navbar-btn active">Daftar</button>
                    <?php }else{ ?>
                    <button type="button" class="btn btn-default navbar-btn">Daftar</button>
                    <?php } ?></a>
                    </li>
                    <li class="nav-link">
                    <a class="menu-landing" href="<?php echo base_url('Login');?>">
                    <?php if ($menu_landing == 4) {?>
                    <button type="button" class="btn btn-default navbar-btn active">Masuk</button>
                    <?php }else{ ?>
                    <button type="button" class="btn btn-default navbar-btn">Masuk</button>
                    <?php } ?></a>
                    </li>
                    <li class="nav-link">
                    <select style="text-decoration: none; cursor: pointer;" class="form-control">
                      <option>Indonesia</option>
                        <option>English</option>
                    </select>
                    </li>
                     
               </ul>                  
               </form>
              </div>
            </div>
          </nav>


    <!--end-slide-->
    <!--content-->
    <div class="container">
    <div class="row mt-4">
      <div class="col-lg-5 col-md-5 col-sm-12 offset-lg-7 offset-md-7 offset-sm-0">
        <div class="row">
	  <div class="col-8">
	       <form method="post" action="<?php echo base_url('News/search_result');?>">
            <input class="form-group" type="text" id="myInput" name="news" placeholder="Search for names.." title="Type in a name">
          </div>
          <div class="col-4" style="padding-bottom: 12px">
            <button type="submit" class="btn btn-success btn-block h-100" style="font-weight: bold;" id="btn-search">CARI</button>
          </div>
	         </form>
        </div>
      </div>
    </div>
    <ul id="myUL">
    <?php foreach($news as $berita){ ?>
    <li><hr>
      <div class="row row-news m-2 mb-4" style="padding: 10px;">
            <div class="col-lg-3 col-md-3 col-sm-12 my-auto" style="padding: 0px; width: 100%; height: 180px">
              <img class="img-news" src="<?php echo base_url('assets/images/news/'.$berita->foto);?>" style="width: 100%; object-fit: cover; height: 190px">
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 mt-2 col-text-news">
              <a href="<?php echo base_url('news/detail_news/'.$berita->id) ?>"><h4 style="font-weight: bold; padding-top:5px"><?php echo $berita->judul; ?></h4></a>
              <p><?php echo substr($berita->berita,3,150); ?>...</p>
              <!-- <a href="#" style=""><p class="title-news" style="font-size: 24px">Title Berita alam waktu yang singkat. Hal ini dikarenakan, jika lebih lama mencuci tangan maka akan lebih banyak area ya</p></a> -->
              <!-- <textarea class="text-area-news" rows="6" style="width: 100%; overflow:hidden; resize: none; background-color: transparent; border:none;" readonly><?php echo $berita->berita; ?></textarea> -->
              <div class="text-right mt-2">
              <!-- <a href="<?php echo base_url('News/detail_berita/');?>"> Lihat Berita ></a> -->
            </div></div>
            <div class="col-12 text-right">
            </div>
          </div>
        
      </li>
        <?php } ?>
        </ul>
  <hr>
    </div>
    <!--end-content-->
    <!--footer-->
        <footer class="footer font-small pt-4" style="color: #fff; background-color: #2C94D2">
          <!-- Footer Elements -->
          <div class="container footer">
          <div class="col-lg-12">
            <div class="row">
              <div class="col-lg-4">
              <ul class="list-unstyled list-inline text-center py-2">
                <li class="list-inline-item mb-5">
                  <img src="<?php echo base_url('assets/telemedicine/img/picture_logo.png')?>" width="75%">
                </li>
                <li class="list-inline-item" >
                  <img src="<?php echo base_url('assets/telemedicine/img/logo.png')?>" width="40%">
                </li>
              </ul>
              </div>
            <div class="col-lg-4">
              <ul class="list-unstyled list-inline text-center py-3">
                <li class="list-inline-item">
                    <h3 class="mb-2"></h3>
                    <h3 class="mb-2"></h3>
                </li>
            </ul>
            
            </div>
            <div class="col-lg-4">
              <ul class="list-unstyled list-inline text-left py-2">  
              <li class="list-inline-item "><h5>Tentang Rumah Sakit</h5>
              </li>
              <li class="list-inline-item mb-1">
                Rumah sakit adalah institusi pelayanan kesehatan yang menyelenggarakan pelayanan kesehatan perorangan secara paripurna yang menyediakan pelayanan rawat inap, rawat jalan dan gawat darurat.
              </li>
              <li class="list-inline-item "><h5>Kontak Kami</h5></li>
              <li class="list-inline-item "><i class="fa fa-map-marker"> Stasiun Gambir, Lt 1 Pintu Utara</i></li>
              <li class="list-inline-item "><i class="fa fa-phone fa"> (021) 3890 2233</i><br></li>
              <li class="list-inline-item "><i class="fa-envelope-o"> Info@rumahsakit.id</i></li>
            </ul>  
            </div>
            <!-- Call to action -->
              <!-- Copyright -->
              <div class="col-lg-12">
                <div class="footer-copyright text-center py-5">
                <h7>� Copyright : 2020. Indihealth & Lintasarta. All Rights Reserved. </h7>
                </div>      
              </div>
          
          <!-- Copyright -->
          </div>
          </div>
          </div>
          <!-- Footer Elements -->
        </footer>
    <!--end footer-->
        <!-- JS, Popper.js, and jQuery -->
  <script>
        var base_url = "<?= base_url('') ?>";
  </script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script type="text/jscript" src="<?php echo base_url('assets/telemidicine/js/jquery.min.js'); ?>"></script>
        <script type="text/jscript" src="<?php echo base_url('assets/telemidicine/js/bootstrap.min.js'); ?>"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script>
        </script>
    </body>
</html>