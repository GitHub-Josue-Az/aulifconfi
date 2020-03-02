@extends('layouts.app')


@section('title')
<div class="page-title-icon">
    <i class="pe-7s-home"></i>
</div>
<div>Inicio</div>
@endsection


@section('content')

<div class="row">
    <div class="col-md-4">
               
<form action="fileUpload.blade.php" method="post" enctype="multipart/form-data" files="true" id="form">
					
			@csrf
<input type="file" id="archi" files="true" name="file[]" class="form-control" accept=".ppt,.pdf,.doc,.pptx,.ppsx,.potx,.docx,.dotx" multiple>
				
			<input type="submit" class="btn btn-primary">

		</form>


    </div>

	<div class="col-md-8">
         
        
    </div>

</div>




@endsection
