<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'tipo',
        'cep',
        'bairro',
        'numero',
        'cidade',
        'rua',
        'cpf',
        'documento',
    ];

    protected $hidden = [
        'password',
    ];

    public function analisePlaca()
    {
        return $this->hasOne(AnalisePlaca::class, 'id_usuario');
    }

    public function placas()
    {
        return $this->hasMany(Placa::class);
    }

    public function kits()
    {
        return $this->hasMany(Kit::class);
    }

    public function geradores()
    {
        return $this->hasMany(Gerador::class);
    }
}
