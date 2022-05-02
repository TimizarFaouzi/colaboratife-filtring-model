<?php

namespace App\Models;

use App\Models\Wilay;
use App\Models\Commine;
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
     * @var array<int, string>
     */
    protected $fillable = [
        'image',
        'rsa',
        'rsb',
        'moyanne',
        'nb_visited',
        'name',
        'email',
        'password',
        'role',
        'wilay',
        'commine',
        'adrss',
    ];
   
    public function evolations(){
        return $this->belongsTo(Evolation::class);
    }
    public function historiqus(){
        return $this->belongsTo(Historique::class);
    }
    public function markers(){
        return $this->belongsTo(Marker::class);
    }
    public function wilays(){
        return $this->hasMany(Wilay::class);
    }
    public function commines(){
        return $this->hasMany(Commine::class);
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
