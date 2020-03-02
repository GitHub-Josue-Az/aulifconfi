<?php

namespace App\Models;

use App\Models\Lesson;

use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
     protected $table = 'places';


     protected $fillable = ['title'];


     public $timestamps = false;



	public function user() {
        return $this->hasMany(User::class, 'places_id');
    }

    public function lesson() {
        return $this->hasMany(Lesson::class, 'places_id');
    }

}
