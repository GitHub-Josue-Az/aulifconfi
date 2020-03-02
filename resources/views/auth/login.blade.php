@extends('layouts.guest')

@section('content')

<div class="container" >


    <div  class="row" >

         <div class="col-sm-1"></div>

        <div class="col-sm-7">

                <img src="/img/login1.jpg"  height="100%" width="100%">

        </div>


        <div class="col-sm-4" >
           
           <!-- PARA QUE SIRVE : ESTO NOS MANDA ERROR EN CASO QUE SE EJECUTE MAL EL LOGIN -->
            @if (session('message'))
                <div class="alert alert-danger" role="alert">
                    <a class="close" data-dismiss="alert" href="#">×</a>{{ session('message') }}
                </div>
            @endif
            
            <div class="card" >

                <div  class="card-header text-center bg-dark text-white">
                  <h5 class="mx-auto w-100">{{ __('Login') }}</h5>
                 </div>

                <div class="card-body" >
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        
                        <div class="form-group row">
                        </div>


                        <div class="form-group row text-center">
                            <h5 class="mx-auto w-1oo">Ingrese sus credenciales</h5>
                        </div>
                        

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('DNI') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Ingresar') }}
                                </button>

                            </div>
                        </div>
                        
                        <div class="form-group row">
                        </div>
                         <div class="form-group row">
                        </div>
                        
                        <div class="form-group row text-center">
                            <h6 class="mx-auto w-1oo">Si no posee credenciales comunicarse con el encargado</h6>
                        </div>
                    </form>

                </div>

            </div>

        </div>


        </div>
</div>

<div class="container">
    

</div>

@endsection
