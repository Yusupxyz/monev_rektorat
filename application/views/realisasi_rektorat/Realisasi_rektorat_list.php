<div class="row">
<div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Input Laporan Capaian & Realisasi</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Refresh">
              <i class="fa fa-refresh"></i></button>
          </div>
      </div>

      <div class="box-body">
        <div class="row" style="margin-bottom: 10px">
        <div class=" col-xs-12 col-md-6">
              <p class="text-right bg-success">Tahun</p>
              <p class="text-right bg-success">Unit</p>
              <p class="text-right bg-success">Kegiatan</p>
              <p class="text-right bg-success">Output</p>
              <p class="text-right bg-success">Volume</p>
            </div>
            <div class=" col-xs-12 col-md-6">
              <p class="text-left"><b><?= $tahun ?></p>
              <p class="text-left"><?= '['. $unit->nama .'] '.$unit->deskripsi?></p>
              <?php if($kegiatan->jenis_kegiatan=='3'){ ?>
                <p class="text-left"><?= '['. $kegiatan->kode_awal .'] '.$kegiatan->ket_awal?></p>
              <?php }elseif($kegiatan->jenis_kegiatan=='4'){ ?>
                <p class="text-left"><?= '['. $kegiatan->kode_kegiatan .'] '.$kegiatan->ket_kegiatan?></p>
              <?php } ?>
              <p class="text-left"><?= '['. $kegiatan->output_kode .'] '.$kegiatan->output_ket?></p>
              <p class="text-left"><?= $kegiatan->volume_kegiatan .' '.$kegiatan->satuan_kegiatan?></b></p>
            </div>
            <div class="col-md-4">
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right"><form action="<?php echo site_url('realisasi/index'); ?>" class="form-inline" method="get" style="margin-top:10px">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('realisasi'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-striped text-center" style="margin-bottom: 10px" style="width:100px;">
            <tr>
		<th>Bulan</th>
		<th>Rencana Capaian (%)</th>
		<th>Ukuran Keberhasilan</th>
		<th>Realisasi Capaian Fisik (%)</th>
		<th>Realisasi Jumlah (Rp)</th>
		<th>Uraian Hasil</th>
		<th>Kendala</th>
		<th>Keterangan</th>
        <?php if ($group_id=='4'){ ?>
		    <th>Action</th>
        <?php } ?>
            </tr><?php
            $i=0;
            foreach ($realisasi_data as $realisasi)
            {
                ?>
            <tr>
            <form id="form" method="post" action="<?= site_url('realisasi_rektorat/update_action/'.$realisasi->id_realisasi);?>" >
                <td><input readonly  class="form-control" style="width: 90px"  value="<?php echo $realisasi->bulan ?>"></td>
                <input name="id_subkomponen" hidden value="<?php echo $realisasi->id_subkomponen ?>">
                <td><input readonly id="rencana_capaian<?= $i ?>" name="rencana_capaian" class="form-control" style="width: 60px" value="<?php echo $realisasi->rencana_capaian ?>"></td>
                <td><textarea readonly id="ukuran_keberhasilan<?= $i ?>" name="ukuran_keberhasilan" class="form-control" rows="3" style="width: 190px" ><?php echo $realisasi->ukuran_keberhasilan ?></textarea></td>
                <td><input readonly id="realisasi_capaian<?= $i ?>" name="realisasi_capaian" class="form-control" style="width: 60px" value="<?php echo $realisasi->realisasi_capaian ?>"></td>
                <td><input readonly id="realisasi_jumlah<?= $i ?>" name="realisasi_jumlah" class="form-control" style="width: 160px" value="<?php echo $realisasi->realisasi_jumlah ?>"></td>
                <td><textarea readonly id="uraian_hasil<?= $i ?>" name="uraian_hasil" class="form-control" rows="3" style="width: 190px" ><?php echo $realisasi->uraian_hasil ?></textarea></td>
                <td><textarea readonly id="kendala<?= $i ?>" name="kendala" class="form-control" rows="3" style="width: 190px" ><?php echo $realisasi->kendala ?></textarea></td>
                <td><textarea readonly id="keterangan<?= $i ?>" name="keterangan" class="form-control" rows="3" style="width: 170px" ><?php echo $realisasi->keterangan ?></textarea></td>
                <td style="text-align:center" width="100px">
                    <button class="btn btn-success" type="submit" onclick="cek()" id="submit"><i class="fa fa-save"></i> Simpan</button>
            </form>
			</td>
		</tr>
                <?php
            $i++;}
            ?>
        </table>
         <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-12">
                <a href="#" class="btn bg-yellow">Total Record : <?php echo $total_rows ?></a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    </div>
    </div>
  </div>
</div>