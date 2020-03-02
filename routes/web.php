<?php

use App\Exports\PlaceQuery;
use App\Mail\OrderShipped;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

Route::get('places', function () {
    return (new PlaceQuery)->forId(3)->download('place.xlsx');
});


Route::get('/usuarioss/{id}', 'HomeController@usuarios')->name('usuarios');
Route::get('/placess', 'HomeController@export')->name('prueba3');

Route::get('/quizz', 'HomeController@hizoOno')->name('prueba4');


Route::get('/', function () {
    return view('auth.login');
});



Route::get('/lessonpru', 'HomeController@lessonpru')->name('lessonpru');


/* ESTO ES EL LOGIN LOGOUT Y TODO Señalar para ver sus detalles */
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');


Route::get('/prueba', 'HomeController@pruebita1')->name('prueba');
Route::get('/prueba2', 'HomeController@pruebita2')->name('prueba2');
Route::get('/prueba5', 'HomeController@prueba5')->name('prueba5');
Route::get('/prueba6', 'HomeController@prueba6')->name('prueba6');
Route::get('/vista','HomeController@vista')->name('prueba7');
Route::get('/prueba8', 'HomeController@prueba8')->name('prueba8');
Route::get('/prueba9', 'HomeController@prueba9')->name('prueba8');
Route::get('/prueba10', 'HomeController@prueba10')->name('prueba10');
Route::get('/prueba12', 'HomeController@prueba12')->name('prueba12');
Route::get('/prueba13', 'HomeController@emailss')->name('emaill');

Route::get('/prueba14', 'HomeController@sliderr')->name('sliderr');
Route::get('/prueba15', 'HomeController@subirarchivo')->name('subirarchivo');

Route::get('prueba16', 'HomeController@prueba16')->name('prueba16');

Route::get('iframee', 'HomeController@iframee')->name('iframee');

Route::get('listado', 'HomeController@listado')->name('listado');
Route::get('lista', 'HomeController@lista')->name('lista');
Route::post('carga', 'HomeController@carga')->name('carga');
Route::get('deleteFi', 'HomeController@deleteFi')->name('deleteFi');


Route::post('subiendo',function(Request $request){

        $pptarchivo =$request->file;

        request()->file('file')->store(

            'My-file',
            's3'
        );

        return back();

})->name('subiendo');



Route::get('obteniendoUrl',function(){

    $contents =  Storage::disk('s3')->url('Diapositiva1.JPG');

    return $contents;
});




//Students
Route::group(['prefix' => 'student', 'as' => 'student.', 'middleware' => ['auth']], function () {


    Route::get('modulos', 'Student\Student@index')->name('modulos');
    Route::get('modulos/{id}', 'Student\Student@show')->name('modulos.show');
    Route::get('modulos/{id}/image', 'Student\Student@image')->name('modulos.image');

    Route::resource('examenes', 'Student\ExamenesController');

    Route::get('evaluacion/{lessonid}/{assignacionid}', 'Student\ExamenesController@show2')->name('evaluacion.show2');

    Route::post('/evaluacion', 'Student\ExamenesController@store')->name('evaluacion.store');

});


// Admins
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin']], function () {
//    Route::get('/home', 'Admin\DashboardController@index');
    // Usuarios
    Route::resource('administrators', 'Admin\AdministratorsController');
    Route::resource('teachers', 'Admin\TeachersController');
    Route::resource('students', 'Admin\StudentsController');

     //Excel
    Route::get('/excel/{id}', 'Admin\LessonsController@excel')->name('excel');

    //reportes
   Route::get('reportes/index', 'Admin\Reportes\ReportesController@index')->name('reportes.index');
   Route::get('reportes/show/{id}', 'Admin\Reportes\ReportesController@show')->name('reportes.show');

    //Gerencias
    Route::get('persona/index', 'Admin\Reportes\ReportesPersonaController@index')->name('persona.index');
    Route::get('persona/show/{id}', 'Admin\Reportes\ReportesPersonaController@show')->name('persona.show');
    Route::get('persona/estadistica/{userid}/{lessonid}', 'Admin\Reportes\ReportesPersonaController@estadistica')->name('persona.estadistica');


    // Recursos
    Route::resource('lessons', 'Admin\LessonsController');
    Route::resource('asignacion', 'Admin\AsignacionController');

    Route::put('lessons/{id}/pages', 'Admin\LessonsController@pages')->name('lessons.pages');
    Route::get('lessons/{id}/image', 'Admin\LessonsController@image')->name('lessons.image');

    Route::resource('courses', 'Admin\CoursesController');
    Route::get('courses/{id}/image', 'Admin\CoursesController@image')->name('courses.image');

    Route::resource('books', 'Admin\BooksController');
    Route::get('books/{id}/image', 'Admin\BooksController@image')->name('books.image');

    // Preguntas
    Route::resource('lessons.questions', 'Admin\LessonsQuestionsController');
    
});


// Teachers
Route::group(['prefix' => 'teacher', 'as' => 'teacher.', 'middleware' => ['teacher']], function () {
//    Route::get('/home', 'Teacher\DashboardController@index');
    Route::resource('classrooms', 'Teacher\ClassroomsController');
});
