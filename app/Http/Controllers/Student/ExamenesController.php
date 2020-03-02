<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Assignments;
use App\Models\Lesson;
use App\Models\Question;
use App\Models\Quizsubmission;
use App\Models\Submission;
use Illuminate\Http\Request;

class ExamenesController extends Controller
{


    public function index(){
        	
        $assi = Assignments::where('deleted', 0)->get();
        
        return view('admin.asignacion.index', compact('assi'));
    }


    public function show($id){

    	$lesson= $id;
        $usuario = auth()->user()->id;

        /* PASAR LA HORA PARA QUE EL JAVASCRIPT DETECTE EL TIEMPO MAXIMO */
        /* Detecta la hora actual   FORMATO: Y-m-d H:i */
        $dt = date("Y-m-d H:i:s");

        /* HABILITADO O NO HABILITADO */
        $estado = 0;
        $assignacion = null;

        /* Hora final de asignacion del examen */

        /* Ver en caso no hay assignment */
        $final= Assignments::with('lesson')->where('lessons_id',$lesson)->get();

        if($final->isEmpty()){
            return redirect()->route('student.modulos');
        }

        foreach ($final as $key => $value) {
           $HoraDeFinalizacion= $value->enddate;
             $HoraInicio = $value->startdate;

              /* 1 significa que aun debe estar habilitado */
             if($dt<$HoraDeFinalizacion && $dt >= $HoraInicio ){
                     $estado = 1 ;
                    $assignacion = $value->id;
             }
         } 

    /* EN CASO QUE EXISTA UN EXAMEN YA HECHO */
     $quiz = Submission::with('assignment')->where('assignments_id',$assignacion)->where('users_id', $usuario)->get(); 

    return view('student.examenes.show', compact('estado','quiz','lesson','assignacion'));
    
    }


 		public function show2($lessonid,$assignacionid){

            $usuario = auth()->user()->id;
 			/* TODAS LAS PREGUNTAS */
 			$preguntas = Question::with('lesson')->where('lessons_id', $lessonid )->get();
             $dt = date("Y-m-d H:i:s");

            /* Submission que sea nulo */
            $assignacion = Assignments::findOrFail($assignacionid);

            /* AGREGAR TIEMPO DE EXAMEN 20MIN 30 O 1H  */ 
            $tiempo = $assignacion->tiempo; 
            $HoraDeFinalizacion= $assignacion->enddate;
            $HoraInicio = $assignacion->startdate;

    /* EN CASO QUE EXISTA UN EXAMEN YA HECHO */
    $quiz = Submission::with('assignment')->where('assignments_id',$assignacion->id)->where('users_id', $usuario)->get();

              /* 1 significa que aun debe estar habilitado */
       if($dt<=$HoraDeFinalizacion && $dt >= $HoraInicio && $quiz->isEmpty() == true ){
         return view('student.examenes.show2', compact('preguntas','assignacion','lessonid','HoraDeFinalizacion','tiempo')); 
        }

            return redirect()->route('student.modulos');
 		}



     public function store(Request $request){


        $dt = date("Y-m-d H:i:s");
        $assigid = $request->get('assignacionid');
        $lessid = $request->get('lessonid');
        $respuestas = $request->get('correct'); /*Respuestas del examen --- Trae null cuando o hay nada */
        $preguntas = Question::with('answers')->where('lessons_id', $lessid )->get();

        $submis = new Submission;
        $submis->assignments_id = $request->get('assignacionid');
        $submis->users_id = auth()->user()->id; 
        $submis->save(); 

       foreach($preguntas as $numPregunta => $contenidopregunta)
             {
              $correcto = 0;
              /*Nota aqui ya que es por question y no por answer por eso no va dentro*/
              $score = 0;

            foreach($contenidopregunta->answers as $numRespuesta => $contenidorespuesta)
                 {
                    $myAnswerIn = 91; /* Numero alternativo no debe ser menor a 10 */
                    /*  Si todas las respuestas son null */
                    if($respuestas == null){
                        $myanswerid = null;
                    }else{
                      $myAnswer = isset($respuestas[$numPregunta][0]); /* Isset devuelve false si no hay valores */ 
                      if($myAnswer  == false ){
                             $myanswerid = null;
                       } else{
                            $myAnswerIn = $respuestas[$numPregunta][0];  /* NUMERO EN EL ARRAY DE RESPUESTAS*/
                            $myanswerid = $contenidopregunta->answers[$myAnswerIn]->id;
                        }   
                    }
             
             $correctas = $contenidorespuesta->correct;/* LISTA DE RESPUESTAS POR CORRECT */
                if($correctas == 1){
                    if($myAnswerIn == $numRespuesta){
                             $correcto = 1;
                             /* AQUI OBTIENES ->NOTA Y LO PONES EN SCORE */
                            $score = $contenidopregunta->score;
                           }
                        $answerid = $contenidorespuesta->id;
                      } 
                  }

    $submis->questions()->attach($preguntas[$numPregunta]->id,['answers_id' => $answerid,'myanswers_id' => $myanswerid,'correct'=>$correcto,'score'=>$score]);           
             }

        return redirect()->route('student.modulos');
     }



}

