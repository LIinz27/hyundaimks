<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Sales extends Model
{
    use HasFactory, SoftDeletes;

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

    protected static function booted(): void
    {
        // Soft delete: jangan hapus file (bisa dipulihkan).
        // Hapus file hanya saat force delete, dan sekalian foto galerinya.
        static::forceDeleting(function (Sales $sales) {
            // PENTING: harus di forceDeleting (sebelum DELETE dijalankan), bukan
            // forceDeleted. Foreign key ON DELETE CASCADE menghapus baris galeri
            // di level database saat sales dihapus, sehingga di event
            // forceDeleted relasinya sudah kosong dan file akan terlantar.
            $sales->galeris()->get()->each(function (Galeri $foto) {
                if ($foto->image_path && Storage::disk('public')->exists($foto->image_path)) {
                    Storage::disk('public')->delete($foto->image_path);
                }
            });
        });

        static::forceDeleted(function (Sales $sales) {
            if ($sales->photo_path && Storage::disk('public')->exists($sales->photo_path)) {
                Storage::disk('public')->delete($sales->photo_path);
            }
        });

        // Penggantian foto profil: hapus file lama setelah berhasil simpan yang baru.
        static::updated(function (Sales $sales) {
            if ($sales->wasChanged('photo_path')) {
                $old = $sales->getOriginal('photo_path');
                if ($old && $old !== $sales->photo_path && Storage::disk('public')->exists($old)) {
                    Storage::disk('public')->delete($old);
                }
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function galeris(): HasMany
    {
        return $this->hasMany(Galeri::class)->orderBy('sort_order');
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
