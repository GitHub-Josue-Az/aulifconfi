<?php
namespace App\Http\Controllers\Admin;

use App\Exports\UserQuery;
use App\Http\Controllers\Controller;
use App\Models\Charge;
use App\Models\Lesson;
use App\Models\Management;
use App\Models\Page;
use App\Models\Place;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Aws\Exception\AwsException;
use Aws\S3\S3Client;
use Aws\Signature\createPresignedRequest; 

require_once '../vendor/autoload.php';

class LessonsController extends Controller{
    
    public function index(){
        
        $lessons = Lesson::where('deleted', 0)->get();
        return view('admin.lessons.index', compact('lessons'));
    }


    public function index2(){
        
        $roles = Role::with('lessons')->get();
        return view('admin.asignacion.index', compact('roles'));
    }

    
    public function create(){

         $places= Place::all();
         $managements= Management::all();
         $charges= Charge::orderBy('title')->get();

         $lessons= null;
        
        return view('admin.lessons.create',compact('places','managements','charges','lessons'));
    }
    
    public function create2(){

        $roles= Role::where('title','<>','Administrador')->where('title','<>','Profesor')->where('title','<>','Alumno')->get();
        $lessons=Lesson::where('deleted','=',0)->get();        
        return view('admin.asignacion.create',compact('roles','lessons'));
    }

    public function store(Request $request) {

        
           //dd($request);
            $validator = Validator::make($request->all(), [
            'title' => 'required|max:100',
            'charges_id' => 'required',
            'managements_id' => 'required',
            'places_id' => 'required',
             'file' => 'required|max:1024|mimes:jpg,jpeg,png,gif', 
             ]);
        
            /*if ($validator->errors()->count() > 2){
                return redirect()->route('admin.lessons.create')->withErrors('Debe seleccionar al menos 1 campo desplegable');
            }else{*/

              if($request->hasFile('file') && $request->file('file')->isValid()) {
    /* store es referente al storage dende la carpeta es lessons // Devuelve una instancia de la ruta donde esta*/
            $image = $request->file('file')->store('lessons');
            $request->merge(['image' => $image]);
            }
             $lesson = Lesson::create($request->all());
            return redirect()->route('admin.lessons.index')->with('success', 'Registro guardado satisfactoriamente');

         /*}*/

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
    

    public function store2(Request $request) {
        
        $request->validate([
            'titulo' => 'required|max:100',
             'descripcion' => 'required|max:100',
             'roles' => 'required',
             'lessons' => 'required', 
        ]);

        $titul = $request->titulo;
        $descripcio = $request->descripcion;
        $role = $request->roles;
        $lesson = $request->lessons;

        $roless= Role::findOrFail($role);

        $roless->lessons()->attach($lesson,['title'=> $titul, 'descripcion' => $descripcio]);
        return redirect()->route('admin.asignacion')->with('success', 'Registro guardado satisfactoriamente');
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


      public function carga(Request $request){

        $idlesson =  $request->assignacionid;

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
                  'Key' => $idlesson."/".$archivs,
                  'SourceFile' => $_FILES['file']['tmp_name'][$key]
        ]);          


      }
            
         print_r("Realizado"); 
         
        }


        public function deleteFi($id){

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
          "Prefix" => $id
        ]); 

        $archivos = $archivos->toArray();


        if (array_has($archivos,'Contents')) {

             foreach ($archivos['Contents'] as $archivo) 
        {

      $s3->deleteObject([
          'Bucket' => 'lmsconfitecabucket',
           'Key'    => $archivo['Key']
      ]);   

          }
          return redirect()->back()->with('success', 'Eliminación realizada');  
    }

       
       return back()->withInput()->withErrors('No hay archivos a eliminar');
     }


     public function iframee($id){
          return view('admin.lessons.iframe',compact('id'));
        }




    public function show($id){
        
        $lesson = Lesson::findOrFail($id);
         $ids = $lesson->id;
        return view('admin.lessons.show', compact('lesson','ids'));
    }
    
    
    public function edit($id){
        
        $lesson = Lesson::findOrFail($id);
        return view('admin.lessons.edit', compact('lesson'));
    }
    

    public function update(Request $request, $id) {
        
        $request->validate([
            'title' => 'required|max:100',
        ]);

        $lesson = Lesson::findOrFail($id);
        $lesson->update($request->all());

        return redirect()->route('admin.lessons.index')->with('success', 'Registro guardado satisfactoriamente');
    }
    

    public function pages(Request $request, $id){
        
        $theory_body = $request->get('theory');
        $practice_body = $request->get('practice');
        $reforce_body = $request->get('reforce');
        
        $messages = [
    'theory.max' => 'Por favor ingrese una cantidad menor de informacion en teoría o verifique el tamaño de la imagen',
    'practice.max' => 'Por favor ingrese una cantidad menor de informacion en ejercicios o verifique el tamaño de la imagen'
        ];
         $request->validate([
        'theory' => 'max:65500',
         'practice' => 'max:65500',
        ],$messages);

        // theory
        $theory = Page::where('lessons_id', $id)->where('type', 'T')->first();
        if($theory == null){
            $theory = new Page();
            $theory->lessons_id = $id;
            $theory->type = 'T';
        }
        $theory->body = $theory_body?:'';
        $theory->save();
        
        // practice
        $practice = Page::where('lessons_id', $id)->where('type', 'P')->first();
        if($practice == null){
            $practice = new Page();
            $practice->lessons_id = $id;
            $practice->type = 'P';
        }
        $practice->body = $practice_body?:'';
        $practice->save();
        
        // reforce
        $reforce = Page::where('lessons_id', $id)->where('type', 'R')->first();
        if($reforce == null){
            $reforce = new Page();
            $reforce->lessons_id = $id;
            $reforce->type = 'R';
        }
        $reforce->body = $reforce_body?:'';
        $reforce->save();
        
        return redirect()->route('admin.lessons.show', $id)->with('success', 'Registros guardados satisfactoriamente');
    }


    public function excel($id){

         $lesson = Lesson::where('id', $id)->first();
         $place = $lesson->places_id;
          $management = $lesson->managements_id;
         $charge = $lesson->charges_id;

        // return (new UserQuery)->forplace($place)->forcharge($charge)->formanage($management)->download('usuarios.xlsx');
         return (new UserQuery($management,$place,$charge))->download('usuarios.xlsx');
    }


 public function destroy($id){
        
        $lesson = Lesson::findOrFail($id);
        $lesson->deleted = 1;
        $lesson->save();
//        $lesson->delete();

        return redirect()->route('admin.lessons.index')->with('success', 'Registro eliminado satisfactoriamente');
        
    }
}
