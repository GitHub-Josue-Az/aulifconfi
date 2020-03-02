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
        {!! Form::open(['method' => 'POST', 'route' => ['admin.lessons.store'], 'files' => true,]) !!}
        <div class="mb-3 card">

            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                    Crear Clase
                </div>
            </div>

            <div class="card-body">

                <div class="form-group">
                    {!! Form::label('title', 'Título', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control ' . ($errors->has('title')?'is-invalid':''), 'maxlength' => 100, 'required' => '']) !!}
                    @error('title')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @endif
                </div>

              <div class="form-group ">
                         <label for="places">Lugar de trabajo</label>
                         <br>
                             <select  class="form-control @error('places') is-invalid @enderror"  name="places_id" id="places_id">
                                <option  value= {{ $lessons }} > Lugar de trabajo </option>
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
                             <select  class="form-control @error('managements') is-invalid @enderror"  name="managements_id" id="managements_id">
                                <option value= {{ $lessons }}>Gerencias</option>
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
                             <select  class="form-control @error('charges') is-invalid @enderror" name="charges_id" id="charges_id">
                                <option value= {{ $lessons }}> Gestion </option>
                                @foreach ($charges as $charge)
                                     <option value={{$charge->id}}> {{$charge->title}}</option>
                                 @endforeach
                              </select>

                         @error('charges')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                         @endif
                    </div>

            <div class="form-group">
                    {!! Form::label('file', 'Imagen', ['class' => 'control-label']) !!}
                    {!! Form::file('file', ['class' => 'form-control-file ' . ($errors->has('file')?'is-invalid':''), 'required' => '']) !!}
                    @error('file')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @endif
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Guardar', ['class' => 'btn btn-primary mr-1']) !!}
                {!! Form::button('Cancelar', ['class' => 'btn btn-secondary', 'onclick' => 'window.history.back()']) !!}
            </div>

        </div>
        {!! Form::close() !!}
    </div>
    
</div>
@endsection

