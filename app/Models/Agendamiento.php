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
}
