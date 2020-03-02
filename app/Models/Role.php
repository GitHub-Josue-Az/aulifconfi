<?php
namespace App\Models;

use App\Models\Lesson;

use Illuminate\Database\Eloquent\Model;

class Role extends Model{
    
    protected $table = 'roles';
    
    protected $fillable = ['title'];



    public function lessons(){
       
       return $this->belongsToMany(Lesson::class,'roles_lessons')->withPivot('title','descripcion');
   }
    
}
