<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model{
    
    protected $table = 'books';
    
    protected $fillable = ['title', 'price', 'image'];
    
    public function lessons(){
        return $this->belongsToMany('App\Models\Lesson', 'books_lessons', 'books_id', 'lessons_id')
                ->where('deleted', '0');
    }
    
}
