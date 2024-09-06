<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Placa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'valor',
        'potencia',
        'tamanho',
        'quantidade',
    ];

    public function analisesPlacas()
    {
        return $this->hasMany(AnalisePlaca::class, 'placa_id');
    }

    public function kits()
    {
        return $this->hasMany(Kit::class, 'placa_id');
    }
}
