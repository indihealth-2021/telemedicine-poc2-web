 <!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-12 col-12 ">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('diampu/Diampu/list_pengampu') ?>"class="text-black">List Pengampu</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href=""class="text-black font-bold-7"><?php echo $title ?></a></li>
                </ol>
            </nav>
          </div>
          <div class="col-sm-12 col-12">
              <h3 class="page-title"><?php echo $title ?></h3>
          </div>
      </div>     
        <div class="row">
          <div class="col-md-12">
            <div class="bg-tab p-3">
                <!-- <div class="row p-4">
                    <div class="col-md-9"></div>
                    <div class="col-md-3">
                        <div class="box">
                            <div class="container-1 ">
                                <span class="icon"><i class="fa fa-search font-16"></i></span>
                                <input type="search" id="search" placeholder="Cari Pasien Disini" />
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="table-responsive font-14">
                <table class="table table-border table-hover custom-table mb-0" id="table_list_pengampu"">
                    <thead class="text-tr">
                    <tr class="text-center">
                        <th width="1%">No</th>
                        <th>Nama Rumah Sakit</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                       <?php foreach ($list_pengampu as $idx => $pengampu) { ?>
                            <tr>
                                <td><?php echo $idx + 1 ?></td>
                                <td><?php echo $pengampu->name ?></td>
                                <td><a href="<?php echo base_url('diampu/Telekonsultasi/proses_telekonsultasi/' . $pengampu->id) ?>" class="btn btn-mulai">Mulai</a></td>
                            </tr>
                        <?php } ?>
                     </tbody>
                </table>
            </div>
            </div>
                
        </div>
    
    </div>               

    </div>
    </div>

    