<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class materialReservation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='material_reservations';
    protected $fillable=[
        'time',
        'date',
        'goal',
        'id_material',
        'id_user',
    ];}
