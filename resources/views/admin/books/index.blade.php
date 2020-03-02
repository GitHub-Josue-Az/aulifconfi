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
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                    Lista de Libros
                </div>
                <div class="btn-actions-pane-right">
                    <a href="{{ route('admin.books.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Nuevo</a>
                </div>
            </div>
            <div class="card-body">
                
                <table id='table-books' class="table table-borderless table-striped mb-0">
                    <thead>
                        <tr>
                            <th width="40">ID</th>
                            <th>Título</th>
                            <th>Precio</th>
                            <th width="100"></th>
                            <th width="80"></th>
                            <th width="100"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                        <tr>
                            <td>{{ $book->id }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->price }}</td>
                            <td><a href="" class="btn btn-info"><i class="fas fa-eye"></i> Mostrar</a></td>
                            <td><a href="{{ route('admin.books.edit', [$book->id]) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Editar</a></td>
                            <td><a href="javascript:;" onclick="destroy('{{ url('/admin/books', $book->id) }}')" class="btn btn-danger"><i class="fas fa-trash"></i> Eliminar</a></td>
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
    $('#table-books').DataTable({
        "columnDefs": [
            { "orderable": false, "targets": [-1, -2, -3] }
        ]
    });
});
</script>
@endsection