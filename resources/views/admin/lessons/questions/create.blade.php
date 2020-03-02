@extends('layouts.app')

@section('title')
<div class="page-title-icon">
    <i class="pe-7s-server"></i>
</div>
<div>{{ $lesson->title }} - Gestor de Preguntas</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        {!! Form::open(['method' => 'POST', 'route' => ['admin.lessons.questions.store', $lesson->id], 'files' => true, 'class' => 'needs-validation', 'novalidate' => '']) !!}
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                    Crear Pregunta
                </div>
            </div>
            <div class="card-body">
                
                
                <!-- PARA QUE SIRVE :  NOMBRE DE LA CLASE-->
                <div class="form-group">
                    {!! Form::label('lesson_title', 'Clase', ['class' => 'control-label']) !!}
                    {!! Form::text('lesson_title', old('lesson_title', $lesson->title), ['class' => 'form-control ' . ($errors->has('lesson_title')?'is-invalid':''), 'maxlength' => 100, 'required' => '', 'readonly' => '']) !!}
                    @error('lesson_title')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @endif
                </div>
                
                <!-- PARA QUE SIRVE :  Puntuación -->
                <div class="form-group">
                    {!! Form::label('score', 'Puntuación', ['class' => 'control-label']) !!}
                    {!! Form::number('score', old('score'), ['class' => 'form-control ' . ($errors->has('score')?'is-invalid':''),  'required' => '', 'min'=>"1"]) !!}
                    @error('score')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @endif
                </div>

                
                <!-- PARA QUE SIRVE :  ENUNCIADO -->
                <div class="form-group">
                    {!! Form::label('body', 'Enunciado', ['class' => 'control-label']) !!}
                    {!! Form::textarea('body', old('body'), ['class' => 'form-control ' . ($errors->has('body')?'is-invalid':''), 'required' => '']) !!}
                    @error('body')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @endif
                    <script>
                        
                        /* TRANSFORMA EL TEXT AREA EN UN EDITOR  */
                        var editor = CKEDITOR.replace('body');

                        /* UNA VEZ QUE  [name="body"] ESTE LISTO DEVUELVE TRUE*/
                        editor.on('instanceReady', function(evt){ 
                            $('[name="body"]').attr('required', true);
                        });

                        /* EL CAMPO ES REQUERIDO EN CASO QUE ESTE VACIO */
                        editor.on('required', function(evt) {
                            this.showNotification( 'Este campo es requerido.', 'warning' );
                            evt.cancel();
                        });
                    </script>
                </div>

                
                <div class="row row-answers">
                    <div class="col-1">
                        <label>Rpta.</label>
                    </div>
                    <div class="col-11">
                        <label>Alternativas</label>
                    </div>
                </div>
                

                
                
                <!-- PARA QUE SIRVE :  LISTADO DE LAS OPCIONES -->
                @for ($i = 0; $i < 5; $i++)
                <div class="row row-answers">


                    
                    <!-- PARA QUE SIRVE : RADIO DE SELECCION-----FUNCION DE ABAJO QUE HACE EL COLOR CUANDO SE PULSA  -->
                    <div class="col-1">
                        <div class="form-group">

                            <div class="radio">
                                <label>
                                    <input type="radio" name="correct" value="{{$i}}" onclick="changeAnswer(this)" required=""> <span>{!! Helper::letter($i) !!}</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    
                    <!-- PARA QUE SIRVE :  RESPUESTAS  -->
                    <div class="col-11">
                        <div class="form-group">
                            
                            
                            <!-- PARA QUE SIRVE :  TEXTO AGREGADO   -->
                            <textarea id="answer-{{$i}}" name="answers[]" class="form-control" required=""></textarea>

                            
                            
                            <!-- PARA QUE SIRVE :  FUNCIONES DE CQEDITOR-->
                            <script>
                                var editor = CKEDITOR.replace('answer-{{$i}}');
                                editor.on('instanceReady', function(evt){ 
                                        
                                        /* required atributo y true el valor asi funciona attr */
                                    $('[name="answers[]"]').attr('required', true);
                                });
                                editor.on('required', function(evt) {
                                    this.showNotification( 'Este campo es requerido.', 'warning' );
                                    evt.cancel();
                                });
                            </script>

                        </div>
                    </div>

                </div>
                @endfor

                
            </div>
            <div class="card-footer">
                {!! Form::submit('Guardar', ['class' => 'btn btn-primary mr-1']) !!}
                {!! Form::button('Cancelar', ['class' => 'btn btn-secondary', 'onclick' => 'window.history.back()']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    
</div>
@endsection

@section('javascript')
<script>
$(document).ready( function () {
    
});

function changeAnswer(radio){

    //QUITA EL COLOR VERDE  ----- SINO ESTA ESTO, TODOS SE PINTAN DE VERDE  
    $('.row-answers').removeClass('bg-success'); 
    //AGREGA EL COLOR VERDE A RADIO QUE HAYA SIDO SELECCINADO
    $(radio).closest('.row-answers').addClass('bg-success');
}
</script>

@endsection