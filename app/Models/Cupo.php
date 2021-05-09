<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cupo extends Model
{
    public $timestamps = false;
    use HasFactory;

    public function agendamientos()
    {
        return $this->belongsToMany(Agendamiento::class)->withPivot('agendamiento_id');;
    }

}
