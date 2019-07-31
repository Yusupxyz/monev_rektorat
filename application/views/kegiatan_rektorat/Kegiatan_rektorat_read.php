<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Kegiatan Rektorat Detail</h3>
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
	    <tr><td>Id Kegiatan</td><td><?php echo $id_kegiatan; ?></td></tr>
	    <tr><td>Kode M Dat</td><td><?php echo $kode_m_dat; ?></td></tr>
	    <tr><td>Volume</td><td><?php echo $volume; ?></td></tr>
	    <tr><td>Satuan</td><td><?php echo $satuan; ?></td></tr>
	    <tr><td>Jumlah</td><td><?php echo $jumlah; ?></td></tr>
	    <tr><td>Rencana Capaian</td><td><?php echo $rencana_capaian; ?></td></tr>
	    <tr><td>Capaian</td><td><?php echo $capaian; ?></td></tr>
	    <tr><td>Jumlah Capaian</td><td><?php echo $jumlah_capaian; ?></td></tr>
	    <tr><td>Id Unit</td><td><?php echo $id_unit; ?></td></tr>
	    <tr><td>Id Tahun</td><td><?php echo $id_tahun; ?></td></tr>
	    <tr><td><a href="<?php echo site_url('kegiatan_rektorat') ?>" class="btn bg-purple">Cancel</a></td></tr>
	</table>
            </div>
        </div>
    </div>
</div>