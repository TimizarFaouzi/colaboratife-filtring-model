<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Commine;
class Wilay extends Model
{
    use HasFactory;

    protected $table = "wilays";
    protected $fillable = [
        'name',
        'code',
        'ar_name',
        'longitude',
        'latitude'
    ];
    public function commine(){
        return $this->belongsTo(Commine::class);
    }
    public function users(){
        return $this->belongsTo(User::class);
    }
    public function markers(){
        return $this->belongsTo(Marker::class);
    }
}
