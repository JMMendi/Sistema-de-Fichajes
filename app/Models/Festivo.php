<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Festivo extends Model
{
    public $fillable = ['nombre', 'dia', 'mes', 'tipo'];

    public $timestamps = false;
}
