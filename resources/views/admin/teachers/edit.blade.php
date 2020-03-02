@extends('layouts.app')

@section('title')
<div class="page-title-icon">
    <i class="pe-7s-notebook"></i>
</div>
<div>Gestor de Profesores</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        
        <form action="{{ route('admin.teachers.update', $user->id) }}" method="post" enctype="multipart/form-data">
        
            @csrf
            @method('PUT')
            
            <div class="mb-3 card">
                <div class="card-header-tab card-header-tab-animation card-header">
                    <div class="card-header-title">
                        Editar Profesor
                    </div>
                </div>
                <div class="card-body">

                    <div class="form-group">
                        <label for="firstname">Nombres*</label>
                        <input type="text" id="firstname" name="firstname" value="{{old('firstname', $user->firstname)}}" class="form-control @error('firstname') is-invalid @enderror" maxlength="100" required="">
                        @error('firstname')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="lastname">Apellidos*</label>
                        <input type="text" id="lastname" name="lastname" value="{{old('lastname', $user->lastname)}}" class="form-control @error('lastname') is-invalid @enderror" maxlength="100" required="">
                        @error('lastname')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="lastname">Email*</label>
                        <input type="email" id="email" name="email" value="{{old('email', $user->email)}}" class="form-control @error('email') is-invalid @enderror" maxlength="100" required="">
                        @error('email')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="lastname">Password</label>
                        <input type="password" id="password" name="password" value="" class="form-control @error('password') is-invalid @enderror" maxlength="100">
                        @error('password')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" id="status" name="status" value="1" class="custom-control-input @error('status') is-invalid @enderror" @if(old('status', $user->status) === '1') checked="" @endif>
                            <label class="custom-control-label" for="status">Estado</label>
                        </div>
                        @error('status')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @endif
                    </div>
                    
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary mr-1">Guardar</button>
                    <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancelar</button>
                </div>
            </div>
            
        </form>
        
    </div>
    
</div>
@endsection

@section('javascript')
<script>
$(function(){
    
});
</script>
@endsection