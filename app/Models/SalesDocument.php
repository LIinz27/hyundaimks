<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SalesDocument extends Model
{
    protected $fillable = [
        'sales_id',
        'file_path',
        'caption',
        'sort_order',
    ];

    public function sales(): BelongsTo
    {
        return $this->belongsTo(Sales::class);
    }
}
