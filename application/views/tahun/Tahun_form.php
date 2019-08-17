<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Tahun</h3>
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
            <label for="year">Tahun <?php echo form_error('tahun') ?></label>
            <input type="text" class="form-control" name="tahun" id="tahun" placeholder="Tahun" value="<?php echo $tahun; ?>" />
        </div>
	    <div class="form-group">
            <label for="enum">Aktif <?php echo form_error('aktif') ?></label>
             <?php 
                $options = array(
                    '0' => 'Tidak Aktif',
                    '1' => 'Aktif',
                    );
                $attribute='class="form-control"';
                echo form_dropdown('aktif', $options, $aktif, $attribute);
            ?>
        </div>
	    <input type="hidden" name="id_tahun" value="<?php echo $id_tahun; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('tahun') ?>" class="btn btn-default">Cancel</a>
	</form>
         </div>
        </div>
    </div>
</div>