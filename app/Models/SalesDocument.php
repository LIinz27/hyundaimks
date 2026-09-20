<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class SalesDocument extends Model
{
    protected $fillable = [
        'sales_id',
        'file_path',
        'caption',
        'sort_order',
    ];

    protected static function booted(): void
    {
        static::deleting(function (SalesDocument $document) {
            if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
                Storage::disk('public')->delete($document->file_path);
            }
        });
    }

    public function sales(): BelongsTo
    {
        return $this->belongsTo(Sales::class);
    }
}
