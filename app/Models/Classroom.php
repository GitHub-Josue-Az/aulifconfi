<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model{
    
    protected $table = 'classrooms';
    
    protected $fillable = ['title', 'users_id'];
    
    public function teacher() {
        return $this->belongsTo('App\Models\User', 'users_id');
    }
    
    public function enrollments() {
        return $this->hasMany('App\Models\Enrollment', 'classrooms_id')->where('deleted', '0');
    }
    
    public function assignments() {
        return $this->hasMany('App\Models\Enrollment', 'classrooms_id');
    }
    
    public function getEnrollmentsCountAttribute() {
        return $this->enrollments->count();
    }
    
}
