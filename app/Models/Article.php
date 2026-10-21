<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'title_en',
        'slug',
        'summary',
        'summary_en',
        'content',
        'content_en',
        'thumbnail',
        'status',
        'views_count',
        'published_at',
    ];

    public function getTitleAttribute($value): ?string
    {
        if (app()->getLocale() === 'en' && !empty($this->attributes['title_en'])) {
            return $this->attributes['title_en'];
        }
        return $value;
    }

    public function getSummaryAttribute($value): ?string
    {
        if (app()->getLocale() === 'en' && !empty($this->attributes['summary_en'])) {
            return $this->attributes['summary_en'];
        }
        return $value;
    }

    public function getContentAttribute($value): ?string
    {
        if (app()->getLocale() === 'en' && !empty($this->attributes['content_en'])) {
            return $this->attributes['content_en'];
        }
        return $value;
    }

    protected function casts(): array
    {
        return [
            'views_count' => 'integer',
            'published_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->title) . '-' . Str::random(5);
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }
}
