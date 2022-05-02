<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rs extends Model
{
    use HasFactory;
    protected $table = "rs";
    protected $fillable = ["name","note"];
}
