<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moviein extends Model
{
    use HasFactory;

    protected $table = 'moviein';
    protected $fillable = [
        'nama_film',
        'rating_film',
        'watched'
    ];

    protected $hidden = [];
}
