<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Assignments;
use App\Models\Lesson;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Log;

class LessonsQuestionsController extends Controller
{ 
    
    public function index($lessons_id)
    {
        Log::info("call index($lessons_id) ...");
        
        $dt = date("Y-m-d H:i:s");
        $estado = 0;
        $maximo = 0;

        $final= Assignments::with('lesson')->where('lessons_id',$lessons_id)->get();

        foreach ($final as $key => $value) {
           $HoraDeFinalizacion= $value->enddate;
             $HoraInicio = $value->startdate;

              /* 1 significa que aun debe estar habilitado */
             if($dt<$HoraDeFinalizacion && $dt >= $HoraInicio ){
                     $estado = 1 ;
             }
         } 

        $lesson = Lesson::findOrFail($lessons_id);

        $questions = Question::where('lessons_id', $lessons_id)->where('deleted', '0')->orderBy('id', 'desc')->get();
        
        foreach ($questions as $key => $ques) {
            $maximo = $maximo + $ques->score;
        }


        return view('admin.lessons.questions.index', compact('lesson', 'questions','estado','maximo'));
    }

    public function create($lessons_id)
    {
        
        
        $lesson = Lesson::findOrFail($lessons_id);
        
        //return view('admin.lessons.questions..create', compact('lesson'));
        return view('admin.lessons.questions.create', compact('lesson'));
    }


    public function store(Request $request, $lessons_id)
    {
        Log::info("call store($lessons_id) ...");

        /* CANTIDAD MAXIMA DE CARACTERES ES 65 535 PROBAR CON IMAGENES y el DD */
        // dd(strlen($request->get('body')));
         $messages = [
          'body.max' => 'Por favor ingrese una cantidad menor de informacion en la pregunta o verifique el tamaño de la imagen'
        ];
         $request->validate([
            'body' => 'max:65500',
        ],$messages);

       //if(strlen($request->get('body') > )){
       //return redirect()->route('admin.lessons.questions.index',[$lessons_id])->withErrors('La pregunta posee demasiada información');
     // }

        /*  $request->get('answers')  Trae todas las respuestas  0 => Respuesta, 1 => Respuesta, etc  */
        foreach($request->get('answers') as $i => $answer_body){
             if(strlen($answer_body) > 65500){
                    return back()->withInput()->withErrors('Por favor ingrese una cantidad menor de información en la respuesta o verifique el tamaño de la imagen');
              }
        }

        $question = new Question();
        $question->lessons_id = $lessons_id;
        $question->score = $request->get('score');
        $question->body = $request->get('body');
        $question->save(); 

        foreach($request->get('answers') as $i => $answer_body){

             $answer = new Answer();
            $answer->questions_id = $question->id;
            $answer->body = $answer_body; 
    /* $request->get('correct') = numero del radio pulsado || $i=Numero en el array || answer_body => Valor  */
            $answer->correct = $request->get('correct')==$i?1:0;
            $answer->save(); 

        }



     return redirect()->route('admin.lessons.questions.index', $lessons_id)->with('success', 'Registro guardado satisfactoriamente');
    }
    
    public function edit($lessons_id, $id)
    {
        Log::info("call edit($lessons_id, $id) ...");

        $dt = date("Y-m-d H:i:s");
        $estado = 0;

        $final= Assignments::with('lesson')->where('lessons_id',$lessons_id)->get();

        foreach ($final as $key => $value) {
           $HoraDeFinalizacion= $value->enddate;
           $HoraInicio = $value->startdate;

              /* 1 significa que aun debe estar habilitado */
             if($dt<$HoraDeFinalizacion && $dt >= $HoraInicio ){
                    return redirect()->route('admin.lessons.questions.index', $lessons_id);
             }
         } 

        
        $question = Question::findOrFail($id);
        
        $lesson = Lesson::findOrFail($lessons_id);
        
        
        return view('admin.lessons.questions.edit', compact('question', 'lesson'));
    }

    public function update(Request $request, $lessons_id, $id)
    {
        Log::info("call update($lessons_id, $id) ...");
        
        DB::transaction(function () use($request, $lessons_id, $id) {
        
            $question = Question::findOrFail($id);
            $question->score = $request->get('score');
            $question->body = $request->get('body');
            $question->save();

            foreach($request->get('answers') as $i => $answer_body){
                $answer = $question->answers->get($i);
                $answer->body = $answer_body;
                $answer->correct = $request->get('correct')==$i?1:0;
                $answer->save();
            }
        
        });
        
        return redirect()->route('admin.lessons.questions.index', $lessons_id)->with('success', 'Registro actualizado satisfactoriamente');
    }
    
    public function destroy($lessons_id, $id)
    {
        Log::info("call destroy($lessons_id, $id) ...");
        
        $question = Question::findOrFail($id);
        $question->deleted = '1';
        $question->save();
        
        return redirect()->route('admin.lessons.questions.index', $lessons_id)->with('success', 'Registro eliminado satisfactoriamente');
    }
    








}
