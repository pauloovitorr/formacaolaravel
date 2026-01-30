<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    public function serie()  {
        return $this->belongsTo(Series::class, 'serie_id');
    }

    public function episodes(){
        return $this->hasMany(Episode::class);
    }

}
