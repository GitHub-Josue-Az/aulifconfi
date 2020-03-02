<?php

namespace App\Models;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Quizsubmission extends Model
{
   

	protected $table = 'quizsubmissions';


	 protected $fillable = ['lessons_id', 'users_id', 'score','finished','finished_at','updated_at','deleted'];

	public function user() {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function lesson() {
        return $this->belongsTo(Lesson::class, 'lessons_id');
    }


}
