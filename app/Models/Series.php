<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Series extends Model
{
    use HasFactory;
    // protected $primaryKey = 'id';
    protected $fillable = ['titulo', 'cover'];
    protected $appends = ['links'];


    public function seasons()
    {
        return $this->hasMany(Season::class);
    }

    public function episodes()
    {
        return $this->hasManyThrough(Episode::class, Season::class);
    }

    protected static function booted()
    {
        self::addGlobalScope('ordered', function (Builder $queryBuilder) {
            $queryBuilder->orderBy('titulo');
        });
    }


    protected function links(): Attribute
    {
        return new Attribute(
            get: fn() => [
                [
                    'rel' => 'self',
                    'url' => "/series/{$this->id}"
                ],
                [
                    'rel' => 'seasons',
                    'url' => "/series/{$this->id}/seasons"
                ],
                [
                    'rel' => 'episodes',
                    'url' => "/series/{$this->id}/episodes"
                ],
            ]
        );
    }


}
