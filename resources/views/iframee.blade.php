<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Swiper demo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

<!-- SliderPpt JS-->
<link href="{{ asset('bower_components/sliderppt/css/swiper.min.css') }}" type="text/css" rel="stylesheet"/>

  <!-- Demo styles -->
  <style>
    html, body {
      position: relative;
      height: 100%;
    }
    body {
      background: #eee;
      font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
      font-size: 14px;
      color:#000;
      margin: 0;
      padding: 0;
    }
    .swiper-container {
      width: 100%;
      height: 100%;
    }
    .swiper-slide {
      text-align: center;
      font-size: 18px;
      background: #fff;

      /* Center slide text vertically */
      display: -webkit-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      -webkit-justify-content: center;
      justify-content: center;
      -webkit-box-align: center;
      -ms-flex-align: center;
      -webkit-align-items: center;
      align-items: center;
    }
  </style>
</head>
<body>
  <!-- Swiper -->
  <div class="swiper-container" >

    <div class="swiper-wrapper" id="contenido">

    </div>
    <!-- Add Arrows -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>

  <!-- Swiper JS -->
 
  <script src="{{ asset('bower_components/sliderppt/js/swiper.min.js') }}"></script>

  <!-- Initialize Swiper -->

<script type="text/javascript">


  window.onload = function(e)
  {

    e.preventDefault();
      
       $.ajax({
          url:'prueba16',
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


    var swiper = new Swiper('.swiper-container', {
         navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
             },
         });

  };




 </script>

</body>
</html>



