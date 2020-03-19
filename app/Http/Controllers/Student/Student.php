<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Page;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Validator;
use Aws\Exception\AwsException;
use Aws\S3\S3Client;
use Aws\Signature\createPresignedRequest; 

require_once '../vendor/autoload.php';


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
            
           $lessons =  Lesson::Where(function($query) use ($place)
            {
                $query->where('places_id', null)
                      ->orWhere('places_id', $place);
            })
            ->Where(function($query) use ($management)
            {
                $query->where('managements_id', null)
                      ->orWhere('managements_id', $management);
            })
            ->Where(function($query) use ($charge)
            {
                $query->where('charges_id', null)
                      ->orWhere('charges_id', $charge);
            })
            ->get();


        return view('student.index', compact('lessons'));
    }



public function listado($id){

        $S3Options = [
        'scheme' => 'http',
        'version' => 'latest',
        'region'  => 'us-west-2',
        'credentials' => 
        [
          'key' => 'AKIAJ64CUZMI2B36T3BA',
          'secret' => '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'
        ]
      ]; 

      $s3 = new S3Client($S3Options); 
      
       // listar archivos
      $archivos = $s3->listObjects(
        [
          'Bucket' => 'lmsconfitecabucket',
          "Prefix" => $id
        ]); 

        $archivos = $archivos->toArray();
         $fila = ""; 

           if (array_has($archivos,'Contents')) {

            foreach ($archivos['Contents'] as $archivo) 
        {

        //Get a command to GetObject
        $cmd = $s3->getCommand('GetObject', [
            'Bucket' => 'lmsconfitecabucket',
            'Key'    => $archivo['Key']
        ]);

        //The period of availability
        $request = $s3->createPresignedRequest($cmd, '+10 minutes');

        //Get the pre-signed URL
        $signedUrl = (string) $request->getUri();

          $fila .= "<div class='swiper-slide'><img  class='swiper-slide' src={$signedUrl}></div>"; 
          //$fila .= "<td><button onclick='getFile(&#34;{$archivo['Key']}&#34;)'>Descarga</button></td></tr>"; 
       
         }
          return $fila ;

           }

         return "No hay contenido";
      }


      public function iframee($id){

        $S3Options = [
        'scheme' => 'http',
        'version' => 'latest',
        'region'  => 'us-west-2',
        'credentials' => 
        [
          'key' => 'AKIAJ64CUZMI2B36T3BA',
          'secret' => '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'
        ]
      ]; 

      $s3 = new S3Client($S3Options); 
      
       // listar archivos
      $archivos = $s3->listObjects(
        [
          'Bucket' => 'lmsconfitecabucket',
          "Prefix" => $id
        ]); 

        $archivos = $archivos->toArray();
         $fila = ""; 

           if (array_has($archivos,'Contents')) {
                 return view('student.lessons.iframe',compact('id'));
           }

          return view('home');
        }


	public function show($id){

         $lesson = Lesson::findOrFail($id);

          $ids = $lesson->id;

         if($lesson->deleted == 1){
           return redirect()->route('student.modulos');
         }

        return view('student.show', compact('lesson','ids'));
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
