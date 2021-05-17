<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendamiento extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function cupos()
    {
        return $this->belongsToMany(Cupo::class)->withPivot('cupo_id');
    }
    public function personals()
    {
        return $this->belongsTo(Personal::class, 'per_id');
    }
    public function especialidads()
    {
        return $this->belongsTo(Especialidad::class, 'espe_id');
    }
}
