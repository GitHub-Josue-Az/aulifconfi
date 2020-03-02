<?php

namespace App\Http\Controllers\Admin\Reportes;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Http\Request;


class ReportesPersonaController extends Controller
{
   

	public function index(){

	$lessons = Lesson::where('deleted', '<>', 1)->get(); 

	 return view('admin.reportes.persona.index', compact('lessons'));
	}


	public function show($id){

		/* LISTADO DE LECCIONE */
		$lesson = Lesson::where('id', $id)->first();
         $place = $lesson->places_id;
          $management = $lesson->managements_id;
         $charge = $lesson->charges_id;

         $users =  User::when($place, function ($quer, $pla){
                    return $quer->where('places_id', $pla);
                })->when($management, function ($quer, $man) {
                    return $quer->where('managements_id', $man);
                })->when($charge, function ($quer, $char) {
                    return $quer->where('charges_id', $char);
                })->where('deleted',0)->get();


         return view('admin.reportes.persona.show', compact('users','lesson'));
      
	}


	 public function estadistica($userid,$lessonid){

	  $usuario = User::findOrFail($userid);
	  $quiz = Lesson::findOrFail($lessonid);

	  /* Nombre Modulo */
	  $nomMod =  $quiz->title;
	  $nomPer =  $usuario->firstname;
	  	
	  //Asignaciones con este lesson -------- Podria ser first pero puede que el primer examen lo elimne
      $asignacion = $quiz->assignments; 

      //submision en el array    
      if(isset($asignacion[0]->id) == false){
         return redirect()->route('admin.persona.index')->withErrors('Aún no se habilito ninguna asignación');
      } 
      $ids = $asignacion[0]->id;

	  $submission = Submission::where('assignments_id', $ids)->where('users_id',$usuario->id)->first();

	  //EN CASO NO HAYAN RENDIDO EXAMEN
	  if(is_null($submission)){
          return redirect()->route('admin.persona.index')->withErrors('Esta persona aún no rinde el examen');
      }

	  $pivote = $submission->questions()->get();
	  $numPreguntas = count($pivote);

	   $c = 0;
       $i = 0;
       $co = 0;
       $inco = 0;
       $nota = 0;
       $aod = 0;
       $exam = array();

	   foreach ($pivote as $key => $pi) {
                  $tof = $pi->pivot->correct;

                    if( $tof == 1){
                        $co = $co + 1; 
                        $nota = $nota + $pi->pivot->score;
                   }else{
                       $inco = $inco +1;
                   }
              }
           array_push($exam,array($co, $inco)); 

  
    if ($nota >= $asignacion[0]->scoremin) {
        $aod = 1;
    }

	  return view('admin.reportes.persona.estadistica', compact('pivote','numPreguntas','exam','nota','nomMod','nomPer','aod'));

	}





}





























