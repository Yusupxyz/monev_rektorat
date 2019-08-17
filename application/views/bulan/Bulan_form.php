<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Bulan</h3>
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
            <label for="int">Id Bulan <?php echo form_error('id_bulan') ?></label>
            <input type="text" class="form-control" name="id_bulan" id="id_bulan" placeholder="Id Bulan" value="<?php echo $id_bulan; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Bulan <?php echo form_error('bulan') ?></label>
            <input type="text" class="form-control" name="bulan" id="bulan" placeholder="Bulan" value="<?php echo $bulan; ?>" />
        </div>
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('bulan') ?>" class="btn btn-default">Cancel</a>
	</form>
         </div>
        </div>
    </div>
</div>