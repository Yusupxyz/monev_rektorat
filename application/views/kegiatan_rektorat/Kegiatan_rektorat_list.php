<div class="row">
<div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title"><?php echo $title ;?></h3>
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
            <div class="col-md-12">
                <?php echo anchor(site_url('kegiatan_rektorat/create'),'<i class="fa fa-plus"></i> Tambah Program Induk', 'class="btn bg-purple"'); ?>
                <?php echo anchor(site_url('kegiatan_rektorat/create/program'),'<i class="fa fa-plus"></i> Tambah Program', 'class="btn bg-green"'); ?>
                <?php echo anchor(site_url('kegiatan_rektorat/create/sub_program'),'<i class="fa fa-plus"></i> Tambah Sub Program', 'class="btn bg-maroon"'); ?>
                <?php echo anchor(site_url('kegiatan_rektorat/create/sub_output'),'<i class="fa fa-plus"></i> Tambah Sub Output', 'class="btn bg-yellow"'); ?>
            </div>

            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    
                </div>
            </div>
            <div class="col-md-12 text-right">
                <?php echo anchor(site_url('kegiatan_rektorat/export'),'<i class="fa fa-file-excel-o"></i> Ekspor ke Excel', 'class="btn bg-green"'); ?>
            </div>
            <div class="col-md-12 text-right"><form action="<?php echo site_url('kegiatan_rektorat/index'); ?>" class="form-inline" method="get" style="margin-top:10px">
                    <div class="input-group">
                        <input tye="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('kegiatan_rektorat'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <form method="post" action="<?= site_url('kegiatan_rektorat/deletebulk');?>" id="formbulk">
        <table class="table table-bordered" style="margin-bottom: 10px" style="width:100%">
            <tr>
                <th style="width: 10px;"><input type="checkbox" name="selectall" /></th>
                <th>No</th>
		<!-- <th>Id Kegiatan</th> -->
		<th>Kode</th>
		<th>Uraian Kegiatan</th>
		<th>Jumlah</th>
		<th>Rencana Capaian</th>
		<th>Realisasi Capaian Fisik</th>
		<th>Realisasi Jumlah Capaian</th>
		<th>Unit</th>
		<th>Action</th>
            </tr><?php
            $i=0;
            $j=0;

            foreach ($kegiatan_rektorat_data as $kegiatan)
            {
                $jumlah = $kegiatan->jumlah;
                $jumlah_capaian = $kegiatan->jumlah_capaian;
                ?>
                <tr>
                
		<td  style="width: 10px;padding-left: 8px;"><input type="checkbox" name="id" value="<?= $kegiatan->id_kegiatan;?>" />&nbsp;</td>
                
			<td width="80px"><?php echo ++$start ?></td>
			<!-- <td><?php echo $kegiatan->id_kegiatan ?></td> -->
			<td><?php echo $kegiatan->kode_m_dat ?></td>
			<td><?php echo $kegiatan->ket ?></td>
			<td><?php echo "Rp.".nominal($jumlah).""; ?></td>
			<td><?php echo $kegiatan->rencana_capaian."%" ?></td>
			<td><?php echo $kegiatan->capaian."%" ?></td>
			<td><?php echo "Rp.".nominal($jumlah_capaian).""; ?></td>
			<td><?php echo $kegiatan->deskripsi ?></td>
			<td style="text-align:center" width="200px">
                <?php 
                if ($kegiatan->jenis!='1' && $kegiatan->jenis!='2'){
                    if($count_child[$i]->jumlah_anak=='0'){
                    echo anchor(site_url('kegiatan_rektorat/create/komponen/'.$kegiatan->id_kegiatan),'<i class="fa fa-plus"></i>', 'class="btn btn-xs btn-success"  data-toggle="tooltip" title="Tambah Komponen"'); 
                    echo ' '; 
                    }
                }
				echo anchor(site_url('kegiatan_rektorat/update/'.$kegiatan->id_kegiatan),' <i class="fa fa-edit"></i>', 'class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"'); 
				echo ' '; 
				echo anchor(site_url('kegiatan_rektorat/delete/'.$kegiatan->id_kegiatan),' <i class="fa fa-trash"></i>','class="btn btn-xs btn-danger" onclick="javasciprt: return confirmdelete(\'kegiatan_rektorat/delete/'.$kegiatan->id_kegiatan.'\')"  data-toggle="tooltip" title="Delete" '); 
            ?>
			</td>
		</tr>
        <?php 
        //Komponen
                if ($kegiatan->jenis!='1' && $kegiatan->jenis!='2'){
                    if($count_child[$i]->jumlah_anak=='0'){
                       
                        if (isset($komponen[$i][0])){ 
                            foreach ($komponen[$i] as $key => $value) { 
                                $jumlah = $value->jumlah; 
                                $jumlah_capaian = $value->jumlah_capaian;
                                ?>
                        <tr>
                            <td></td>
                            <td>*komponen</td>
                            <td><?php echo $value->kode_komponen; ?></td>
                            <td><?php echo $value->uraian_kegiatan; ?></td>
                            <td><?php echo "Rp.".nominal($jumlah).""; ?></td>
                            <td><?php echo $value->rencana_capaian."%" ?></td>
                            <td><?php echo $value->capaian."%" ?></td>
                            <td><?php echo "Rp.".nominal($jumlah_capaian).""; ?></td>
                            <td><?php echo $value->deskripsi ?></td>
                            <td style="text-align:center" width="200px">
                            <?php 
                                if ($kegiatan->jenis!='1' && $kegiatan->jenis!='2'){
                                    if($count_child[$i]->jumlah_anak=='0'){
                                    echo anchor(site_url('kegiatan_rektorat/create/subkomponen/'.$value->id_komponen),'<i class="fa fa-plus"></i>', 'class="btn btn-xs btn-default"  data-toggle="tooltip" title="Tambah Sub Komponen"'); 
                                    echo ' '; 
                                    }
                                }
                                echo anchor(site_url('kegiatan_rektorat/update/'.$value->id_komponen),' <i class="fa fa-edit"></i>', 'class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"'); 
                                echo ' '; 
                                echo anchor(site_url('kegiatan_rektorat/delete/'.$value->id_komponen),' <i class="fa fa-trash"></i>','class="btn btn-xs btn-danger" onclick="javasciprt: return confirmdelete(\'kegiatan/delete/'.$kegiatan->id_kegiatan.'\')"  data-toggle="tooltip" title="Delete" '); 
                              ?>
                            </td>
                        </tr> 
                        
                   <?php

            //subkomponen rektorat
                if ($kegiatan->jenis!='1' && $kegiatan->jenis!='2'){
                    if($count_child_komponen[$j]->jumlah_anak !='0'){
                        if (isset($subkomponen[$j][0])){ 
                            foreach ($subkomponen[$j] as $key => $value1) { 
                            $jumlah1 = $value1->jumlah; 
                            $jumlah_capaian1 = $value1->jumlah_capaian;
                            ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td><?php echo $value1->kode_subkomponen; ?></td>
                            <td><?php echo $value1->uraian_kegiatan; ?></td>
                            <td><?php echo "Rp.".nominal($jumlah1).""; ?></td>
                            <td><?php echo $value1->rencana_capaian."%" ?></td>
                            <td><?php echo $value1->capaian."%" ?></td>
                            <td><?php echo "Rp.".nominal($jumlah_capaian1).""; ?></td>
                            <td><?php echo $value1->deskripsi ?></td>
                            <td style="text-align:center" width="200px">
                            <?php if ($group_id==""){
                                echo anchor(site_url('kegiatan_rektorat/update/'.$value1->id_subkomponen),' <i class="fa fa-edit"></i>', 'class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"'); 
                                echo ' '; 
                                echo anchor(site_url('kegiatan_rektorat/delete/'.$value1->id_subkomponen),' <i class="fa fa-trash"></i>','class="btn btn-xs btn-danger" onclick="javasciprt: return confirmdelete(\'kegiatan/delete/'.$kegiatan->id_kegiatan.'\')"  data-toggle="tooltip" title="Delete" '); 
                             }else{
                                    echo anchor(site_url('realisasi_rektorat/'.$value1->id_subkomponen),' <i class="fa fa-plus"></i>','class="btn btn-xs btn-primary"  data-toggle="tooltip" title="Realisasi" '); 
                             } ?>
                            </td>
                        </tr> 
                        
                   <?php
                        }}                        
                    }
                        //subkomponen unit
                        if($count_child_komponen_unit[$j]->jumlah_anak !='0'){
                            if (isset($subkomponenunit[$j][0])){ 
                                foreach ($subkomponenunit[$j] as $key => $value2) { 
                                $jumlah2 = $value2->jumlah; 
                                $jumlah_capaian2 = $value2->jumlah_capaian;
                                ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><?php echo $value2->kode_subkomponen; ?></td>
                                <td><?php echo $value2->uraian_kegiatan; ?></td>
                                <td><?php echo "Rp.".nominal($jumlah2).""; ?></td>
                                <td><?php echo $value2->rencana_capaian."%" ?></td>
                                <td><?php echo $value2->capaian."%" ?></td>
                                <td><?php echo "Rp.".nominal($jumlah_capaian2).""; ?></td>
                                <td><?php echo $value2->deskripsi ?></td>
                                <td style="text-align:center" width="200px">
                                <?php if ($group_id==""){
                                    echo anchor(site_url('kegiatan_rektorat/update/'.$value2->id_subkomponen),' <i class="fa fa-edit"></i>', 'class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"'); 
                                    echo ' '; 
                                    echo anchor(site_url('kegiatan_rektorat/delete/'.$value2->id_subkomponen),' <i class="fa fa-trash"></i>','class="btn btn-xs btn-danger" onclick="javasciprt: return confirmdelete(\'kegiatan/delete/'.$kegiatan->id_kegiatan.'\')"  data-toggle="tooltip" title="Delete" '); 
                                 }else{
                                        echo anchor(site_url('realisasi/'.$value2->id_subkomponen.'/'.$value2->id_unit),' <i class="fa fa-plus"></i>','class="btn btn-xs btn-primary"  data-toggle="tooltip" title="Realisasi" '); 
                                 } 
                                 ?>
                                </td>
                            </tr> 
                            
                       <?php
                            }}                        }
                        
                    }
                    $j++;
                }
                
                    }}
                }
        $i++;}
        ?>
        </table>
         <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-12">
                <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> Hapus Data Terpilih</button> <a href="#" class="btn bg-yellow">Total Record : <?php echo $total_rows ?></a>
            </div>
        </div>
        </form>
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