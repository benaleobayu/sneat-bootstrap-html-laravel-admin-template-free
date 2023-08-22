<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class pelanggan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function regencies():BelongsTo
    {
        return $this->belongsTo(Regency::class);
    }
}
