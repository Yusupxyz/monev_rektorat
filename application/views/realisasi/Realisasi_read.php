<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Realisasi Detail</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
                    <i class="fa fa-minus"></i></button>
                     <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Collapse">
              <i class="fa fa-refresh"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
        <table class="table">
	    <tr><td>Id Bulan</td><td><?php echo $id_bulan; ?></td></tr>
	    <tr><td>Id Subkomponen</td><td><?php echo $id_subkomponen; ?></td></tr>
	    <tr><td>Rencana Capaian</td><td><?php echo $rencana_capaian; ?></td></tr>
	    <tr><td>Ukuran Keberhasilan</td><td><?php echo $ukuran_keberhasilan; ?></td></tr>
	    <tr><td>Realisasi Capaian</td><td><?php echo $realisasi_capaian; ?></td></tr>
	    <tr><td>Realisasi Jumlah</td><td><?php echo $realisasi_jumlah; ?></td></tr>
	    <tr><td>Uraian Hasil</td><td><?php echo $uraian_hasil; ?></td></tr>
	    <tr><td>Kendala</td><td><?php echo $kendala; ?></td></tr>
	    <tr><td>Keterangan</td><td><?php echo $keterangan; ?></td></tr>
	    <tr><td><a href="<?php echo site_url('realisasi') ?>" class="btn bg-purple">Cancel</a></td></tr>
	</table>
            </div>
        </div>
    </div>
</div>