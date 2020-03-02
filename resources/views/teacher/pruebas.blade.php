@extends('layouts.app')

@section('title')


@endsection

@section('content')

    

<script type="text/javascript">
	
<?php
$array = array(
    "foo" => "bar",
    42    => 24,
    "multi" => array(
         "dimensional" => array(
             "array" => "foo"
         )
    )
);

$array = array(
    "examen1" => array(
         "pre1" => array(
             "r" => 1
         ),
         "pre2" => array(
              "r" => 1
         )
    ),
    "examen2" => array(
          "pre1" => array(
 				"r" => 0
 	      ),
         "pre2" => array(
 				"r" => null 
 	       )
    ),
    "examen3" => array(
          "pre1" => array(
 				"r" => null 
 	       ),
         "pre2" => array(
 				"r" => 1   
 	      )
    ),
     "examen4" => array(
          "pre1" => array(
 				"r" => 1
 	       ),
         "pre2" => array(
 				"r" => 1   
 	      )
    )
);

		$exam = array();

		foreach ($array as $key1 => $examenes) {

		$c = 0;
		$i = 0;
		$co = 0;
		$inco = 0;

			foreach ($examenes as $key2 => $pre) {

				if( $pre["r"] == 1){
					$co = $co + 1; 
				}else{
					$inco = $inco +1;
				}

			}
			$c = $c + $co;
			$i = $i + $inco;
			//dd($c,$i);	// 2 -- 0
		
			array_push($exam,array($c, $i));

		}

dd($exam);
	
dd($array["examen1"]["pre2"]["r"]);	


var_dump($array["foo"]);
var_dump($array[42]);
var_dump($array["multi"]["dimensional"]["array"]);

?>

</script>


@endsection














