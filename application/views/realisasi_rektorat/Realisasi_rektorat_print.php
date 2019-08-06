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
    <h3 align="center">DATA Realisasi Rektorat</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
    <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Realisasi</th>
		<th>Id Bulan</th>
		<th>Id Subkomponen</th>
		<th>Id Unit</th>
		<th>Rencana Capaian</th>
		<th>Ukuran Keberhasilan</th>
		<th>Realisasi Capaian</th>
		<th>Realisasi Jumlah</th>
		<th>Uraian Hasil</th>
		<th>Kendala</th>
		<th>Keterangan</th>
		
            </tr><?php
            foreach ($realisasi_rektorat_data as $realisasi_rektorat)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $realisasi_rektorat->id_realisasi ?></td>
		      <td><?php echo $realisasi_rektorat->id_bulan ?></td>
		      <td><?php echo $realisasi_rektorat->id_subkomponen ?></td>
		      <td><?php echo $realisasi_rektorat->id_unit ?></td>
		      <td><?php echo $realisasi_rektorat->rencana_capaian ?></td>
		      <td><?php echo $realisasi_rektorat->ukuran_keberhasilan ?></td>
		      <td><?php echo $realisasi_rektorat->realisasi_capaian ?></td>
		      <td><?php echo $realisasi_rektorat->realisasi_jumlah ?></td>
		      <td><?php echo $realisasi_rektorat->uraian_hasil ?></td>
		      <td><?php echo $realisasi_rektorat->kendala ?></td>
		      <td><?php echo $realisasi_rektorat->keterangan ?></td>	
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