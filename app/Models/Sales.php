<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sales extends Model
{
    use SoftDeletes;

    protected $table = 'sales';

    protected $fillable = [
        'slug',
        'name',
        'title',
        'bio',
        'photo_path',
        'whatsapp',
        'phone',
        'email',
        'is_active',
        'sort_order',
        'user_id',
    ];

    protected $casts = [
        'is_active' => 'bool',
        'sort_order' => 'int',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(SalesDocument::class)->orderBy('sort_order');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    public function whatsappLink(): ?string
    {
        $normalized = $this->normalizePhone($this->whatsapp);

        return $normalized ? 'https://wa.me/'.$normalized : null;
    }

    public function phoneLink(): ?string
    {
        $normalized = $this->normalizePhone($this->phone);

        return $normalized ? 'tel:'.$normalized : null;
    }

    protected function normalizePhone(?string $number): ?string
    {
        if (! $number) {
            return null;
        }

        $digits = preg_replace('/\D+/', '', $number);

        if ($digits === '') {
            return null;
        }

        if (str_starts_with($digits, '0')) {
            $digits = '62'.substr($digits, 1);
        } elseif (str_starts_with($digits, '8')) {
            $digits = '62'.$digits;
        }

        return $digits;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
