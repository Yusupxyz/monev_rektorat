<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">List Kegiatan</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Refresh">
            <i class="fa fa-refresh"></i></button>
        </div>
      </div>

      <div class="box-body">

        <form id="myform" method="post" onsubmit="return false">

          <div class="row" style="margin-bottom: 10px">
            <div class="col-xs-12 col-md-6">
              <?php echo anchor(site_url('kegiatan/create'), '<i class="fa fa-plus"></i> Tambah Kegiatan', 'class="btn bg-purple"'); ?>
              <?php echo anchor(site_url('kegiatan/create_1'), '<i class="fa fa-plus"></i> Tambah Sub Kegiatan 1', 'class="btn bg-green"'); ?>
              <?php echo anchor(site_url('kegiatan/create_2'), '<i class="fa fa-plus"></i> Tambah Sub Kegiatan 2', 'class="btn bg-yellow"'); ?>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
              <div style="margin-top: 4px" id="message">

              </div>
            </div>
            <div class="col-xs-12 col-md-6 text-right">
              <?php echo anchor(site_url('kegiatan/excel'), '<i class="fa fa-file-excel"></i> Excel', 'class="btn btn-success"'); ?>

            </div>
          </div>
          <div class="table-responsive">
            <table id="dynamic-table" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="dynamic-table_info" width="100%">
                            <thead>
                                <tr role="row">
                                    <th class=""  aria-controls="dynamic-table" rowspan="2" colspan="1">Kode</th>
                                    <th style="width: 500px;" class=""  aria-controls="dynamic-table" rowspan="2" colspan="1">Kegiatan
                                    </th>
                                    <th  class=""  aria-controls="dynamic-table" rowspan="2" colspan="1">Vol
                                    </th>
                                    <th  class=""  aria-controls="dynamic-table" rowspan="2" colspan="1">Satuan
                                    </th>
                                    <th  class=""  aria-controls="dynamic-table" rowspan="2" colspan="1">Jumlah
                                    </th>
                                    <th class=""  aria-controls="dynamic-table" rowspan="1" colspan="4">Administrasi Pra Kegiatan
                                    </th>
                                    <th lass="center" aria-controls="dynamic-table" rowspan="2" colspan="1"> Realisasi Pelaksanaan Kegiatan 

                                    </th>
                                    <th class="center" aria-controls="dynamic-table" rowspan="2" colspan="1"  >
                                       Total Persentase 
                                    </th>
                                     <th cclass="center" aria-controls="dynamic-table" rowspan="2" colspan="1"> Evaluasi dan Pelaporan 

                                  </th> 
                                    <th class=" center sorting_disabled" rowspan="2" colspan="1" aria-label="">
                                         Keterangan 
                                    </th>
                                    <th class=" center sorting_disabled" rowspan="2" colspan="1" aria-label="">
                                         aksi 
                                    </th>
                                </tr>
                                <tr>
                                    <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="">
                                         Surat Menyurat 
                                    </th>

                                    <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="">
                                         Terbitnya Surat Tugas/ Surat Keputusan Tim 

                                    </th>

                                    <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="">
                                         Penyusunan Dokumen, Rapat Koordinasi, Konsultasi 

                                    </th>
                                    <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="">
                                          Penyiapan alat / kelengkapan kegiatan 
                                    </th>
                                        
                                </tr>
                            </thead>
                            <tbody>                            
                                <tr>
                                   
                                    <td colspan="15"></td>
                                </tr>
   
                                
                                    </tr>

                               
                                    <tr>
                                        <td>
                                        <span style="padding-right:100px;"></span>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td style="text-align: right"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                   
                                    <tr>
                                        <td colspan="6" style="text-align: right;"><b>Sub Total</b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>

                                        <td></td>
                                        <td></td>
                                        <td></td>


                                    </tr>
                            
                                </tbody>
                            </table>

          </div>
          <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> Hapus Data Terpilih</button>
        </form>

      </div>
    </div>
  </div>
</div>


  <div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">List Kegiatan</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Refresh">
            <i class="fa fa-refresh"></i></button>
        </div>
      </div>

      <div class="box-body">

        <form id="myform" method="post" onsubmit="return false">

          <div class="row" style="margin-bottom: 10px">
            <div class="col-xs-12 col-md-6">
              <?php echo anchor(site_url('kegiatan/create'), '<i class="fa fa-plus"></i> Tambah Kegiatan', 'class="btn bg-purple"'); ?>
              <?php echo anchor(site_url('kegiatan/create_1'), '<i class="fa fa-plus"></i> Tambah Sub Kegiatan 1', 'class="btn bg-green"'); ?>
              <?php echo anchor(site_url('kegiatan/create_2'), '<i class="fa fa-plus"></i> Tambah Sub Kegiatan 2', 'class="btn bg-yellow"'); ?>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
              <div style="margin-top: 4px" id="message">

              </div>
            </div>
            <div class="col-xs-12 col-md-6 text-right">
              <?php echo anchor(site_url('kegiatan/excel'), '<i class="fa fa-file-excel"></i> Excel', 'class="btn btn-success"'); ?>

            </div>
          </div>
          <div class="table-responsive">
            <table id="dynamic-table" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="dynamic-table_info" width="100%">
                            <thead>
                                <tr role="row">
                                    <th class=""  aria-controls="dynamic-table" rowspan="2" colspan="1">Kode</th>
                                    <th style="width: 500px;" class=""  aria-controls="dynamic-table" rowspan="2" colspan="1">Kegiatan
                                    </th>
                                    <th  class=""  aria-controls="dynamic-table" rowspan="2" colspan="1">Vol
                                    </th>
                                    <th  class=""  aria-controls="dynamic-table" rowspan="2" colspan="1">Satuan
                                    </th>
                                    <th  class=""  aria-controls="dynamic-table" rowspan="2" colspan="1">Jumlah
                                    </th>
                                    <th class=""  aria-controls="dynamic-table" rowspan="1" colspan="4">Administrasi Pra Kegiatan
                                    </th>
                                    <th lass="center" aria-controls="dynamic-table" rowspan="2" colspan="1"> Realisasi Pelaksanaan Kegiatan 

                                    </th>
                                    <th class="center" aria-controls="dynamic-table" rowspan="2" colspan="1"  >
                                       Total Persentase 
                                    </th>
                                     <th cclass="center" aria-controls="dynamic-table" rowspan="2" colspan="1"> Evaluasi dan Pelaporan 

                                  </th> 
                                    <th class=" center sorting_disabled" rowspan="2" colspan="1" aria-label="">
                                         Keterangan 
                                    </th>
                                    <th class=" center sorting_disabled" rowspan="2" colspan="1" aria-label="">
                                         aksi 
                                    </th>
                                </tr>
                                <tr>
                                    <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="">
                                         Surat Menyurat 
                                    </th>

                                    <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="">
                                         Terbitnya Surat Tugas/ Surat Keputusan Tim 

                                    </th>

                                    <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="">
                                         Penyusunan Dokumen, Rapat Koordinasi, Konsultasi 

                                    </th>
                                    <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="">
                                          Penyiapan alat / kelengkapan kegiatan 
                                    </th>
                                        
                                </tr>
                            </thead>
                            <tbody>                            
                                <tr>
                                   
                                    <td colspan="15"></td>
                                </tr>
   
                                
                                    </tr>

                               
                                    <tr>
                                        <td>
                                        <span style="padding-right:100px;"></span>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td style="text-align: right"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                   
                                    <tr>
                                        <td colspan="6" style="text-align: right;"><b>Sub Total</b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>

                                        <td></td>
                                        <td></td>
                                        <td></td>


                                    </tr>
                            
                                </tbody>
                            </table>
                            
          </div>
          <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> Hapus Data Terpilih</button>
        </form>

      </div>
    </div>
  </div>
</div>