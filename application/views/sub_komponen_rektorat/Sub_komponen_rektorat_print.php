<!DOCTYPE html>
<html>
<head>
    <title>Tittle</title>
    <style type="text/css" media="print">
    @page {
        margin: 0;  /* this affects the margin in the printer settings */
    }
      table{
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
      }
      table th{
          -webkit-print-color-adjust:exact;
        border: 1px solid;

                padding-top: 11px;
    padding-bottom: 11px;
    background-color: #a29bfe;
      }
   table td{
        border: 1px solid;

   }
        </style>
</head>
<body>
    <h3 align="center">DATA Sub Komponen Rektorat</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
    <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Subkomponen</th>
		<th>Id Komponen</th>
		<th>Kode Subkomponen</th>
		<th>Uraian Kegiatan</th>
		<th>Volume</th>
		<th>Satuan</th>
		<th>Jumlah</th>
		<th>Rencana Capaian</th>
		<th>Capaian</th>
		<th>Jumlah Capaian</th>
		
            </tr><?php
            foreach ($sub_komponen_rektorat_data as $sub_komponen_rektorat)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $sub_komponen_rektorat->id_subkomponen ?></td>
		      <td><?php echo $sub_komponen_rektorat->id_komponen ?></td>
		      <td><?php echo $sub_komponen_rektorat->kode_subkomponen ?></td>
		      <td><?php echo $sub_komponen_rektorat->uraian_kegiatan ?></td>
		      <td><?php echo $sub_komponen_rektorat->volume ?></td>
		      <td><?php echo $sub_komponen_rektorat->satuan ?></td>
		      <td><?php echo $sub_komponen_rektorat->jumlah ?></td>
		      <td><?php echo $sub_komponen_rektorat->rencana_capaian ?></td>
		      <td><?php echo $sub_komponen_rektorat->capaian ?></td>
		      <td><?php echo $sub_komponen_rektorat->jumlah_capaian ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
</body>
<script type="text/javascript">
      window.print()
    </script>
</html>