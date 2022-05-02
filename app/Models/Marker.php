<?php

namespace App\Models;
use App\Models\User;
use App\Models\Type;
use App\Models\Wilay;
use App\Models\Commine;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marker extends Model
{
    use HasFactory;
    protected $table = "Markers";
    protected $fillable = ["user_id","type_id","wilaya_id","commine_id","tetle","lat","lng","image","moy","commenter","action","nb_visited"];

    public function users(){
        return $this->hasMany(User::class);
    }
   
    public function types(){
        return $this->hasMany(Type::class);

    }
      public function wilays(){
        return $this->hasMany(Wilay::class);
    }

    public function commins(){
        return $this->hasMany(Commine::class);
    }
    public function historique(){
        return $this->belongsTo(Historique::class);
    }
    public function evolation(){
        return $this->belongsTo(Evolation::class);
    }
}
