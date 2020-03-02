@extends('layouts.app')

@section('title')
<div class="page-title-icon">
    <i class="pe-7s-notebook"></i>
</div>
<div>Gestor de Aulas</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        {!! Form::model($classroom, ['method' => 'PUT', 'route' => ['teacher.classrooms.update', $classroom->id], 'files' => true,]) !!}
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                    Editar Aula
                </div>
            </div>
            <div class="card-body">
                
                <div class="form-group">
                    {!! Form::label('title', 'Título*', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'maxlength' => 100, 'required' => '']) !!}
                    @error('title')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @endif
                </div>
                
                <div class="form-group"><!-- populate multiple select with pluck: https://stackoverflow.com/a/42881289/2823916 -->
                    {!! Form::label('students[]', 'Alumnos*', ['class' => 'control-label']) !!}
                    {!! Form::select('students[]', $students, old('students', $classroom->enrollments->pluck('users_id')->toArray()), ['class' => 'form-control select2 ' . ($errors->has('students[]')?'is-invalid':''), 'multiple' => 'multiple']) !!}
                    @error('students[]')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @endif
                </div>
                
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
$(function(){
    $('[name="students[]"]').selectize();
});
</script>
@endsection