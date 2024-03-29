<?php

namespace App;

use App\Announcement;
use Illuminate\Notifications\Notifiable;
use App\Models\PrimaryModels\StudentInfo;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function studentRequirements()
    {
        return $this->hasMany(StudentRequirement::class,'user_id','id');
    }

    public function studentInfo()
    {
        return $this->hasOne(StudentInfo::class,'email','email');
    }


    public function announcement()
    {
        return $this->hasMany(Announcement::class);
    }
}
