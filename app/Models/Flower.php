<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Flower extends Model
{
    use HasFactory;

    protected $table = 'flowers';

    protected $guarded = ['id'];
    
    public function langganans()
    {
        return $this->belongsToMany(Langganan::class, 'langganan_flower')
            ->withPivot('total')
            ->withTimestamps();
    }
    
}
