@extends('layouts.app')

@section('title')
<div class="page-title-icon">
    <i class="pe-7s-notebook"></i>
</div>
<br>
<div>Reporte de los modulos </div>
@endsection

@section('content')

     <div  class="row">
        @foreach ($lessons as $lesson)
            
            <div class="col-sm-4">

                <div class="card" style="width: 18rem;">
                   
                     <div  class="card-header text-center bg-warning text-white">
                         <h5 class="mx-auto w-100">{{ $lesson->title }}</h5>
                    </div>

                     <div class="card-body">
                        <img  src="{{route('student.modulos.image', [$lesson->id])}}" width="230px" height="220px" ><br><br>
                        <a href="{{ route('admin.persona.show', [$lesson->id]) }}" class="btn btn-success"><i class="fas fa-file-alt"></i> Detalle </a>
                    </div>
               
                 </div>
                 <br><br><br>

           </div>

          @endforeach

        </div>



@endsection


