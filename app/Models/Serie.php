<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = ['titulo', 'temporadas'];
}
