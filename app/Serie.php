<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{

    protected $fillable =  ['nome'];
    protected $perPage = 3;
    protected $appends = ['links'];

    public function episodios()
    {
        return $this->hasMany(Episodio::class);
    }
    public function getLinksAttribute(): array
    {
        return [
            'self' => '/api/series/' . $this->id,
            'episodios' => "/api/series/{$this->id}/episodios"
        ];
    }
}
