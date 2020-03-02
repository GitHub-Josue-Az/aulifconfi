<?php
namespace App\Models;

use App\Models\Assignments;
use App\Models\Charge;
use App\Models\Course;
use App\Models\Management;
use App\Models\Page;
use App\Models\Place;
use App\Models\Question;
use App\Models\Quizsubmission;
use App\Models\Role;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model{
    
    protected $table = 'lessons';
    
    protected $fillable = ['title','image','status','deleted','places_id','managements_id','charges_id',];
    
    public function courses(){
        return $this->belongsToMany('App\Models\Course', 'courses_lessons', 'courses_id', 'lessons_id')
                ->where('deleted', '0');
    }
    
    public function books(){
        return $this->belongsToMany('App\Models\Book', 'books_lessons', 'books_id', 'lessons_id')
                ->where('deleted', '0');
    }
    
    public function pages(){
        return $this->hasMany('App\Models\Page', 'lessons_id')->where('deleted', '0');
    }
    
    public function theory(){
        return $this->hasOne('App\Models\Page', 'lessons_id')->where('deleted', '0')->where('type', 'T');
    }
    
    public function practice(){
        return $this->hasOne('App\Models\Page', 'lessons_id')->where('deleted', '0')->where('type', 'P');
    }
    
    public function reforce(){
        return $this->hasOne('App\Models\Page', 'lessons_id')->where('deleted', '0')->where('type', 'R');
    }


    public function roles(){
       
       return $this->belongsToMany(Role::class,'roles_lessons')->withPivot('title','descripcion');
   }

   public function place() {
        return $this->belongsTo(Place::class, 'places_id');
    }
    public function management() {
        return $this->belongsTo(Management::class, 'managements_id');
    }
    public function charge() {
        return $this->belongsTo(Charge::class, 'charges_id');
    }


     public function quizsubmissions() {
        return $this->hasMany(Quizsubmission::class, 'lessons_id');
    }

    public function assignments() {
        return $this->hasMany(Assignments::class, 'lessons_id');
    }    

    public function questions() {
        return $this->hasMany(Question::class, 'lessons_id');
    }

    public function getStatusTagAttribute() {
        switch ($this->status){
            case '1': 
                return '<span class="badge badge-success">Activo</span>';
            default : 
                return '<span class="badge badge-secondary">Inactivo</span>';
        }
    }

    
}
