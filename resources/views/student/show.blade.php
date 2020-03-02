@extends('layouts.app')

@section('title')
<div class="page-title-icon">
    <i class="pe-7s-notebook"></i>
</div>
<div>{{ $lesson->title }} - Modulo</div>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        
        <div class="main-card mb-3 card">

            <div class="card-header">
               
                <div class="btn-actions-pane-right">
                    <div class="nav">
                        <a data-toggle="tab" href="#tab-theory" class="border-0 btn-transition btn btn-outline-primary active">Teoría</a>
                        <a data-toggle="tab" href="#tab-practice" class="mr-1 ml-1 border-0 btn-transition btn btn-outline-primary">Ejercicios de aprendizaje</a>
            <!--   <a data-toggle="tab" href="#tab-reforce" class="border-0 btn-transition btn btn-outline-primary">Ejercicios de refuerzo</a> -->
                          
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="tab-content">

                    <div class="tab-pane active" id="tab-theory" role="tabpanel">


                        <!-- PARA QUE SIRVE : SI EXISTE LESSON-TEORY QUE TE TRAIGA SU CUERPO SINO LO DEJAS EN VACIO -->
                        <!--  Form::textarea('theory', old('theory', ($lesson->theory)?$lesson->theory->body:''), ['placeholder' => 'No se ha ingresado un contenido aún'])  -->

                        {!! $lesson->theory?$lesson->theory->body:'No se ha ingresado un contenido aún' !!}
                        @error('theory')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @endif
                    </div>

                    <div class="tab-pane" id="tab-practice" role="tabpanel">
                        
                        {!! $lesson->practice?$lesson->practice->body:'No se ha ingresado un contenido aún' !!}
                        @error('practice')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @endif

                    </div>

                    

                </div>
            </div>

        </div>
        {!! Form::close() !!}
        
    </div>
    
</div>

<div style="text-align: right;">
    <a style="font-size: 150%; padding-right: 3%" href="{{ route('student.examenes.show', [$lesson->id]) }}" class="btn btn-info"><i  style="padding-right: 15%;" class="fas fa-bars"></i> Examen</a>
</div>
 

@endsection