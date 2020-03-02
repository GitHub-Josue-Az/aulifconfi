<?php
namespace App\Models;

use App\Models\Charge;
use App\Models\Management;
use App\Models\Place;
use App\Models\Quizsubmission;
use App\Models\Role;
use App\Models\Submission;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';



     public $timestamps = false;
    

    protected $fillable = [
        'roles_id','firstname','email','password','status','deleted','places_id','managements_id','charges_id',
    ];  

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    
    
    public function setPasswordAttribute($password) {
        return $this->attributes['password'] = bcrypt($password);
    }
    
    public function role() {
        return $this->belongsTo(Role::class, 'roles_id');
    }
    
    public function place() {
        return $this->belongsTo(Place::class, 'places_id');
    }
   
    public function charge() {
        return $this->belongsTo(Charge::class, 'charges_id');
    }

     public function management() {
        return $this->belongsTo(Management::class, 'managements_id');
    }

    public function quizsubmissions() {
        return $this->hasMany(Quizsubmission::class, 'users_id');
    }

    public function submission(){
         return $this->hasMany(Submission::class, 'users_id');
    }
        

    public function getStatusTagAttribute() {
        switch ($this->status){
            case '1': 
                return '<span class="badge badge-success">Activo</span>';
            default : 
                return '<span class="badge badge-secondary">Inactivo</span>';
        }
    }
    
    public function getIsAdminAttribute() {
        return $this->role->id === 1;
    }

    public function getIsStudentAttribute() {
        return $this->role->id === 2;
    }
    




}
