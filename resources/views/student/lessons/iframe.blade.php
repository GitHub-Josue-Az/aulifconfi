<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Swiper demo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <link rel="stylesheet" href="css/estilos.css">
    
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    
    <meta name="csrf-token" content="{{ csrf_token() }}" />

<!-- SliderPpt JS-->
<link href="{{ asset('bower_components/sliderppt/css/swiper.min.css') }}" type="text/css" rel="stylesheet"/>

  <!-- Demo styles -->
  <style>
    html, body {
      position: relative;
      height: 95%;
    }
  
    .swiper-container {
      width: 100%;
      height: 100%;
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
      
        var lesson = '<?php  echo  ($id);?>';
      

         $.ajax({
          url:'list/'+ lesson,
          success: function (data) {
                     $('#contenido').append(data); 
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



