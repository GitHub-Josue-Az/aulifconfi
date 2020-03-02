
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
        <form action="{{ route('admin.asignacion.store') }}" method="post" enctype="multipart/form-data">
        
            @csrf
        <div class="mb-3 card">

            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                    Asignar
                </div>
            </div>

            <div class="card-body">
                
                
                    <div class="form-group">
                        <label for="title">Titulo</label>

               <!-- PARA QUE SIRVE : EL NAME AYUDA PARA VER EL ERROR      DESPUES DEL FORM CONTROL ES PARA VALIDAR LADO DEL CLIENTE-->
                        <input type="text" id="title" name="title" value="{{old('title')}}" class="form-control @error('title') is-invalid @enderror" maxlength="100" required="">
                        @error('title')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @endif
                    </div>

                    <div class="form-group ">
                         <label for="lessons"> Capacitaciones </label>
                         <br>
                             <select  class="form-control" name="lessons_id" id="lessons_id">
                                @foreach ($lessons as $lesson)
                                     <option value={{$lesson->id}}> {{$lesson->title}}</option>
                                 @endforeach
                              </select>

                         @error('lessons')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                         @endif
                    </div>

            <br>

                <div class="form-group" >
                    <div class="row justify-content-md">
                        <div class="col col-lg-2">

                             <label>Inicio Examen: <input type="text" id="startdate"  name="startdate" value="{{old('startdate')}}" class="form-control @error('startdate') is-invalid @enderror" maxlength="100" required=""></label>
                                @error('startdate')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                         @endif
                        </div>
                            <div class="col-md-auto">
                             </div>
                     <div class="col col-lg-2">

                           <label >Finalizacion Examen: <input type="text" id="enddate" name="enddate" value="{{old('enddate')}}" class="form-control @error('enddate') is-invalid @enderror" maxlength="100" required=""></label>
                            @error('enddate')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                         @endif
                     </div>
                   </div>
                </div>

    <br>

                 <div class="form-group" >
                    <div class="row justify-content-md">
                        <div class="col col-lg-2">

                             <label> Tiempo del examen <input type="number"  min="5" id="tiempo"  name="tiempo" value="{{old('tiempo')}}" class="form-control @error('tiempo') is-invalid @enderror" required=""></label>
                                @error('tiempo')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                         @endif
                        </div>
                   </div>
                </div>

                <div class="form-group">
                        <label for="scoremin">Puntación minima para aprobar</label>

               <!-- PARA QUE SIRVE : EL NAME AYUDA PARA VER EL ERROR      DESPUES DEL FORM CONTROL ES PARA VALIDAR LADO DEL CLIENTE-->
                 <input type="number" id="scoremin" name="scoremin" value="{{old('scoremin')}}" class="form-control @error('scoremin') is-invalid @enderror" min="1" required="" style="width: 15%">
                   @error('scoremin')
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


<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js"></script>
<script src="{{ asset('bower_components/jquery/dist/jquery.datetimepicker.full.min.js') }}"></script>


<script type="text/javascript">
   

  $(function () {
       $('#startdate').datetimepicker({
        timepicker: true,
        datepicker : true,
        format : 'Y-m-d H:i',
        onShow: function(ct){
            this.setOptions({
                maxDate: $('#enddate').val() ? $('#enddate').val() : false
            })
        }
     })
    });

  $(function () {
    $('#enddate').datetimepicker({
        timepicker: true,
        datepicker : true,
        format : 'Y-m-d H:i',
        onShow: function(ct){
            this.setOptions({
                minDate: $('#startdate').val() ? $('#startdate').val() : false
            })
        }
    })
     });

</script>

@endsection