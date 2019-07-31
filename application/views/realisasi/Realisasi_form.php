<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Realisasi</h3>
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
            <label for="int">Id Subkomponen <?php echo form_error('id_subkomponen') ?></label>
            <input type="text" class="form-control" name="id_subkomponen" id="id_subkomponen" placeholder="Id Subkomponen" value="<?php echo $id_subkomponen; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Rencana Capaian <?php echo form_error('rencana_capaian') ?></label>
            <input type="text" class="form-control" name="rencana_capaian" id="rencana_capaian" placeholder="Rencana Capaian" value="<?php echo $rencana_capaian; ?>" />
        </div>
	    <div class="form-group">
            <label for="ukuran_keberhasilan">Ukuran Keberhasilan <?php echo form_error('ukuran_keberhasilan') ?></label>
            <textarea class="form-control" rows="3" name="ukuran_keberhasilan" id="ukuran_keberhasilan" placeholder="Ukuran Keberhasilan"><?php echo $ukuran_keberhasilan; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="int">Realisasi Capaian <?php echo form_error('realisasi_capaian') ?></label>
            <input type="text" class="form-control" name="realisasi_capaian" id="realisasi_capaian" placeholder="Realisasi Capaian" value="<?php echo $realisasi_capaian; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Realisasi Jumlah <?php echo form_error('realisasi_jumlah') ?></label>
            <input type="text" class="form-control" name="realisasi_jumlah" id="realisasi_jumlah" placeholder="Realisasi Jumlah" value="<?php echo $realisasi_jumlah; ?>" />
        </div>
	    <div class="form-group">
            <label for="uraian_hasil">Uraian Hasil <?php echo form_error('uraian_hasil') ?></label>
            <textarea class="form-control" rows="3" name="uraian_hasil" id="uraian_hasil" placeholder="Uraian Hasil"><?php echo $uraian_hasil; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="varchar">Kendala <?php echo form_error('kendala') ?></label>
            <input type="text" class="form-control" name="kendala" id="kendala" placeholder="Kendala" value="<?php echo $kendala; ?>" />
        </div>
	    <div class="form-group">
            <label for="keterangan">Keterangan <?php echo form_error('keterangan') ?></label>
            <textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan"><?php echo $keterangan; ?></textarea>
        </div>
	    <input type="hidden" name="id_realisasi" value="<?php echo $id_realisasi; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('realisasi') ?>" class="btn btn-default">Cancel</a>
	</form>
         </div>
        </div>
    </div>
</div>