<html lang="es">
	<head> 
		<title>ITIC TUTORIALES</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
		<link rel="stylesheet" href="css/estilos.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css">
		<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
		<meta name="csrf-token" content="{{ csrf_token() }}" />

	</head>
	<body>
		<header>
			<div class="alert alert-info">
			<h3>Amazon S3: Carga y descarga de archivos</h3>
			</div>
		</header>

<div class="container">

		<table class="table">
	  		<thead class="bg-primary text-white">
	    		<tr>
	      			<th scope="col">Key</th>
	      			<th scope="col">Bucket</th>
	      			<th scope="col">Tamaño</th>
	      			<th scope="col">Fecha</th>
	      			<th scope="col">Descargar</th>
	    		</tr>
	  		</thead>

	  		<tbody id="contenido">

	  		</tbody>

  		</table>
		
			<form class="form-inline" name="forms" method="post" id="uploadFile" enctype="multipart/form-data" >
				@csrf

	  			<div class="form-group">

	 <input type="file" class="form-control" name="file[]" id="files[]" multiple>
	  			</div>

	  		    <button type="submit" class="btn btn-primary">Cargar</button>
			</form>

	<a href="{{ route('deleteFi') }}" class="btn btn-warning"><i class="fas fa-edit"></i> Editar</a>

		</div> 
</body>
</html>

<script type="text/javascript">

	window.onload = function(e)
	{
		/*$.ajax({

			url: "s3.php",
			success : function(data)
			{
				 $('#contenido').append(data); 
			}
		});*/

		 $.ajax({
          url:'listado',
          success: function (data) {
                     $('#contenido').append(data); 
          },
          statusCode: {
             404: function() {
                alert('web not found');
             }
          },
          error:function(x,xs,xt){
              //nos dara el error si es que hay alguno
              window.open(JSON.stringify(x));
              //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
          }
       });

	};



	$('#uploadFile').submit(function(e)
	{
		e.preventDefault();


		var Form = new FormData($('#uploadFile')[0]);


		$.ajax({
			url : "carga",
			type: "post",
			data: Form,
			processData: false,
			contentType: false,
			success : function(data)
			{
				alert(data);
			}
		});

	}); 


	/*function getFile(key)
	{
		$.ajax({

			url: "s3.php",
			data: {key: key},
			type: "post",
			success: function(data)
			{
				alert('Descarga Correcta!'); 
			}
		});
	}*/


</script>