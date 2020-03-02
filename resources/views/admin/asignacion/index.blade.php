@extends('layouts.app')

@section('title')
<div class="page-title-icon">
    <i class="pe-7s-notebook"></i>
</div>
<div>Gestor de Asignaciones</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="mb-3 card">

            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                    Lista de Asignaciones de Examenes
                </div>
                <div class="btn-actions-pane-right">
                    <a href="{{ route('admin.asignacion.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Nuevo</a>
                </div>
                
            </div>

            <div class="card-body">
                
                <table id='table-lessons' class="table table-borderless table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th> Capacitación </th>
                            <th> Hora de Inicio </th>
                            <th> Hora de finalización </th>
                            <th width="100">Mostar</th>
                            <th width="80">Editar</th>
                            <th width="100">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assi as $assi)
                        <tr>
                            <td>{{ $assi->title }}</td>
                            <td>{{ $assi->lesson->title }}</td>
                            <td>{{ $assi->startdate }}</td>
                            <td>{{ $assi->enddate }}</td>
                            <td><a href="" class="btn btn-info"><i class="fas fa-eye"></i> Mostrar</a></td>
                            <td><a href="{{ route('admin.asignacion.edit', [$assi->id]) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Editar</a></td>
                            <td><a href="{{ route('admin.asignacion.destroy', [$assi->id]) }}" class="btn btn-danger"><i class="fas fa-trash"></i> Eliminar</a></td>
                        </tr>
                     @endforeach

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
    $('#table-lessons').DataTable({
        "columnDefs": [
            { "orderable": false, "targets": [-1, -2, -3] }
        ]
    });
});
</script>
@endsection