@extends('layouts.app')

@section('title')
<div class="page-title-icon">
    <i class="pe-7s-notebook"></i>
</div>
<br>
<div>{{ $lesson->title }} </div>
@endsection

@section('content')

    
<div class="row">
    <div class="col-md-12">
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                    Lista de personas de este modulo
                </div>
            </div>
            <div class="card-body">
                
                <table id='datatable' class="table table-borderless table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Nombres Completos</th>
                            <th >DNI</th>
                            <th width="120">Estadistica</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->firstname }}</td>
                            <td>{{ $user->email }}</td>
                    <td><a href="{{ route('admin.persona.estadistica', [$user->id, $lesson->id]) }}" class="btn btn-info"><i class="fas fa-chart-bar"></i> Estadistica</a></td>
                            
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
        "columnDefs": [
            { "orderable": false, "targets": [-1, -2, -3] }
        ]
    });
});
</script>
@endsection


