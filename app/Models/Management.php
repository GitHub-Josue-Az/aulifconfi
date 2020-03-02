<?php

namespace App\Models;

use App\Models\Lesson;

use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Management extends Model
{
     protected $table = 'managements';


     protected $fillable = ['title'];


     public $timestamps = false;


     public function user() {
        return $this->hasMany(User::class, 'managements_id');
    }


    public function lesson() {
        return $this->hasMany(Lesson::class, 'managements_id');
    }

}
