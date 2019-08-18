<script src="<?= base_url();?>assets/bower_components/chart.js/Chart.js"></script>
<script type="text/javascript">

//update set unit chart
$(document).ready(function(){
    $("#unit").change(function () {
        var idunit = $("#unit").val();
        $.ajax({
            url: "<?php echo base_url();?>set_unit_chart/update_action" ,
            type: "POST",
            dataType : 'json',
            data :  { id_unit : idunit },    
            success: function(data){ 
              location.reload();
              },
            error: function (jqXHR, exception) {
              var msg = '';
              if (jqXHR.status === 0) {
                  msg = 'Not connect.\n Verify Network.';
              } else if (jqXHR.status == 404) {
                  msg = 'Requested page not found. [404]';
              } else if (jqXHR.status == 500) {
                  msg = 'Internal Server Error [500].';
              } else if (exception === 'parsererror') {
                  msg = 'Requested JSON parse failed.';
              } else if (exception === 'timeout') {
                  msg = 'Time out error.';
              } else if (exception === 'abort') {
                  msg = 'Ajax request aborted.';
              } else {
                  msg = 'Uncaught Error.\n' + jqXHR.responseText;
              }
              console.log(jqXHR);
          }

        });
    });
});

function myFunction() {
  if (primary.checked == true){
    alert("a");
  } else {
    alert("b");
  }
}

$( document ).ready(function() {
  const div = document.createElement('div');

div.className = 'row';

div.innerHTML = `<?php $j=0;
 foreach ($labels as $key => $value){
  echo '    <h6>&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" id="k1" style="background-color: '.$color[$j].';" class="btn"></button> 
  '.$labels[$j++].'&nbsp;&nbsp;&nbsp;&nbsp;</h6>';
} ?>
`;

document.getElementById('keterangan').appendChild(div);

});

function removeRow(input) {
  document.getElementById('content').removeChild(input.parentNode);
}

  $(function(){
    var areaChartData = {
      labels  : ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
      datasets: [
        <?php 
          $i=0;
          foreach ($labels as $key => $value) {?>
        {
          label               : <?php echo json_encode($labels[$i]) ?>,
          fillColor           : '<?php echo $color[$i]; ?>',
          strokeColor         : '<?php echo $color[$i]; ?>',
          pointColor          : '<?php echo $color[$i]; ?>',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : <?php if(isset($dataset[$i])){echo json_encode($dataset[$i++]); };?>
          },
<?php } ?>
      ]
    }
    
    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
    var barChart                         = new Chart(barChartCanvas)
    var barChartData                     = areaChartData
    var barChartOptions                  = {
      scales: {
        yAxes: [{
          scaleLabel: {
            display: true,
            labelString: 'probability'
          }
        }]
      },
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
    }

    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)


    <?php if (isset($labels2)) { ?>
      var areaChartData2 = {
      labels  : ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
      datasets: [
        <?php 
          $i=0;
          foreach ($labels2 as $key => $value) {?>
        {
          label               : <?php echo json_encode($labels2[$i]) ?>,
          fillColor           : '<?php echo $color[$i]; ?>',
          strokeColor         : '<?php echo $color[$i]; ?>',
          pointColor          : '<?php echo $color[$i]; ?>',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : <?php 
          if(isset($dataset2[$i])){
               echo json_encode($dataset2[$i++]); 
             };
             ?>
        },
        <?php } ?>
      ]
    }
    
    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas2                   = $('#barChart2').get(0).getContext('2d')
    var barChart2                         = new Chart(barChartCanvas2)
    var barChartData2                     = areaChartData2
    var barChartOptions2                  = {
      scales: {
        yAxes: [{
          scaleLabel: {
            display: true,
            labelString: 'probability'
          }
        }]
      },
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
    }

    barChartOptions2.datasetFill = false
    barChart2.Bar(barChartData2, barChartOptions2)
  <?php } ?>
  });
</script>
     