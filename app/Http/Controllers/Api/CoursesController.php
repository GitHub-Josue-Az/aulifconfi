<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Course;

class CoursesController extends Controller{
    
    public function index(){
        
        $courses = Course::where('deleted', 0)->with('lessons')->get();
        
//        return response()->json(compact('courses'));
        return response()->json($courses);
    }
    
    public function show($id){
        
        $course = Course::with('lessons')->findOrFail($id);
        
//        return response()->json(compact('course'));
        return response()->json($course);
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
