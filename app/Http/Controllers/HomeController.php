<?php

namespace App\Http\Controllers;

use App\Exports\PlaceExport;
use App\Exports\PlaceQuery;
use App\Exports\UserQuery;
use App\Mail\OrderShipped;
use App\Models\Answer;
use App\Models\Assignments;
use App\Models\Charge;
use App\Models\Lesson;
use App\Models\Management;
use App\Models\Page;
use App\Models\Place;
use App\Models\Question;
use App\Models\Quizsubmission;
use App\Models\Role;
use App\Models\Submission;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Moment\Moment;
use PhpOffice\PhpSpreadsheet\Calculation\DateTime;
use Aws\Exception\AwsException;
use Aws\S3\S3Client;
use Aws\Signature\createPresignedRequest; 

require_once '../vendor/autoload.php';



class HomeController extends Controller
{
    public function __construct()
    {

         

    }


    public function index()
    {
        return view('home');
    }



	public function pruebita1()
    {
        
        $lesson = User::with('management')->get();
        return $lesson;
    }



    // ESTO ENCRIPTA LA COLUMNA PASSWOR DE LA BASE DE DATOS DE USER
    public function pruebita2()
    {

        $i=1;
        for ($i=1; $i < 427; $i++) { 
           $cupones=User::findOrFail($i);
           $jeje = $cupones->password;
           $data = DB::table("users")->where('id', $i)->update(array("password" => bcrypt($jeje)));
        }


        return $jeje;
    }


public function export() 
    {
        return Excel::download(new PlaceExport, 'users.xlsx');
    }


    public function usuarios($id) 
    {
        
         $lesson = Lesson::where('id', $id)->first();
       
         $place = $lesson->places_id;
          $management = $lesson->managements_id;
         $charge = $lesson->charges_id;
       

        // return (new UserQuery)->forplace($place)->forcharge($charge)->formanage($management)->download('usuarios.xlsx');

         return (new UserQuery($management,$place,$charge))->download('usuarios.xlsx');

    }


    public function hizoOno(){

         //$quiz= Quizsubmission::with('lesson')->where('lessons_id','64')->get();
         //dd($quiz);

          /* EN CASO QUE EXISTA UN EXAMEN YA HECHO */
        $quiz = Quizsubmission::with('lesson')->where('lessons_id','64')->get();
        
        dd($quiz);

        /* PASAR LA HORA PARA QUE EL JAVASCRIPT DETECTE EL TIEMPO MAXIMO */
        /* Detecta la hora actual para ver si es menor a la hora final de assigments   FORMATO: Y-m-d H:i */
        $dt = date("Y-m-d H:i:s");
        $jeje = 0;
        /* Hora final de asignacion del examen */
        $final= Assignments::with('lesson')->where('lessons_id','67')->first();
        $HoraDeFinalizacion= $final->enddate;

        if($dt<$HoraDeFinalizacion){
            $jeje =1;
        }

         dd($dt);

         return $dt;

    }

    public function vista(){

      $dt = Assignments::findOrFail(11)->enddate;

      return view('teacher.vista',compact('dt')); 
    }


    public function prueba5(){

      $preguntas = Question::with('lesson')->where('lessons_id', '71' )->get();


      $ree = $preguntas[0]->answers->get(0);

      return $ree;


    }


    public function prueba6(){

      $examen1 = Submission::findOrFail(2);
      $examenprueba = new Submission;
      $pregunta = Question::findOrFail(15);
      $ans = Answer::findOrFail(66);
      $myans = Answer::findOrFail(66);
   //$examen1->questions()->attach($pregunta->id,['answers_id' => 66,'myanswers_id' => 66,'correct'=>1,'score'=>0]);
      return $examen1;
    }



    public function prueba8(){

      $quiz = Submission::with('assignment')->where('assignments_id',0)->where('users_id', 2)->get();

    dd($quiz);


    }


    public function prueba9(){

      $quiz = Lesson::findOrFail(60);
//Asignaciones con este lesson      que no sea deleted sino agarrar uno eliminado
      $ee = $quiz->assignments->first();
//submision en el array
      $examenes2 = $ee->submission;
  //$submission = Submission::findOrFail($what[0]->id);
 //$pivote = $submission->questions()->get();
 //$numPreguntas = count($examenes2);
 foreach ($examenes2 as $key => $examenes) {
       $exam = $examenes->questions()->get();
 $datos = $exam[$key]->pivot->correct;
  dd($datos);
 }
      dd($examenes2);
}



    public function prueba10(){
       return view('teacher.pruebas');
    }

     public function prueba11(){
        return view('teacher.pruebas');
    }


    public function prueba12(){
       return view('teacher.pienodut');
    }


    public function lessonpru(){
            $usus = auth()->user();
     $place = $usus->places_id;
            $management = $usus->managements_id;
            $charge = $usus->charges_id;
   $lesson = Lesson::where('deleted',0)->where('places_id', $place)->orWhere('managements_id', $management)
                          ->orWhere('charges_id',$charge)->get();
         return $lesson;
    }

    public function emailss(){
       //ENVIO POR CORREO 
                 Mail::to('josue.alva@tecsup.edu.pe')
                    ->queue(new OrderShipped());
                   return view('ejemplo');
        }


        public function subirarchivo(){
         
         return view('fileUpload'); 
        }

        public function lista(){
          return view('listado');
        }


        public function listado(){

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
          "Prefix" => "archi/"
        ]); 

        $archivos = $archivos->toArray();
         $fila = ""; 

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

          $fila .= "<tr><td> {$archivo['Key']} </td>";
          $fila .= "<td>us-west-2</td>";
          $fila .= "<td>{$archivo['Size']}</td>";
          $fila .= "<td>{$archivo['LastModified']}</td>";
          $fila .= "<td><img src={$signedUrl}></td></tr>"; 
          //$fila .= "<td><button onclick='getFile(&#34;{$archivo['Key']}&#34;)'>Descarga</button></td></tr>"; 
        }

        echo $fila ;
        
      }


        public function carga(){


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

      foreach ($_FILES['file']['name'] as $key => $archivs) {
       
        $uploadObject = $s3->putObject(
                  [
                  'Bucket' => 'lmsconfitecabucket',
                  'Key' => "52/".$archivs,
                  'SourceFile' => $_FILES['file']['tmp_name'][$key]
        ]);          


      }
            
          //TRAE LA LOCALIZACION DEL ARCHIVO
         print_r("Realizado"); 
         
        }


        public function deleteFi(){


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

       $archivos = $s3->listObjects(
        [
          'Bucket' => 'lmsconfitecabucket',
          "Prefix" => "archi/"
        ]); 

        $archivos = $archivos->toArray();

        foreach ($archivos['Contents'] as $archivo) 
        {

      $s3->deleteObject([
          'Bucket' => 'lmsconfitecabucket',
           'Key'    => $archivo['Key']
      ]);   

        
        }

        echo "Eliminado";

        }


        public function prueba16(){

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
          "Prefix" => "archi/"
        ]); 

        $archivos = $archivos->toArray();
         $fila = ""; 

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
          echo $fila ;
        }


        public function iframee(){
          return view('iframee');
        }

}
