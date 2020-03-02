@extends('layouts.app')

@section('title')
<div class="page-title-icon">
    <i class="pe-7s-notebook"></i>
</div>
<div>Gestor de Clases</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        {!! Form::model($lesson, ['method' => 'PUT', 'route' => ['admin.lessons.update', $lesson->id], 'files' => true,]) !!}
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                    Editar Clase
                </div>
            </div>
            <div class="card-body">
                
                <div class="form-group">
                    {!! Form::label('title', 'Título*', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control ' . ($errors->has('title')?'is-invalid':''), 'maxlength' => 100, 'required' => '']) !!}
                    @error('title')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @endif
                </div>
                
                <!--<div class="form-group">
                    {!! Form::label('price', 'Precio*', ['class' => 'control-label']) !!}
                    {!! Form::number('price', old('price'), ['class' => 'form-control ' . ($errors->has('price')?'is-invalid':''), 'step' => .01, 'maxlength' => 100, 'required' => '']) !!}
                    @error('price')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @endif
                </div>-->
                
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