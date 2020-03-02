@extends('layouts.app')

@section('title')
<div class="page-title-icon">
    <i class="pe-7s-notebook"></i>
</div>
<div>Gestor de Usuarios</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <form action="{{ route('admin.students.store') }}" method="post" enctype="multipart/form-data">
        
            @csrf
            
            <div class="mb-3 card">
                <div class="card-header-tab card-header-tab-animation card-header">
                    <div class="card-header-title">
                        Crear Usuario
                    </div>
                </div>
                <div class="card-body">

                    <div class="form-group">
                        <label for="firstname">Nombres y apellidos</label>

               <!-- PARA QUE SIRVE : EL NAME AYUDA PARA VER EL ERROR      DESPUES DEL FORM CONTROL ES PARA VALIDAR LADO DEL CLIENTE-->
                        <input type="text" id="firstname" name="firstname" value="{{old('firstname')}}" class="form-control @error('firstname') is-invalid @enderror" maxlength="100" required="">
                        @error('firstname')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="lastname">DNI</label>
                        <input type="string" id="email" name="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" maxlength="100" required="">
                        @error('email')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @endif
                    </div>

                     <div class="form-group ">
                         <label for="places">Lugar de trabajo</label>
                         <br>
                             <select  class="form-control" name="places_id" id="places_id">
                                @foreach ($places as $place)
                                     <option value={{$place->id}}> {{$place->title}}</option>
                                 @endforeach
                              </select>

                         @error('places')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                         @endif
                    </div>

                    <div class="form-group ">
                         <label for="managements">Gerencias</label>
                         <br>
                             <select  class="form-control" name="managements_id" id="managements_id">
                                @foreach ($managements as $management)
                                     <option value={{$management->id}}> {{$management->title}}</option>
                                 @endforeach
                              </select>

                         @error('managements')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                         @endif
                    </div>

                    <div class="form-group ">
                         <label for="charges">Cargos</label>
                         <br>
                             <select  class="form-control" name="charges_id" id="charges_id">
                                @foreach ($charges as $charge)
                                     <option value={{$charge->id}}> {{$charge->title}}</option>
                                 @endforeach
                              </select>

                         @error('charges')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                         @endif
                    </div>
                    
                    <div class="form-group">
                        <label for="Password">Password</label>
                        <input type="password"  name="password" value="" class="form-control @error('password') is-invalid @enderror" maxlength="100" required="">
                        @error('password')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirmar Password</label>
                        <input type="password"  name="password_confirmation" value="" class="form-control @error('password_confirmation') is-invalid @enderror" maxlength="100" required="">
                        @error('password_confirmation')
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