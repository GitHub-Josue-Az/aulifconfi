@extends('layouts.app')

@section('title')
<div class="page-title-icon">
    <i class="pe-7s-notebook"></i>
</div>
<div>Gestor de Administradores</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                    Lista de Administradores
                </div>
                <div class="btn-actions-pane-right">
                    <a href="{{ route('admin.administrators.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Nuevo</a>
                </div>
            </div>
            <div class="card-body">
                
                <table id='datatable' class="table table-borderless table-striped mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombres Completos</th>
                            <th>DNI</th>
                            <th>Estado</th>
                            <th width="100">Mostar</th>
                            <th width="80">Editar</th>
                            <th width="100">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->firstname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{!! $user->statusTag !!}</td>
                            <td><a href="" class="btn btn-info"><i class="fas fa-eye"></i> Mostrar</a></td>
                            <td><a href="{{ route('admin.administrators.edit', [$user->id]) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Editar</a></td>
                            <td><a href="javascript:;" onclick="destroy('{{ url('/admin/administrators', $user->id) }}')" class="btn btn-danger"><i class="fas fa-trash"></i> Eliminar</a></td>
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
    $('#datatable').DataTable({
         responsive: true,
        "columnDefs": [
            { "orderable": false, "targets": [-1, -2, -3] }
        ]
    });
});
</script>
@endsection