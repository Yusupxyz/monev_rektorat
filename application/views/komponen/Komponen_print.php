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
    <h3 align="center">DATA Komponen</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
    <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Kode Komponen</th>
		<th>Id Kegiatan</th>
		<th>Uraian Kegiatan</th>
		<th>Volume</th>
		<th>Satuan</th>
		<th>Jumlah</th>
		
            </tr><?php
            foreach ($komponen_data as $komponen)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $komponen->kode_komponen ?></td>
		      <td><?php echo $komponen->id_kegiatan ?></td>
		      <td><?php echo $komponen->uraian_kegiatan ?></td>
		      <td><?php echo $komponen->volume ?></td>
		      <td><?php echo $komponen->satuan ?></td>
		      <td><?php echo $komponen->jumlah ?></td>	
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