<?php

namespace App\Models;

use App\Models\Assignments;
use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    

	protected $table = 'submissions';

    protected $fillable = ['assignments_id', 'score', 'finished','finished_at','users_id','deleted'];


	public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }



    public function questions(){
    
    return $this->belongsToMany(Question::class, 'submissions_questions' , 'submissions_id', 'questions_id')
    ->withPivot('answers_id','myanswers_id','correct','score','deleted')->withTimestamps();
    
    }


     public function assignment() {
        return $this->belongsTo(Assignments::class, 'assignments_id');
    }




}
