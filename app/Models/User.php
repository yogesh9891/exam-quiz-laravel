<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hash;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'school_id',
        'name',
        'email',
        'password',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
        'roles',
    ];




        protected $guard_name = 'sanctum';


    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'role_names',
    ];


    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }


     public function getRoleNamesAttribute() {
         return $this->roles->pluck('name')[0]; 
      }


      public function school()
      {
           return $this->hasOne(School::class,'school_id');
      }


      public function student()
      {
           return $this->hasOne(SchoolStudent::class,'student_id');
      }


      public function teacher()
      {
         return $this->hasone(SchoolTeacher::class,'teacher_id');
      }


        public function classes()
    {
        return $this->hasMany(Classes::class,'school_id');
    }

     
    public function assigned()
    {
        return $this->hasMany(StudentAssigned::class,'student_id');
    }

    public function getNameAttribute($name)
    {
        return $this->attributes['name'] = ucwords($name);
    }
}
