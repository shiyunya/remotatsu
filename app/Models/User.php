<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name',
        'email',
        'password',
        'is_admin'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
    ];

    public function achievements()
    {
        return $this->hasMany(Achievement::class);
    }

    public function vote()
    {
        return $this->hasOne(Vote::class);
    }

    public function tasks()
    {
        return $this->hasManyThrough(Task::class, Achievement::class, 'user_id', 'task_id');
    }

    public function has_negative(){

        $achievements = $this->achievements;

        foreach($achievements as $achievement){
            if ($achievement->task->is_negative){
                return true;
            }
        }
        return false;
    }
    
}