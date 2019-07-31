<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Setting Waktu</h3>
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
        <input type="text" name="id_setting_waktu" hidden value="<?php echo $id_setting_waktu; ?>" />
	    <div class="form-group">
            <label for="varchar">Nama <?php echo form_error('nama') ?></label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">Waktu Awal <?php echo form_error('waktu_awal') ?></label>
            <input type="text" class="form-control waktu_awal" name="waktu_awal" id="waktu_awal" placeholder="Waktu Awal" value="<?php echo $waktu_awal; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">Waktu Akhir <?php echo form_error('waktu_akhir') ?></label>
            <input type="text" class="form-control waktu_akhir" name="waktu_akhir"  id="waktu_akhir" placeholder="Waktu Akhir" value="<?php echo $waktu_akhir; ?>" />
        </div>
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('setting_waktu') ?>" class="btn btn-default">Cancel</a>
	</form>
         </div>
        </div>
    </div>
</div>