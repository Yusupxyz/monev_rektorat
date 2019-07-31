<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Sub Komponen Detail</h3>
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
	    <tr><td>Id Subkomponen</td><td><?php echo $id_subkomponen; ?></td></tr>
	    <tr><td>Id Komponen</td><td><?php echo $id_komponen; ?></td></tr>
	    <tr><td>Kode Subkomponen</td><td><?php echo $kode_subkomponen; ?></td></tr>
	    <tr><td>Uraian Kegiatan</td><td><?php echo $uraian_kegiatan; ?></td></tr>
	    <tr><td>Volume</td><td><?php echo $volume; ?></td></tr>
	    <tr><td>Satuan</td><td><?php echo $satuan; ?></td></tr>
	    <tr><td>Jumlah</td><td><?php echo $jumlah; ?></td></tr>
	    <tr><td><a href="<?php echo site_url('sub_komponen') ?>" class="btn bg-purple">Cancel</a></td></tr>
	</table>
            </div>
        </div>
    </div>
</div>