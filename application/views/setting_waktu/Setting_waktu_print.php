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
    <h3 align="center">DATA Setting Waktu</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
    <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Setting Waktu</th>
		<th>Nama</th>
		<th>Waktu Awal</th>
		<th>Waktu Akhir</th>
		
            </tr><?php
            foreach ($setting_waktu_data as $setting_waktu)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $setting_waktu->id_setting_waktu ?></td>
		      <td><?php echo $setting_waktu->nama ?></td>
		      <td><?php echo $setting_waktu->waktu_awal ?></td>
		      <td><?php echo $setting_waktu->waktu_akhir ?></td>	
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