@extends('layouts.app')


@section('title')
<div class="page-title-icon">
    <i class="pe-7s-home"></i>
</div>
<div>Inicio</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        
        <div class="card">
            <div class="card-body text-center">
                <div class="display-4 text-bold">Bienvenido {{Auth::user()->role->title}} {{Auth::user()->firstname}}</div>
            </div>
        </div>
        
    </div>
</div>
@endsection
