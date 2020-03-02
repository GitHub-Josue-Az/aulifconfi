<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assignments;
use App\Models\Lesson;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use moment;

class AsignacionController extends Controller
{
    public function index(){
        	
        $assi = Assignments::where('deleted', 0)->get();
        
        return view('admin.asignacion.index', compact('assi'));
    }
    
    public function create(){
        
        $lessons= Lesson::orderBy('title')->get();

        return view('admin.asignacion.create',compact('lessons'));
    }
    

    public function store(Request $request) {

        $request->validate([
            'title' => 'required|max:100',
            'lessons_id' => 'required|max:100',
            'startdate' => 'required|date',
            'enddate' => 'required|date',
            'tiempo' => 'required|numeric|min:5|max:1000',
            'scoremin' => 'required|numeric|min:1',
        ]); 

      $ultimoNum = $request->startdate;
      $lessonid = $request->get('lessons_id');

     $asignacion = Assignments::where('lessons_id', $lessonid)->where('deleted','<>', 1 )->get();

     //dd($asignacion); Puede que sea una coleccion vacia

     $preguntas = Question::with('lesson')->where('lessons_id', $lessonid )->get();

     /* VALIDAR SI HAY PREGUNTAS O NO, YA QUE PUEDEN ACCEDEER DESDE LA URL TAMBIEN */
     if($preguntas->isEmpty()){
          return redirect()->route('admin.asignacion.create')->withErrors('La capacitación asignada no posee preguntas');
      }

        if ($asignacion->isEmpty()==false) {
             foreach ($asignacion as $key => $value) {
           $endmayor = $value->enddate;

           if($ultimoNum < $endmayor){
            return redirect()->route('admin.asignacion.create')->withErrors('La fecha de inicio, no puede ser menor a la fecha de finalizacion de la ultima asignación');
           }
          }
        }

         Assignments::create($request->all());  
        return redirect()->route('admin.asignacion.index')->with('success', 'Registro guardado satisfactoriamente');
    }


    public function show($id){
        
        $user = User::findOrFail($id);
        
        return view('admin.asignacion.show', compact('user'));
    }
    
    public function edit($id){
        
        $user = Assignments::findOrFail($id);
        
        return view('admin.asignacion.edit', compact('user'));
    }
    
    public function update(Request $request, $id) {
        
        $request->validate([
            'firstname' => 'required|max:100',
            'lastname' => 'required|max:100',
            'email' => 'required|max:100|unique:users,email,' . $id,
            'password' => 'nullable|min:4',
        ]);
        
        $user = User::findOrFail($id);
        
        if ($request->get('password') == '') {
            $request->request->remove('password');
        }
        
        if ($request->has('status')) {
            $request->request->set('status', '1');
        } else {
            $request->request->set('status', '0');
        }
        
        $user->update($request->all());

        return redirect()->route('admin.administrators.index')->with('success', 'Registro guardado satisfactoriamente');
    }
    
    public function destroy($id){
        
        $user = User::findOrFail($id);
        $user->deleted = 1;
        $user->save();
//        $user->delete();

        return redirect()->route('admin.administrators.index')->with('success', 'Registro eliminado satisfactoriamente');
    }
}
