<!DOCTYPE html>
<html lang="en">
<head>
    
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    

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
<body >
  
  <!-- Swiper -->
  <div class="swiper-container" >

    <div class="swiper-wrapper" id="contenido">

    </div>

    <!-- Add Pagination -->
    <div class="swiper-pagination" id="abajo"></div>
  </div>

  <!-- Swiper JS -->
  <script src="{{ asset('bower_components/sliderppt/js/swiper.min.js') }}"></script>

  <!-- Initialize Swiper -->
<script type="text/javascript">


  window.onload = function(e)
  {

    e.preventDefault();
      
        var lesson = '<?php  echo  ($id);?>';
      
        console.log(lesson);

         $.ajax({
          url:'list/'+ lesson,
          success: function (data) {
            if (data == 1) {
        var newDiv = document.getElementById("abajo"); 
        newDiv.style.display = none;
            }
             $('#contenido').append(data); 
          }
       });


    var swiper = new Swiper('.swiper-container', {
        pagination: {
        el: '.swiper-pagination',
        dynamicBullets: true,
      },
         });

  };




 </script>

</body>
</html>


