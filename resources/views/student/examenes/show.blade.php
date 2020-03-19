@extends('layouts.app')

@section('title')
<div class="page-title-icon">
    <i class="pe-7s-notebook"></i>
</div>
<div align="center"><h1> Evaluaciones </h1></div>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        

        @if ( $estado == 1 && $quiz->isEmpty() == true )

        
        <div class="mb-3 card">

        <h4>El examen se encuentra habilitado, tener precauciones con el tiempo </h4>

        <br> <br> <br>
    
        <div  style="text-align: center">
               <a  href="{{ route('student.evaluacion.show2', [$lesson, $assignacion]) }}" class="btn btn-info"><i class="fas fa-bars"></i> Realizar evaluación</a>
         </div>

        </div>
         
        @elseif ( $quiz->isEmpty()  == false )
            
            Usted ya realizo un examen!
        
        @else

            El examen no esta habilitado! 
    

        @endif



    </div>
</div>

@endsection