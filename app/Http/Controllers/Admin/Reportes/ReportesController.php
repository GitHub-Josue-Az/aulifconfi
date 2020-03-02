<?php

namespace App\Http\Controllers\Admin\Reportes;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Submission;
use Illuminate\Http\Request;


class ReportesController extends Controller
{
   

	public function index(){

		 $lessons = Lesson::where('deleted', '<>', 1)->get(); 

	 return view('admin.reportes.general.index', compact('lessons'));
	
	}


	public function show($id){

      $quiz = Lesson::findOrFail($id);

      //Asignaciones con este lesson -------- Podria ser first pero puede que el primer examen lo elimne
      $asignacion = $quiz->assignments; 

       //LISTA DE ASIGNACIONES
       if ($asignacion->isEmpty()) {
         return redirect()->route('admin.reportes.index')->withErrors('Aún no se habilito ninguna asignación');
      }

      //PRIMER EXAMEN
      if($asignacion[0]->submission->isEmpty() == true){
         return redirect()->route('admin.reportes.index')->withErrors('No se terminó ningun examen');
      } 

      //submision en el array
      $submi = $asignacion[0]->submission;

     $submission = Submission::findOrFail($submi[0]->id);

      $pivote = $submission->questions()->get();
      $numPreguntas = count($pivote);

      $exam2 = array();
      $final = array();

      //Porcentaje general
      $porc = array();
      $corr = 0;
      $incorr = 0;

      // 2 examenes
      foreach ($asignacion as $key1 => $asig) {



         foreach ($asig->submission as $key3 => $asi) {
   
              //EXAMEN 1
              $submission = Submission::findOrFail($asi->id);
              $pivote = $submission->questions()->get();
              $numPreguntas = count($pivote);

                $exam3 = array();
              // 5 RESPUESTAS --------------- PI ES LA PREGUNTA EN EL ARRAY
              foreach ($pivote as $numPre => $pi) { 

                //EN CASO QUE NO HAYA UN ARRAY ENTONCES INICIA CON UNO 
                if (isset($exam2[$numPre]) == false) {
                  $co = 0;
                  $inco = 0; 
                  $tof = $pi->pivot->correct;

                    if( $tof == 1){
                        $co = 1; 
                   }else{
                        $inco = 1;
                   }
                  array_push($exam2,array($co, $inco));

                }else{
                    //PI comienza con el segundo examen
                    $tof2 = $pi->pivot->correct;
                    if (isset($exam) == true) {
                      $co2 = $exam[$numPre][0];  // 1 En el primer array
                      $inco2 = $exam[$numPre][1];  // 0 En el primer array 
                    }else{
                      $co2 = $exam2[$numPre][0];  // 1 En el primer array
                      $inco2 = $exam2[$numPre][1];  // 0 En el primer array 
                    }
                    
                    if( $tof2 == 1){
                       $co2 = $co2 + 1;   // 2  
                   }else{
                       $inco2 = $inco2 + 1;
                   }
                   array_push($exam3,array($co2, $inco2));
                 } 
              }
              $exam = array_replace($exam2,$exam3);
           }  /* --------------  FIN DE UN EXAMEN  ------------------- */
         
      }


      foreach ($exam as $key => $porcen) {
        
         $corr = $corr + $porcen[0]; 
              
         $incorr = $incorr + $porcen[1];
      }

      array_push($porc,array($corr, $incorr));

      return view('admin.reportes.general.show', compact('pivote','numPreguntas','exam','porc'));

	}


}





























