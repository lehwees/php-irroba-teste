<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Medico extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'medicos'; 

    protected $fillable =
    [
        'nome',
        'email',
        'password',
    ];

    protected $hidden =
    [
        'password',
    ];

    public function agendamentos()
    {
        return $this->hasMany(agendamento::class);
    }
}
