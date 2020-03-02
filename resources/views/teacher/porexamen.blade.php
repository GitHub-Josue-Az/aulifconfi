
      $exam = array();
      $final = array();

foreach ($asignacion as $key1 => $asig) {
            
         foreach ($asig->submission as $key2 => $asi) {

              $submission = Submission::findOrFail($asi->id);
              $pivote = $submission->questions()->get();

              $c = 0;
            $i = 0;
            $co = 0;
            $inco = 0;

              foreach ($pivote as $key => $pi) {
                  $tof = $pi->pivot->correct;

                    if( $tof == 1){
                        $co = $co + 1; 
                   }else{
                       $inco = $inco +1;
                   }
              }
            $c = $c + $co;
            $i = $i + $inco;
            //dd($c,$i);  // 2 -- 0
           array_push($exam,array($c, $i));      

          }   

          array_push($final,$exam);
      }