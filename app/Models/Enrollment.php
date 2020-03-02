<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model{
    
    protected $table = 'enrollments';
    
    protected $fillable = ['classrooms_id', 'users_id'];
    
    public function classroom() {
        return $this->belongsTo('App\Models\Classroom', 'classrooms_id');
    }
    
    public function user() {
        return $this->belongsTo('App\Models\User', 'users_id');
    }
    
}
