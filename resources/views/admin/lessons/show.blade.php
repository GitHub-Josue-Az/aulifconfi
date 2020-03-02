@extends('layouts.app')

@section('title')
<div class="page-title-icon">
    <i class="pe-7s-notebook"></i>
</div>
<div>{{ $lesson->title }} - Páginas</div>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        
        {!! Form::model($lesson, ['method' => 'PUT', 'route' => ['admin.lessons.pages', $lesson->id], 'files' => true,]) !!}
        <div class="main-card mb-3 card">

            <div class="card-header">
                Editar Páginas
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

                    
                    <!-- PARA QUE SIRVE : MODULO TEORIA -->
                    <div class="tab-pane active" id="tab-theory" role="tabpanel">
                        {!! Form::label('theory', 'Seleccione el contenido para editar.', ['class' => 'control-label']) !!}
                        
                        {!! Form::textarea('theory', old('theory', ($lesson->theory)?$lesson->theory->body:''), ['placeholder' => 'No se ha ingresado un contenido aún']) !!}
                        @error('theory')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @endif
                        <script>
                            CKEDITOR.inline( 'theory' );
                        </script>
                    </div>


                    <!-- PARA QUE SIRVE : MODULO TEORIA -->
                    <div class="tab-pane" id="tab-practice" role="tabpanel">
                        {!! Form::label('practice', 'Seleccione el contenido para editar.', ['class' => 'control-label']) !!}

                        {!! Form::textarea('practice', old('practice', ($lesson->practice)?$lesson->practice->body:''), ['placeholder' => 'No se ha ingresado un contenido aún']) !!}
                        @error('practice')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @endif
                        <script>
                            CKEDITOR.inline( 'practice' );
                        </script>
                    </div>


                 <!--     <div class="tab-pane" id="tab-reforce" role="tabpanel">
                        {!! Form::label('reforce', 'Seleccione el contenido para editar.*', ['class' => 'control-label']) !!}

                        {!! Form::textarea('reforce', old('reforce', ($lesson->reforce)?$lesson->reforce->body:''), ['placeholder' => 'No se ha ingresado un contenido aún']) !!}
                        @error('reforce')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @endif
                        <script>
                            CKEDITOR.inline( 'reforce' );
                        </script>
                    </div>-->
                    

                </div>
            </div>


            <div class="d-block card-footer">
                {!! Form::submit('Guardar Páginas', ['class' => 'btn btn-primary mr-1']) !!}
                {!! Form::button('Cancelar', ['class' => 'btn btn-secondary', 'onclick' => 'go("' . route('admin.lessons.index') . '")']) !!}
            </div>


        </div>
        {!! Form::close() !!}
        
    </div>
    
</div>
@endsection