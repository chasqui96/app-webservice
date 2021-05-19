<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservaTurno extends Model
{
    public $timestamps = false;
    use HasFactory;

    public function cupos()
    {
        return $this->belongsTo(Cupo::class, 'cupo_id');;
    }
    public function personals()
    {
        return $this->belongsTo(Personal::class, 'per_id');
    }
    public function especialidads()
    {
        return $this->belongsTo(Especialidad::class, 'espe_id');
    }
    public function pacientes()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');;
    }
}
