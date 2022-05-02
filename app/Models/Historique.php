<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historique extends Model
{
    use HasFactory;
     protected $table = "historiques";
    protected $fillable = ["id","user_id","user_id_marker","vi_form","vi_this","nb_visite","marker_id","comm","votes"];
    public function markers(){
        return $this->hasMany(Marker::class);
    }
    public function users(){
        return $this->hasMany(User::class);
    }
}
