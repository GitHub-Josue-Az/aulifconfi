<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lesson;

class LessonsController extends Controller{
    
    public function index(){
        
        $lessons = Lesson::where('deleted', 0)->with('courses')->with('books')->get();
        
//        return response()->json(compact('lessons'));
        return response()->json($lessons);
    }
    
    public function show($id){
        
        $lesson = Lesson::with('courses')->with('books')->findOrFail($id);
        
//        return response()->json(compact('lesson'));
        return response()->json($lesson);
    }
    
}
