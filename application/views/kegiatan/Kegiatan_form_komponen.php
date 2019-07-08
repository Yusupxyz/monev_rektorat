<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Kegiatan</h3>
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
        <form action="<?php echo $action; ?>" method="post">
        <div class="form-group">
            <label for="varchar">Kode Komponen <?php echo form_error('kode_komponen') ?></label>
            <input type="text" class="form-control" name="kode_komponen" id="kode_komponen" placeholder="Kode Komponen" value="<?php echo $volume; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Uraian Kegiatan <?php echo form_error('uraian_kegiatan') ?></label>
            <textarea class="form-control" name="uraian_kegiatan" id="uraian_kegiatan" placeholder="Uraian Kegiatan" value="<?php echo $volume; ?>"></textarea>
        </div>
	    <div class="form-group">
            <label for="varchar">Volume <?php echo form_error('volume') ?></label>
            <input type="text" class="form-control" name="volume" id="volume" placeholder="Volume" value="<?php echo $volume; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Satuan <?php echo form_error('satuan') ?></label>
            <input type="text" class="form-control" name="satuan" id="satuan" placeholder="Satuan" value="<?php echo $satuan; ?>" />
        </div>
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('kegiatan') ?>" class="btn btn-default">Batal</a>
	</form>
         </div>
        </div>
    </div>
</div>