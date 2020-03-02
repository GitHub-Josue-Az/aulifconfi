<?php
namespace App\Models;

use App\Models\Answer;
use App\Models\Lesson;
use App\Models\Submission;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    
    protected $table = 'questions';

    protected $fillable = ['lessons_id', 'body', 'level','score'];


    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lessons_id');
    }
    

    public function answers()
    {
        return $this->hasMany(Answer::class, 'questions_id')->where('deleted', '0');
    }


    public function submissions(){
        return $this->belongsToMany(Submission::class, 'submissions_questions' , 'questions_id', 'submissions_id')->withPivot('answers_id','myanswers_id','correct','score','deleted')->withTimestamps();
    }
    
    
    /*public function respuestaParticipantes()
    {
        return $this->hasMany('App\Models\RespuestaParticipante', 'pregunta_id');
    }*/




    
    public function getLevelNameAttribute() {
        if(isset($this->level)){
            return 'Nivel ' . $this->level;
        }
        return null;
    }
    
    public function getLevelBadgeAttribute() {
        if(isset($this->level)){
            switch($this->level){
                case 0: return '<span class="badge badge-secondary">' . $this->levelName . '</span>';
                case 1: return '<span class="badge badge-success">' . $this->levelName . '</span>';
                case 2: return '<span class="badge badge-warning">' . $this->levelName . '</span>';
                case 2: return '<span class="badge badge-danger">' . $this->levelName . '</span>';
            }
        }
        return null;
    }
    
}
