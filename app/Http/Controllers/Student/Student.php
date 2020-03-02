<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Role;
use App\Models\Page;
use Illuminate\Support\Facades\Storage;

class Student extends Controller
{

	public function index(){
        
            //dd(auth()->user()->id);

        //$lessons = Lesson::where('deleted', 0)->get();
        //return view('student.index', compact('lessons'));


            $usus = auth()->user();

            $place = $usus->places_id;
            $management = $usus->managements_id;
            $charge = $usus->charges_id;

    $lessons = Lesson::where('places_id', $place)->orWhere('managements_id', $management)
                          ->orWhere('charges_id',$charge)->get();


        return view('student.index', compact('lessons'));
    }




	public function show($id){

         $lesson = Lesson::findOrFail($id);

         if($lesson->deleted == 1){
           return redirect()->route('student.modulos');
         }

        return view('student.show', compact('lesson'));
    }



        public function image($id) {
        
              $lesso = Lesson::findOrFail($id);
        
             $content = Storage::get($lesso->image);


             $mimetype = Storage::mimeType($lesso->image);
            $size = Storage::size($lesso->image);
        
             return response($content)   // https://laravel.com/docs/5.4/responses
                ->header('Content-Type', $mimetype)
                ->header('Content-Length', $size);
    }





}
