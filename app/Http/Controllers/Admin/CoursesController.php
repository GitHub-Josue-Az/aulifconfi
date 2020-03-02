<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Course;
use App\Models\Lesson;

class CoursesController extends Controller{
    

    /* VISTA DE LOS MODULOS */
    public function index(){
        
        $courses = Course::where('deleted', 0)->get();
        
        return view('admin.courses.index', compact('courses'));
    }
    

    public function create(){
        
        $lessons = Lesson::where('deleted', 0)->get()->pluck('title', 'id');
        
        return view('admin.courses.create', compact('lessons'));
    }

    
    
    public function store(Request $request) {
        
        $request->validate([
            'title' => 'required|max:100',
            'file' => 'max:1024|mimes:jpg,jpeg,png,gif', 
        ]);
        
        if($request->hasFile('file') && $request->file('file')->isValid()){
            $image = $request->file('file')->store('courses');
            $request->merge(['image' => $image]);
        }
        
        $course = Course::create($request->all());
        $course->lessons()->sync($request->input('lessons'));

        return redirect()->route('admin.courses.index')->with('success', 'Registro guardado satisfactoriamente');
    }


    
    public function show($id){
        
        $course = Course::findOrFail($id);

       
        
        return view('admin.courses.show', compact('course'));
    }
    
    public function edit($id){
        
        $course = Course::findOrFail($id);
        
        $lessons = Lesson::where('deleted', 0)->get()->pluck('title', 'id');
        
        return view('admin.courses.edit', compact('course', 'lessons'));
    }
    
    public function update(Request $request, $id) {
        
        $request->validate([
            'title' => 'required|max:100',
            'file' => 'max:1024|mimes:jpg,jpeg,png,gif', 
        ]);
        
        if($request->has('file-delete')){
            $request->merge(['image' => null]);
        } else if($request->hasFile('file') && $request->file('file')->isValid()){
            $image = $request->file('file')->store('courses');
            $request->merge(['image' => $image]);
        }
        
        $course = Course::findOrFail($id);
        $course->update($request->all());
        $course->lessons()->sync($request->input('lessons'));

        return redirect()->route('admin.courses.index')->with('success', 'Registro guardado satisfactoriamente');
    }
    
    public function destroy($id){
        
        $course = Course::findOrFail($id);
        $course->deleted = 1;
        $course->save();
//        $course->delete();

        return redirect()->route('admin.courses.index')->with('success', 'Registro eliminado satisfactoriamente');
    }
    
    public function image($id) {
        
        $course = Course::findOrFail($id);
        
        $content = Storage::get($course->image);
        $mimetype = Storage::mimeType($course->image);
        $size = Storage::size($course->image);
        
        return response($content)   // https://laravel.com/docs/5.4/responses
                ->header('Content-Type', $mimetype)
                ->header('Content-Length', $size);
    }
    
}
