<?php

namespace App\Models;


use App\Models\Lesson;

use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
     protected $table = 'charges';

     protected $fillable = ['title'];

     public $timestamps = false;


    public function user() {
        return $this->hasMany(User::class, 'charges_id');
    }

    public function lesson() {
        return $this->hasMany(Lesson::class, 'charges_id');
    }

}
