<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='classroom';
    protected $fillable=[
        'name',
        'type',
        'etage',
        'capcity',
        'particulier'
    ];
}
