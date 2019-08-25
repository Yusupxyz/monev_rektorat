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
  

            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    
                </div>
            </div>
            <div class="col-md-12 text-right">
                <?php echo anchor(site_url('resume/export'),'<i class="fa fa-file-excel-o"></i> Ekspor ke Excel', 'class="btn bg-green"'); ?>
            </div>
            <div class="col-md-12 text-right"><form action="<?php echo site_url('resume/index'); ?>" class="form-inline" method="get" style="margin-top:10px">
                    <div class="input-group">
                        <input tye="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('resume'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <form method="post" action="<?= site_url('resume/deletebulk');?>" id="formbulk">
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
            </tr><?php
            $i=0;
            $j=0;
            foreach ($kegiatan_data as $kegiatan)
            {
                $jumlah = $data_jumlah_kegiatan[$i]->jumlah;
                $jumlah_capaian = $data_jumlah_kegiatan[$i]->jc;
                if ($i==0 || $i==1){
                    $jc = $data_program[3]['jc']; 
                    $c = $data_program[3]['c']; 
                }elseif ($i==2) {
                    $jc = $data_subprogram[3]['jc']; 
                    $c = $data_subprogram[3]['c']; 
                }else{
                    $jc = $data_suboutput[3]['jc']; 
                    $c = $data_suboutput[3]['c']; 
                }

                ?>
                <tr>
                
		<td  style="width: 10px;padding-left: 8px;"><input type="checkbox" name="id" value="<?= $kegiatan->id_kegiatan;?>" />&nbsp;</td>
                
			<td width="80px"><?php echo ++$start ?></td>
			<!-- <td><?php echo $kegiatan->id_kegiatan ?></td> -->
			<td><?php echo $kegiatan->kode_m_dat ?></td>
			<td><?php echo $kegiatan->ket ?></td>
			<td><?php echo "Rp.".nominal($jumlah).""; ?></td>
			<td><?php echo $jc."%" ?></td>
			<td><?php echo $c."%" ?></td>
			<td><?php echo "Rp.".nominal($jumlah_capaian).""; ?></td>
			<td><?php echo $kegiatan->deskripsi ?></td>
	
		</tr>
        <?php 
        //Komponen
                if ($kegiatan->jenis!='1' && $kegiatan->jenis!='2'){
                    if($count_child[$i]->jumlah_anak=='0'){
                       
                        if (isset($komponen[$i][0])){ 
                            $v=0;
                            foreach ($komponen[$i] as $key => $value) { 
                                $jumlah = $data_komponen[$i][$v]->jumlah; 
                                $jumlah_capaian = $data_komponen[$i][$v]->jc; 
                                ?>
                        <tr>
                            <td></td>
                            <td>*komponen</td>
                            <td><?php echo $value->kode_komponen; ?></td>
                            <td><?php echo $value->uraian_kegiatan; ?></td>
                            <td><?php echo "Rp.".nominal($jumlah).""; ?></td>
                            <td><?php echo round($data_komponen[$i][$v]->rc/$count_jumlah[$i][$v]->jumlah) ."%" ?></td>
                            <td><?php echo round($data_komponen[$i][$v]->c/$count_jumlah[$i][$v++]->jumlah) ."%" ?></td>
                            <td><?php echo "Rp.".nominal($jumlah_capaian).""; ?></td>
                            <td><?php echo $value->deskripsi ?></td>
     
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
                            <td><?php echo round($value1->rencana_capaian)."%" ?></td>
                            <td><?php echo round($value1->capaian)."%" ?></td>
                            <td><?php echo "Rp.".nominal($jumlah_capaian1).""; ?></td>
                            <td><?php echo $value1->deskripsi ?></td>
    
                        </tr> 
                        
                   <?php
                        }}                        
                    }                 
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