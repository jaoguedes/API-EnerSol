<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalisePlaca extends Model
{
    use HasFactory;

    protected $fillable = [
        'produçao',
        'id_placa',
        'id_usuario',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
    public function placa()
    {
        return $this->belongsTo(Placa::class, 'placa_id');
    }
}
