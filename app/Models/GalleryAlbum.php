<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class GalleryAlbum extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'cover_image',
    ];

    protected static function booted(): void
    {
        static::creating(function ($album) {
            if (empty($album->slug)) {
                $album->slug = Str::slug($album->title) . '-' . Str::random(5);
            }
        });
    }

    public function items(): HasMany
    {
        return $this->hasMany(GalleryItem::class);
    }
}
