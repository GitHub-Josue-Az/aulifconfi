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
            @if( $estado == 1 )
                    <h3 align="left">Examen en curso </h3> 
                    <br>
                @endif
        <div class="mb-3 card">

            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                    Lista de Preguntas
                </div>

                <div class="btn-actions-pane-right">
                    <a href="{{ route('admin.lessons.questions.create', $lesson->id) }}" class="btn btn-success"><i class="fas fa-plus"></i> Nuevo</a>
                </div>
            </div>

            <div class="card-body">
                

                <table id='table-questions' class="table table-borderless table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Enunciado</th>
                        

                            <th>Nota</th>
                           
                        @if( $estado == 0 )
                            <th width="80">Editar</th>
                            <th width="100">Eliminar</th>
                        @endif

    
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach($questions as $question)
                        <tr>
                            
                        
                            <td>{{ $question->score }}  </td>

                        @if( $estado == 0 )
                    
                            <td><a href="{{ route('admin.lessons.questions.edit', [$lesson->id, $question->id]) }}" class="btn btn-warning" title="Editar"><i class="fas fa-edit"></i> Editar</a></td>

                            <td><a href="javascript:;" onclick="destroy('{{ route('admin.lessons.questions.destroy', [$lesson->id, $question->id]) }}')" class="btn btn-danger" title="Eliminar"><i class="fas fa-trash"></i> Eliminar</a></td>

                        @endif

                        </tr>
                        @endforeach

                         @if($questions->isNotEmpty())
                         <th style="text-align: right;">Nota maxima: </th> <th> {!! $maximo !!}</th>
                         @endif

                    </tbody>
                </table>
                

            </div>
            
            <div class="card-footer"></div>
        </div>

    </div>
    
</div>
@endsection

@section('javascript')
<script>
$(document).ready( function () {
    $('#table-questions').DataTable({
        "columnDefs": [
            { "orderable": false, "targets": [-1, -2] }
        ]
    });
});
</script>
@endsection