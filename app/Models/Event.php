<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'title_en',
        'slug',
        'description',
        'description_en',
        'location',
        'location_en',
        'start_time',
        'end_time',
        'quota',
        'banner_image',
        'is_open_registration',
    ];

    public function getTitleAttribute($value): ?string
    {
        if (app()->getLocale() === 'en' && !empty($this->attributes['title_en'])) {
            return $this->attributes['title_en'];
        }
        return $value;
    }

    public function getDescriptionAttribute($value): ?string
    {
        if (app()->getLocale() === 'en' && !empty($this->attributes['description_en'])) {
            return $this->attributes['description_en'];
        }
        return $value;
    }

    public function getLocationAttribute($value): ?string
    {
        if (app()->getLocale() === 'en' && !empty($this->attributes['location_en'])) {
            return $this->attributes['location_en'];
        }
        return $value;
    }

    protected function casts(): array
    {
        return [
            'start_time' => 'datetime',
            'end_time' => 'datetime',
            'is_open_registration' => 'boolean',
            'quota' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function ($event) {
            if (empty($event->slug)) {
                $event->slug = Str::slug($event->title) . '-' . Str::random(5);
            }
        });
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function getRemainingQuotaAttribute(): int
    {
        $registered = $this->registrations()->where('status', '!=', 'canceled')->count();
        return max(0, $this->quota - $registered);
    }
}
