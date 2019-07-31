<script>

    function confirmdelete(linkdelete) {
        alertify.confirm("Apakah anda yakin akan  menghapus data tersebut?", function() {
            location.href = linkdelete;
        }, function() {
            alertify.error("Penghapusan data dibatalkan.");
        });
        $(".ajs-header").html("Konfirmasi");
        return false;
    }
    $(':checkbox[name=selectall]').click(function () {
        $(':checkbox[name=id]').prop('checked', this.checked);
    });

    $(document).ready(function(){
        var waktu_rencana_awal = new Date('<?= $waktu_rencana->waktu_awal ?>');
        var waktu_rencana_akhir   = new Date('<?= $waktu_rencana->waktu_akhir ?>');
        var waktu_realisasi_awal = new Date('<?= $waktu_realisasi->waktu_awal ?>');
        var waktu_realisasi_akhir   = new Date('<?= $waktu_realisasi->waktu_akhir ?>');
        var today = new Date();
        console.log(waktu_rencana_awal);
        console.log(waktu_rencana_akhir);
        console.log(today);

        if ((today >= waktu_rencana_awal && today <= waktu_rencana_akhir)) {
            for(i=0;i<12;i++){
                document.getElementById('rencana_capaian'+i).removeAttribute("readonly");
                document.getElementById('ukuran_keberhasilan'+i).removeAttribute("readonly");
            }
        }

        if ((today >= waktu_realisasi_awal && today <= waktu_realisasi_akhir)) {
            for(i=0;i<12;i++){
                document.getElementById('realisasi_capaian'+i).removeAttribute("readonly");
                document.getElementById('realisasi_jumlah'+i).removeAttribute("readonly");
                document.getElementById('uraian_hasil'+i).removeAttribute("readonly");
                document.getElementById('kendala'+i).removeAttribute("readonly");
                document.getElementById('keterangan'+i).removeAttribute("readonly");
            }
        }
        
    });

    function cek(){
        var jumlah_realisasi=0;
        var jumlah_rencana=0;
        for(i=0;i<12;i++){
            var data_realisasi=parseInt(document.getElementById("realisasi_capaian"+i).value);
            var data_rencana=parseInt(document.getElementById("rencana_capaian"+i).value);
            jumlah_realisasi=jumlah_realisasi+data_realisasi;
            jumlah_rencana=jumlah_rencana+data_rencana;
        }     
        if (jumlah_realisasi>100){
            $("form").submit(function(e){
                e.preventDefault();
                $(this).unbind(e);
                alert("Total Realisasi Capaian: "+jumlah_realisasi+"%,  melebihi 100%!!!");
            });
        }

        if (jumlah_rencana>100){
            $("form").submit(function(e){
                e.preventDefault();
                $(this).unbind(e);
                alert("Total Rencana Capaian: "+jumlah_rencana+"%, melebihi 100%!!!");

            });
        }
    }

</script>