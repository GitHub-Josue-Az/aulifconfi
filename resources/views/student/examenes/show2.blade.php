@extends('layouts.app')

@section('title')
<div class="page-title-icon">
    <i class="pe-7s-notebook"></i>
</div>
<div align="center"><h1>{{ $assignacion->title }}</h1></div>
@endsection

@section('content')

<!-- Styles -->
<link rel="stylesheet" href="{{ asset('css/radioexam.css') }}">

<div class="container">

  {!! Form::open(['method' => 'POST', 'route' => ['student.evaluacion.store'], 'files' => true, 'class' => 'needs-validation', 'novalidate' => '']) !!}
     
        <!-- External toolbar sample -->
        <div class="row d-flex align-items-center p-3 my-3 text-white-50">
        </div>
        <!-- SmartWizard html -->
        <div id="smartwizard">
          
          
          <!-- PARA QUE SIRVE : PONER FOR TAMBIEN -->
          
            <ul>
  
               @for ($ji = 0; $ji < count($preguntas); $ji++)
                <li><a href="#step-{{ $ji }}">Pregunta {{ $ji +1 }}<br /></a></li>
                @endfor
            </ul>

          <div>
          @for ($io = 0; $io < count($preguntas); $io++)
                <!-- PARA QUE SIRVE : AQUI COMIENZA -->
                <div id="step-{{ $io }}" class="">

                  <div class="container" style="margin-left: 100px; margin-top: 10px">
                    <div class="row">
                    <div  class="col-sm-9">
                      {!! $preguntas[$io]->body !!}</div>
                    <div class="col-sm-3">
                       ({!! $preguntas[$io]->score !!} Puntos)</div>
                    </div>
                  </div>

                  <br> 

                  @for ($i = 0; $i < 5; $i++)
  
                 <div  class="form-group" style="margin-left: 100px; border: 1px solid #3498db; border-radius: 15px;">
        <label style=" width: 100%; height: 100%">
            <div class="onee" style="margin-top: 20px; padding-left: 10%">
                <input style="vertical-align: top; margin-left: inherit;" 
                type="radio" name="correct[{{ $io }}][]" value="{{$i}}">
              <span style="vertical-align: top;"> {!! $preguntas[$io]->answers->get($i)->body !!}</span>
            </div>  
        </label>
                 </div>

                  @endfor
                 </div> 

              @endfor

            </div>


    <input type="number" style="visibility: hidden" name="assignacionid" id="assignacionid" value="{{ $assignacion->id }}">
     <input type="number" style="visibility: hidden" name="lessonid" id="lessonid" value="{{ $lessonid }}">

        </div>

  <br>


        {!! Form::submit('Terminar examen', ['class' => 'btn btn-primary mr-1', 'id' => 'finalizar' , 'name' => 'finalizar']) !!}
        
    {!! Form::close() !!}
    <br>
</div>


@endsection



@section('javascript')


<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <script src="{{ asset('bower_components/steps/dist/js/jquery.smartWizard.min.js') }}"></script>

    <script type="text/javascript">

        $(document).ready(function(){
            // Step show event
            $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
               //alert("You are on step "+stepNumber+" now");
               if(stepPosition === 'first'){
                   $("#prev-btn").addClass('disabled');
               }else if(stepPosition === 'final'){
                   $("#next-btn").addClass('disabled');
               }else{
                   $("#prev-btn").removeClass('disabled');
                   $("#next-btn").removeClass('disabled');
               }
            });

            // Toolbar extra buttons
            var btnFinish = $('<button></button>').text('Finish')
                                             .addClass('btn btn-info')
                                             .on('click', function(){ alert('Finish Clicked'); });
            var btnCancel = $('<button></button>').text('Cancel')
                                             .addClass('btn btn-danger')
                                             .on('click', function(){ $('#smartwizard').smartWizard("reset"); });


            // Smart Wizard
            $('#smartwizard').smartWizard({
                    selected: 0,
                    theme: 'default',
                    transitionEffect:'fade',
                    showStepURLhash: true,
                    toolbarSettings: {toolbarPosition: 'both',
                                      toolbarButtonPosition: 'end',
                                      toolbarExtraButtons: []
                                    }
            });


            // External Button Events
            $("#reset-btn").on("click", function() {
                // Reset wizard
                $('#smartwizard').smartWizard("reset");
                return true;
            });

            $("#prev-btn").on("click", function() {
                // Navigate previous
                $('#smartwizard').smartWizard("prev");
                return true;
            });

            $("#next-btn").on("click", function() {
                // Navigate next
                $('#smartwizard').smartWizard("next");
                return true;
            });

            $("#theme_selector").on("change", function() {
                // Change theme
                $('#smartwizard').smartWizard("theme", $(this).val());
                return true;
            });

            // Set selected theme on page refresh
            $("#theme_selector").change();

        });

    </script>




<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>

$(document).ready( function () {

    var Finalizacion = '<?php echo $HoraDeFinalizacion;?>';
    var time = '<?php echo $tiempo;?>';
    
    const m  = moment(Finalizacion);
    const m2  = moment();

    var time1 = m.diff(m2,"minutes");
    var time2 = parseInt(time);

     var timeout = moment.duration(time1 , 'minutes').timer({
          loop: false
        }, 
        function() { 
          $("#finalizar").click();
          swal("Good job!", "El examen se culmino!", "success");
        }); 

      var timeout = moment.duration(time2 , 'minutes').timer({
          loop: false
        }, 
        function() { 
          $("#finalizar").click();
          swal("Good job!", "El examen se culmino!", "success");
        });

});


</script>


@endsection