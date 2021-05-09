<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class Personal extends Authenticatable
{
    use HasFactory, Notifiable;
    public $timestamps = false;
    use HasFactory;
    protected $hidden = [
        'password'
    ];
}
