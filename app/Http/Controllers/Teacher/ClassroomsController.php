<?php
namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classroom;
use App\Models\Enrollment;
use App\Models\User;

class ClassroomsController extends Controller{
    
    public function index(){
        
        $classrooms = Classroom::where('deleted', 0)->get();
        
        return view('teacher.classrooms.index', compact('classrooms'));
    }
    
    public function create(){
        
        $students = User::where('deleted', 0)->where('roles_id', 3)->get()->pluck('fullname', 'id');
        
        return view('teacher.classrooms.create', compact('students'));
    }
    
    public function store(Request $request) {
        
        $request->validate([
            'title' => 'required|max:100',
        ]);
        
        $request->merge(['users_id' => auth()->user()->id]);
        
        $classroom = Classroom::create($request->all());
        
        $students = $request->get('students');
        foreach($students as $students_id){
            $enrollment = new Enrollment();
            $enrollment->classrooms_id = $classroom->id;
            $enrollment->users_id = $students_id;
            $enrollment->save();
        }

        return redirect()->route('teacher.classrooms.index')->with('success', 'Registro guardado satisfactoriamente');
    }
    
    public function show($id){
        
        $classroom = Classroom::findOrFail($id);
        
        return view('teacher.classrooms.show', compact('classroom'));
    }
    
    public function edit($id){
        
        $classroom = Classroom::findOrFail($id);
        
        $students = User::where('deleted', 0)->where('roles_id', 3)->get()->pluck('fullname', 'id');
        
        return view('teacher.classrooms.edit', compact('classroom', 'students'));
    }
    
    public function update(Request $request, $id) {
        
        $request->validate([
            'title' => 'required|max:100',
        ]);
        
        $request->merge(['users_id' => auth()->user()->id]);
        
        $classroom = Classroom::findOrFail($id);
        $classroom->update($request->all());

        $students_ids = $request->get('students') ?: [];
        
        // Unenrollments
        foreach($classroom->enrollments as $enrollemnt){
            if(!in_array($enrollemnt->id, $students_ids)){
                $enrollemnt->deleted = '1';
                $enrollemnt->save();
            }
        }
        
        // Enrollments
        foreach($students_ids as $students_id){
            if(!in_array($students_id, $classroom->enrollments->pluck('users_id')->toArray())){
                $enrollment = Enrollment::where('classrooms_id', $classroom->id)->where('users_id', $students_id)->where('deleted', '1')->first();
                if($enrollment == null){
                    $enrollment = new Enrollment();
                    $enrollment->classrooms_id = $classroom->id;
                    $enrollment->users_id = $students_id;
                }
                $enrollment->deleted = '0';
                $enrollment->save();
            }
        }
        
        return redirect()->route('teacher.classrooms.index')->with('success', 'Registro guardado satisfactoriamente');
    }
    
    public function destroy($id){
        
        $classroom = Classroom::findOrFail($id);
        $classroom->deleted = 1;
        $classroom->save();
//        $classroom->delete();

        return redirect()->route('teacher.classrooms.index')->with('success', 'Registro eliminado satisfactoriamente');
    }
    
}
