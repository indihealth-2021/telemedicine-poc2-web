
    <!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3 px-3">
          <div class="col-sm-12 col-12 ">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('admin/admin');?>" class="text-black">Dashboard</a></li>
                    <li class="breadcrumb-item font-bold-7" aria-current="page"><a href="<?php echo base_url('admin/Invoice/invoice_diagnosa_terbanyak') ?>" class="text-black">Diagnosa Terbanyak</a></li>
                </ol>
            </nav>
          </div>
          <div class="col-sm-12 col-12">
              <h3 class="page-title">Diagnosa Terbanyak</h3>
          </div>
      </div>
      <form method="GET" class="font-14">
            <div class="row mb-3 px-3">
                <div class="col-sm-6">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="filterby" id="filterby1" value="1" <?php echo isset($_GET['filterby']) ? ($_GET['filterby'] == "1" ? 'checked':''):'checked' ?>>
                        <label class="form-check-label" for="filterby1">Filter berdasarkan Poli</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="filterby" id="filterby2" value="2" <?php echo isset($_GET['filterby']) ? ($_GET['filterby'] == "2" ? 'checked':''):'' ?>>
                        <label class="form-check-label" for="filterby2">Filter berdasarkan Dokter</label>
                    </div>
                </div>
            </div>
            <div class="row px-3">
                <div class="col-sm-12 input-poli">
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Pilih Filter</label>
                        <div class="col-sm-3">
                          <select class="form-control" name="poli">
                            <option value=''>Pilih Poli</option>
                            <?php foreach ($list_poli as $poli) { ?>
                                <option value="<?php echo $poli->id ?>" <?php echo isset($_GET['poli']) ? ($_GET['poli'] == $poli->id ? 'selected':''):'' ?>><?php echo $poli->poli ?></option>
                            <?php } ?>
                        </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 input-dokter">
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Pilih Filter</label>
                        <div class="col-sm-3">
                          <select class="form-control" name="dokter">
                            <option value=''>Pilih Dokter</option>
                            <?php foreach ($list_dokter as $dokter) { ?>
                                <option value='<?php echo $dokter->id_dokter ?>' <?php echo isset($_GET['dokter']) ? ($_GET['dokter'] == $dokter->id_dokter ? 'selected':''):'' ?>><?php echo $dokter->nama_dokter ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row px-3">
                <div class="col-sm-12">
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Tanggal Input</label>
                        <div class="col-sm-2">
                          <div class="cal-icon">
                            <input class="form-control datetimepicker" type="text" name="from" value="<?php echo $this->input->get('from') ? $this->input->get('from') : ''; ?>">
                            </div>
                        </div>
                        <label class="col-sm-1 col-form-label">Sampai</label>
                        <div class="col-sm-2">
                          <div class="cal-icon">
                            <input class="form-control datetimepicker" type="text" name="to" value="<?php echo $this->input->get('to') ? $this->input->get('to') : ''; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row pt-5 mx-1">
                <div class="col-sm-6">
                    <div class="form-group">
                        <button class="btn btn-tele form-control">Tampilkan</button>
                    </div>
                </div>
                <div class="col-sm-6 text-right">
                    <div class="form-group">
                        <div class="dropdown">
                            <button class="btn btn-tele  dropdown-toggle form-control" type="button" data-toggle="dropdown"><i class="fa fa-download fa-md"></i> Save As
                                <span class="caret"></span></button>
                            <ul class="dropdown-menu bg-blue">
                                <?php
                                $from = isset($_GET['from']) ? (!empty(trim($_GET['from'])) ? $_GET['from']:'' ):'';
                                $to = isset($_GET['to']) ? (!empty(trim($_GET['to'])) ? $_GET['to']:'' ):'';
                                $poli = isset($_GET['poli']) ? (!empty(trim($_GET['poli'])) ? $_GET['poli']:'' ):'';
                                $dokter = isset($_GET['dokter']) ? (!empty(trim($_GET['dokter'])) ? $_GET['dokter']:'' ):'';
                                ?>
                                <li class="dropdown-item"><a class="btn btn-default btn-block" href="<?php echo base_url('admin/Invoice/export_to_pdf_diagnosa_terbanyak/?from='.$from.'&to='.$to.'&poli='.$poli.'&dokter=' . $dokter) ?>">PDF</a></li>
                                <li class="dropdown-item"><a class="btn btn-default btn-block" href="<?php echo base_url('admin/Invoice/export_to_excel_diagnosa_terbanyak/?from='.$from.'&to='.$to.'&poli='.$poli.'&dokter=' . $dokter); ?>">Excel</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="row">
          <div class="col-md-12">
            <!-- <ul class="nav nav-tabs nav-tabs-bottom">
                <li class="nav-item"><a class="nav-link active" href="" data-toggle="tab">Poli</a></li>
            </ul> -->
            <div class="">
              <div class="tab-pane show">
                <div class="col-md-12">
                  <div class="table-responsive pt-0">
                    <table class="table table-border table-hover custom-table mb-0" id="table_diagnosa">
                      <thead class="text-tr">
                        <tr class="text-center">
                            <th class="text-left">No</th>
                            <th>Kode Diagnosa</th>
                            <th>Deskripsi</th>
                            <th>Jumlah</th>
                        </tr>
                      </thead>
                      <tbody class="font-14">
                        <?php $total_diagnosa = 0; ?>
                            <?php foreach ($list_diagnosa as $idx => $diagnosa) { ?>
                                <tr>
                                    <td><?php echo $idx + 1 ?></td>
                                    <td class="text-center"><?php echo $diagnosa->id ?></td>
                                    <td><?php echo $diagnosa->nama ?></td>
                                    <td class="text-center"><?php echo $diagnosa->jumlah_diagnosa ?></td>
                                    <?php $total_diagnosa+=$diagnosa->jumlah_diagnosa ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <!-- <span class="bg-primary text-white"><b>Total Diagnosa: </b><?php echo $total_diagnosa ?></span> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
              <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        </div>
        <script>
var filterby = "<?php echo isset($_GET['filterby']) ? $_GET['filterby']:'' ?>";
</script>

<?php echo $this->session->flashdata('msg_export_invoice') ? '<script>alert("' . $this->session->flashdata('msg_export_invoice') . '");</script>' : ''; ?>
