<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='resevations';
    protected $fillable=[
        'time',
        'date',
        'goal',
        'etat',
        'id_classroom',
        'id_user',
    ];
}
