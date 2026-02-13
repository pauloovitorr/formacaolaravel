<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    public $timestamps = false;

     protected $casts = [
        'watched' => 'boolean'
    ];

    public function season()  {
        return $this->belongsTo(Season::class);
    }
}
