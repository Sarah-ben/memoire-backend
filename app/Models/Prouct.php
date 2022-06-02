<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prouct extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable=[
 'name',
 'slug',
 'description'
    ];

}
