<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $table = "types";
     protected $fillable = [
        'name',
        'saisons',
    ];
   
    public function markers(){
        return $this->belongsTo(Marker::class);
    }
}
