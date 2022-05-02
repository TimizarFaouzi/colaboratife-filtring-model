<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evolation extends Model
{
    use HasFactory;
    protected $table = "evolations";
    protected $fillable = ["user_id","marker_id","rsa","rsb","total_rsa","total_rsb","rating"];
    public function markers(){
        return $this->hasMany(Marker::class);
    }
    public function users(){
        return $this->hasMany(User::class);
    }
}
