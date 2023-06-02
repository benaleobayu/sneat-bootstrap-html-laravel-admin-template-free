<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Langganan extends Model
{
    use HasFactory;
    protected $table = 'langganan';

    protected $guarded = ['id'];

    public function flowers()
    {
        return $this->belongsToMany(Flower::class, 'langganan_flower')
            ->withPivot('total')
            ->withTimestamps();
    }

    public function day():BelongsTo 
    {
        return $this->belongsTo(Day::class);
    }

    public function regencies():BelongsTo 
    {
        return $this->belongsTo(Regency::class);
    }

}
