<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commine extends Model
{
    use HasFactory;
     protected $fillable = [
        
        'post_code',
        'name',
        'wilaya_id',
        'ar_name',
        'longitude',
        'latitude'
    ];
    public function wilays(){
        return $this->hasMany(Wilay::class);
    }
    public function users(){
        return $this->belongsTo(User::class);
    }
    public function markers(){
        return $this->belongsTo(Marker::class);
    }
}
