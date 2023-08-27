<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';

    protected $guarded = ['id'];

    public function flowers()
    {
        return $this->belongsToMany(Flower::class, 'pesanan_flower')
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
