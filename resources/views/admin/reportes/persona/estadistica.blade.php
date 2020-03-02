@extends('layouts.app')


@section('content')


    <!-- Pie Novus JS-->
<script src="{{ asset('bower_components/pienovus/stream_layers.js') }}"></script>
<script src="{{ asset('bower_components/pienovus/nv.d3.js') }}"></script>

<h3 style="padding-left: 40%; color: <?php echo ($aod == 1) ? "#36a2eb" : "#ff6384";?>; text-decoration-line: underline ;">
 {{ $aod == 1 ? "Aprobado": "Desaprobado"}} 
</h3>

<br>

<div class="container">
    <div class="row">
        

        <div class="col-md-8" >
            
        <div class="container">
            
            <div class="col">

            <div class="row-md-2">
                <div> <h4>Modulo-{{ $nomMod }}</h4> </div>  
                <div> <h4>Persona-{{ $nomPer }}</h4> </div>
            </div>
            <br><br>
            <div class="row-md-10">
                
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Pregunta</th>
                    <th scope="col">Respuesta</th>
                    <th scope="col">Nota</th>
                    <th scope="col"></th>
                  </tr>
                </thead>

                <tbody>

                 @foreach ($pivote as $key => $pi)
                  <tr>
                   <td >Pregunta {{ $key +1  }}</td>
                    <td>{{ ($pi->pivot->correct == 1 )? "correcto" : "incorrecto" }}</td>
                    <td>{{ $pi->pivot->score }}</td>
                  </tr>
                 @endforeach

                </tbody>
            </table>     
    
    

            </div>

            </div>


        </div>
        </div>


        <div class="col-md-4">
         <div>
            <h1 style="margin-left: 20%">Nota : {{ $nota }} </h1><br> <br>
        </div>
            
        <div class="testBlock"><svg id="test1"></svg></div>
        </div>

    </div>
</div>




  <script>


    /* PORCENTAJES */
    var porcen = '<?php  echo  json_encode($exam);?>';
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


