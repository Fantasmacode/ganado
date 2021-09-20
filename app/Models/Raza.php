<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raza extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_raz';
    public $timestamps = false;
    protected $fillable = [
        'nombre_raz',
    ];
}
