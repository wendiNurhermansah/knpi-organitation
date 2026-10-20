<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'leader_name',
        'email',
        'phone',
        'sk_number',
        'sk_file',
        'period_start',
        'period_end',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'period_start' => 'date',
            'period_end' => 'date',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function ($org) {
            if (empty($org->slug)) {
                $org->slug = Str::slug($org->name);
            }
        });
    }

    public function scopeVerified(Builder $query): Builder
    {
        return $query->where('status', 'verified');
    }

    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', 'pending');
    }

    public function scopeExpired(Builder $query): Builder
    {
        return $query->where('status', 'expired');
    }

    public function isVerified(): bool
    {
        return $this->status === 'verified';
    }
}
