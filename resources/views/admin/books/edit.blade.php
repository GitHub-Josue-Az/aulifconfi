@extends('layouts.app')

@section('title')
<div class="page-title-icon">
    <i class="pe-7s-notebook"></i>
</div>
<div>Gestor de Libros</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        {!! Form::model($book, ['method' => 'PUT', 'route' => ['admin.books.update', $book->id], 'files' => true,]) !!}
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                    Editar Libro
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
                
                <div class="form-group">
                    {!! Form::label('price', 'Precio*', ['class' => 'control-label']) !!}
                    {!! Form::number('price', old('price'), ['class' => 'form-control ' . ($errors->has('price')?'is-invalid':''), 'step' => .01, 'maxlength' => 100, 'required' => '']) !!}
                    @error('price')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @endif
                </div>
                
                <div class="form-group">
                    {!! Form::label('file', 'Imagen', ['class' => 'control-label']) !!}
                    {!! Form::file('file', ['class' => 'form-control-file ' . ($errors->has('file')?'is-invalid':'')]) !!}
                    @error('file')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @endif
                    @if(isset($book->image))
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="file-delete" name="file-delete" value="1" onclick="toggle('file')"> Eliminar
                        </label>
                        <a href="{{ route('admin.books.image', $book->id) }}" class="btn btn-link" target="_blank"><i class="fa fa-download"></i> Descargar</a>
                    </div>
                    @endif
                </div>
                
                <div class="form-group">
                    {!! Form::label('lessons[]', 'Clases*', ['class' => 'control-label']) !!}
                    {!! Form::select('lessons[]', $lessons, old('lessons'), ['class' => 'form-control select2 ' . ($errors->has('lessons[]')?'is-invalid':''), 'multiple' => 'multiple']) !!}
                    @error('lessons[]')
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
    $('[name="lessons[]"]').selectize();
});
function toggle(id){
    if($('#' + id + '[disabled]').length){
        $('#' + id).prop('disabled', false);
    }else {
        $('#' + id).prop('disabled', true);
    }
}
</script>
@endsection