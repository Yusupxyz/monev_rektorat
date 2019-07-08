<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Sub_komponen</h3>
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
            <label for="int">Id Subkomponen <?php echo form_error('id_subkomponen') ?></label>
            <input type="text" class="form-control" name="id_subkomponen" id="id_subkomponen" placeholder="Id Subkomponen" value="<?php echo $id_subkomponen; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Id Komponen <?php echo form_error('id_komponen') ?></label>
            <input type="text" class="form-control" name="id_komponen" id="id_komponen" placeholder="Id Komponen" value="<?php echo $id_komponen; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Kode Subkomponen <?php echo form_error('kode_subkomponen') ?></label>
            <input type="text" class="form-control" name="kode_subkomponen" id="kode_subkomponen" placeholder="Kode Subkomponen" value="<?php echo $kode_subkomponen; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Uraian Kegiatan <?php echo form_error('uraian_kegiatan') ?></label>
            <input type="text" class="form-control" name="uraian_kegiatan" id="uraian_kegiatan" placeholder="Uraian Kegiatan" value="<?php echo $uraian_kegiatan; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Volume <?php echo form_error('volume') ?></label>
            <input type="text" class="form-control" name="volume" id="volume" placeholder="Volume" value="<?php echo $volume; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Satuan <?php echo form_error('satuan') ?></label>
            <input type="text" class="form-control" name="satuan" id="satuan" placeholder="Satuan" value="<?php echo $satuan; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Jumlah <?php echo form_error('jumlah') ?></label>
            <input type="text" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah" value="<?php echo $jumlah; ?>" />
        </div>
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('sub_komponen') ?>" class="btn btn-default">Cancel</a>
	</form>
         </div>
        </div>
    </div>
</div>