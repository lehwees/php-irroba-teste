<?php

namespace App\Models;

use App\Models\Paciente;
use App\Models\Agendamento;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function pacientes(): HasMany
    {
        return $this->hasMany(Paciente::class);
    }

    public function agendamentos(): HasMany
    {
        return $this->hasMany(Agendamento::class);
    }
}
