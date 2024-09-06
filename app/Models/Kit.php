<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kit extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'valor',
        'quantidade',
        'placa_id',
        'gerador_id',
    ];

    public function placa()
    {
        return $this->belongsTo(Placa::class, 'placa_id');
    }

    public function gerador()
    {
        return $this->belongsTo(Gerador::class, 'gerador_id');
    }
}
