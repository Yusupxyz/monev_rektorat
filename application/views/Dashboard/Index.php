<!-- Default box -->
<div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fas fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Pagu</span>
              <span class="info-box-number">Rp <?= nominal($total_pagu); ?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
                  <span class="progress-description">
                    Total Rupiah
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-cubes"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Rencana Capaian</span>
              <span class="info-box-number"><?= $total_rencana_capaian; ?> %</span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
                  <span class="progress-description">
                    Total Persentase
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-cubes"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Realisasi Capaian Fisik</span>
              <span class="info-box-number"><?= $total_realisasi_capaian; ?> %</span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
                  <span class="progress-description">
                    Total Persentase
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $title ?></h3>
              <br><br>
              <div class="panel panel-default" style="display:inline-block;">
                <div class="panel-heading post-thumb">
                  Filter :
                </div>
                  <div class="panel-body post-body">
                      <label for="primary" class="btn btn-primary">Bulan <input type="checkbox" id="primary" class="badgebox"><span class="badge" onclick="myFunction()">&check;</span></label>
                      <!-- <label for="info" class="btn btn-info">Info <input type="checkbox" id="info" class="badgebox"><span class="badge">&check;</span></label>
                      <label for="success" class="btn btn-success">Success <input type="checkbox" id="success" class="badgebox"><span class="badge">&check;</span></label>
                      <label for="warning" class="btn btn-warning">Warning <input type="checkbox" id="warning" class="badgebox"><span class="badge">&check;</span></label>
                      <label for="danger" class="btn btn-danger">Danger <input type="checkbox" id="danger" class="badgebox"><span class="badge">&check;</span></label> -->
                  </div>
              </div>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
            </div>

            <div class="box-body" style="min-height: 150px">
              <div class="chart">
                <canvas id="barChart" style="height:270px"></canvas>
              </div>
            </div>
            <div style="padding-left: 10px;">
            <div class="panel panel-default" style="display:inline-block;">
                <div class="panel-heading post-thumb">
                  Keterangan Komponen:
                </div>
                  <div class="panel-body post-body" id="keterangan" >
                  </div>
              </div>
              </div>
            <!-- /.box-body -->
            <div class="box-footer">
            </div>
            <!-- /.box-footer-->
          </div>
          <!-- /.box -->
        </div>
        
        </div>
      </div>  

