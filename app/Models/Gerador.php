<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gerador extends Model
{
    use HasFactory;

    protected $table = 'geradores';

    protected $fillable = [
        'nome',
        'tamanho',
        'potencia',
        'valor',
        'quantidade',
    ];

    public function kits()
    {
        return $this->hasMany(Kit::class, 'gerador_id');
    }
}
