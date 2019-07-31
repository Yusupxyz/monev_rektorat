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
    <h3 align="center">DATA Kegiatan Rektorat</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
    <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Kegiatan</th>
		<th>Kode M Dat</th>
		<th>Volume</th>
		<th>Satuan</th>
		<th>Jumlah</th>
		<th>Rencana Capaian</th>
		<th>Capaian</th>
		<th>Jumlah Capaian</th>
		<th>Id Unit</th>
		<th>Id Tahun</th>
		
            </tr><?php
            foreach ($kegiatan_rektorat_data as $kegiatan_rektorat)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $kegiatan_rektorat->id_kegiatan ?></td>
		      <td><?php echo $kegiatan_rektorat->kode_m_dat ?></td>
		      <td><?php echo $kegiatan_rektorat->volume ?></td>
		      <td><?php echo $kegiatan_rektorat->satuan ?></td>
		      <td><?php echo $kegiatan_rektorat->jumlah ?></td>
		      <td><?php echo $kegiatan_rektorat->rencana_capaian ?></td>
		      <td><?php echo $kegiatan_rektorat->capaian ?></td>
		      <td><?php echo $kegiatan_rektorat->jumlah_capaian ?></td>
		      <td><?php echo $kegiatan_rektorat->id_unit ?></td>
		      <td><?php echo $kegiatan_rektorat->id_tahun ?></td>	
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