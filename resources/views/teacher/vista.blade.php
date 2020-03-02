@extends('layouts.app')

@section('title')
<div class="page-title-icon">
    <i class="pe-7s-notebook"></i>
</div>
<div align="center"><h1> pruebas </h1></div>
@endsection

@section('content')

    

<div id="container" style="width: 75%;">
    <canvas id="canvas"></canvas>
  </div>
  <button id="randomizeData">Randomize Data</button>
  <button id="addDataset">Add Dataset</button>
  <button id="removeDataset">Remove Dataset</button>
  <button id="addData">Add Data</button>
  <button id="removeData">Remove Data</button>
  <script>
    var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    var color = Chart.helpers.color;
    var horizontalBarChartData = {
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [{
        label: 'Dataset 1',
        backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
        borderColor: window.chartColors.red,
        borderWidth: 1,
        data: [
          1,
          1,
          1,
          1,
          1,
          1,
          1
        ]
      }, {
        label: 'Dataset 2',
        backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
        borderColor: window.chartColors.blue,
        data: [
          1,
          1,
          1,
          1,
          1,
          1,
          1
        ]
      }]

    };

    window.onload = function() {
      var ctx = document.getElementById('canvas').getContext('2d');
      window.myHorizontalBar = new Chart(ctx, {
        type: 'horizontalBar',
        data: horizontalBarChartData,
        options: {
          // Elements options apply to all of the options unless overridden in a dataset
          // In this case, we are setting the border of each horizontal bar to be 2px wide
          elements: {
            rectangle: {
              borderWidth: 2,
            }
          },
          responsive: true,
          legend: {
            position: 'right',
          },
          title: {
            display: true,
            text: 'Chart.js Horizontal Bar Chart'
          }
        }
      });

    };

  </script>





<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<script type="text/javascript">

	//2020-01-25 11:24:00
	var time = '<?php echo $dt;?>';

	//2020-01-24 16:10:49
	const m  = moment(time);
	const m2  = moment();


	console.log(m.diff(m2,"minutes"));

	swal({
  		title: "Are you sure?",
  			text: "Once deleted, you will not be able to recover this imaginary file!",
  		icon: "warning",
 		 buttons: true,
 		 dangerMode: true,
		})
			.then((willDelete) => {
 				 if (willDelete) {
  				  swal("Poof! Your imaginary file has been deleted!", {
     			 icon: "success",
   			 });
  			} else {
   		 swal("Your imaginary file is safe!");
  		}
		});




 /* var areYouReallySure = false;
function areYouSure() {
    if(allowPrompt){
        if (!areYouReallySure && true) {
            areYouReallySure = true;
            var confMessage = "retorno vacioakaksasadmksdmaksdakmosdakomdkosakom";
            return confMessage;
        }
    }else{
        allowPrompt = true;
    }
}

var allowPrompt = true;
window.onbeforeunload = areYouSure; */


</script>


@endsection



