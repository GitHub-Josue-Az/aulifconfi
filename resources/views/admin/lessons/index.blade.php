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
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                    Lista de Clases
                </div>

                <div class="btn-actions-pane-right">    
                    <a href="{{ route('admin.lessons.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Nuevo</a>
                </div>

            </div>
            <div class="card-body">
                
                <table id='table-lessons' class="table table-borderless table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Título</th>
                            <th width="70">Status</th>
                            <th width="60">Excel</th>
                            <th width="70">Páginas</th>
                            <th width="110">Examen</th>
                            <th width="80">Editar</th>
                            <th width="100">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lessons as $lesson)
                        <tr>

                            <td><img  src="{{route('admin.lessons.image', [$lesson->id])}}" width="130px" height="120px" ></td>
                            <td>{{ $lesson->title }}</td>   
                            <td>{!! $lesson->statusTag !!}</td>
                          <td><a href="{{ route('admin.excel', [$lesson->id]) }}" class="btn btn-success"><i  class="fas fa-file-excel"></i>  Excel</a></td>
                            <td><a href="{{ route('admin.lessons.show', [$lesson->id]) }}" class="btn btn-info"><i class="fas fa-file-alt"></i> Páginas</a></td>
                            <td><a href="{{ route('admin.lessons.questions.index', [$lesson->id]) }}" class="btn btn-info"><i class="fas fa-bars"></i> Examen   </a></td>
                            <td><a href="{{ route('admin.lessons.edit', [$lesson->id]) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Editar</a></td>
                        <td><a hred="{{ route('admin.lessons.destroy', [$lesson->id]) }} " class="btn btn-danger"><i class="fas fa-trash"></i> Eliminar</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                

            <div class="card-footer"></div>
        </div>
    </div>
    
</div>
@endsection

@section('javascript')
<script>
$(document).ready( function () {
    $('#table-lessons').DataTable({
        "columnDefs": [
            { "orderable": false, "targets": [-1, -2, -3] }
        ]
    });
});
</script>
@endsection