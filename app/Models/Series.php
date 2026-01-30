<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Series extends Model
{
    use HasFactory;
    // protected $primaryKey = 'id';
    protected $fillable = ['titulo'];

    public function seasons()
    {
        return $this->hasMany(Season::class);
    }

    protected static function booted()
    {
        self::addGlobalScope('ordered', function (Builder $queryBuilder) {
            $queryBuilder->orderBy('titulo');
        });
    }


}
