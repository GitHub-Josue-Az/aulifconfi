@extends('layouts.app')


@section('content')


  <!-- Pie Novus JS-->
<script src="{{ asset('bower_components/pienovus/stream_layers.js') }}"></script>
<script src="{{ asset('bower_components/pienovus/nv.d3.js') }}"></script>

   <div class="container">
     <div class="row">

    <div class="col-md-8">
        
        <div id="container" style="width:100%;">
           <canvas id="canvas"></canvas>
         </div>


    </div>

    <div class="col-md-4">
      
        <div>
            <h1 style="margin-left: 20%"> Porcentaje </h1><br> 
        </div>
            
        <div class="testBlock"><svg id="test1"></svg></div>

    </div>


    </div>
   </div>



  <script>

    var preguntas = '<?php echo $numPreguntas;?>';
    var miarray = '<?php  echo json_encode ($exam);?>';
    var respuestas = JSON.parse(miarray);


    var color = Chart.helpers.color;

    var horizontalBarChartData = {
      labels: [],
      datasets: [{
        label: 'Correctas',
        backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
        borderColor: window.chartColors.blue,
        borderWidth: 1,
        data: []
      }, {
        label: 'Incorrectas',
        backgroundColor: color(window.chartColors.red).alpha(0.3).rgbString(),
        borderColor: window.chartColors.red,
        data: []
      }]
    };

    window.onload = function() {
      var ctx = document.getElementById('canvas').getContext('2d');
      window.myHorizontalBar = new Chart(ctx, {
        type: 'horizontalBar',
        data: horizontalBarChartData,
        options: {
          // Elements options apply to all of the options unless overridden in a dataset
          // In this case, we are setting the border of each horizontal bar to be 2px wide
          elements: {
            rectangle: {
              borderWidth: 2,
            }
          },
          responsive: true,
          legend: {
            position: 'right',
          },
          title: {
            display: true,
            text: 'Reporte de correctas e incorrectas según las repuestas'
          }
        }
      });

    };

      if (horizontalBarChartData.datasets.length > 0) {


         for (var i = 0; i < preguntas; i++) {

           var pre = i+1;
           horizontalBarChartData.labels.push('pregunta' + pre);
           
           horizontalBarChartData.datasets[0].data.push(respuestas[i][0]);
           horizontalBarChartData.datasets[1].data.push(respuestas[i][1]);

          }

          window.myHorizontalBar.update();
      };

     


  </script>


<script>


    /* PORCENTAJES */
    var porcen = '<?php  echo  json_encode($porc);?>';
     var porcentaje = JSON.parse(porcen);



   var testdata = [
        { y: porcentaje[0][0], color: '#36a2eb'},
        { y: porcentaje[0][1], color: '#ff6384' }
    ];

    var width = 300;
    var height = 300;

    nv.addGraph(function() {

        var chart = nv.models.pie()
                .y(function(d) { return d.y; })
                .width(width)
                .height(height)
                .labelType('percent')
                .valueFormat(d3.format('%'));

        d3.select("#test1")
                .datum([testdata])
                .transition().duration(1200)
                .attr('width', width)
                .attr('height', height)
                .attr('padding', 10)
                .call(chart);

        return chart;
    });


  </script>



@endsection

