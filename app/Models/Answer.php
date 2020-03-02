<?php
namespace App\Models;

use App\Models\Question;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    
    protected $table = 'answers';

    protected $fillable = ['questions_id', 'body', 'correct'];

    public function question()
    {
        return $this->belongsTo(Question::class, 'questions_id')->where('deleted','0');
    }

    /*public function respuestaParticipantes()
    {
        return $this->hasMany('App\Models\RespuestaParticipante', 'respuesta_id');
    }
    
    public function marcadoParticipantes()
    {
        return $this->hasMany('App\Models\RespuestaParticipante', 'marcado_id');
    }*/





}
