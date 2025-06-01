<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'nome',
        'cpf',
        'nascimento',
        'telefone',
        'medico_id'
    ];

    public function medico()
    {
        return $this->belongsTo(Medico::class);
    }

    public function agendamentos()
    {
        return $this->hasMany(agendamentos::class);
    }
}
