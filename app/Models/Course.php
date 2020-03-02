<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model{
    
    protected $table = 'courses';
    
    protected $fillable = ['title', 'price', 'image'];
    
    public function lessons(){
        return $this->belongsToMany('App\Models\Lesson', 'courses_lessons', 'courses_id', 'lessons_id')
                ->where('deleted', '0');
    }
    
}
