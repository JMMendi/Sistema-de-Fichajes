<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fichar extends Model
{
    /** @use HasFactory<\Database\Factories\FicharFactory> */
    use HasFactory;

    protected $fillable = [
        'fechaInicio',
        'fechaFin',
        'user_id',
        'tipo',
    ];

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'fechaInicio' => 'datetime',
            'fechaFin'=>'datetime'
        ];
    }
}
