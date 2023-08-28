<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Day extends Model
{
    use HasFactory;

    public function langganan(): HasMany
    {
        return $this->hasMany(Langganan::class);
    }
    public function pesanan(): HasMany
    {
        return $this->hasMany(pesanan::class, 'day_id', 'id');
    }



    public function getRouteKey(): mixed
    {
        return $this->slug;
    }
}
