<?php
namespace App\Models;

use App\Models\Lesson;
use App\Models\Submission;
use Illuminate\Database\Eloquent\Model;

class Assignments extends Model{
    
    protected $table = 'assignments';
    
protected $fillable = ['title', 'lessons_id', 'startdate', 'enddate','datepicker','datepicker2','tiempo','deleted','scoremin'];
    
    public function classroom() {
        return $this->belongsTo('App\Models\Classroom', 'classrooms_id');
    }
    
    public function lesson() {
        return $this->belongsTo(Lesson::class, 'lessons_id');
    }
    

    public function submission(){
         return $this->hasMany(Submission::class, 'assignments_id');
    }


}
