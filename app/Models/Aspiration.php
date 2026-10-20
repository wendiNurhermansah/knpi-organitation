<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Aspiration extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_code',
        'sender_name',
        'sender_email',
        'category',
        'subject',
        'message',
        'status',
        'admin_notes',
        'handled_by',
        'attachment',
    ];

    /**
     * Generate unique ticket code: KNPI-YYYYMM-XXXX
     */
    public static function generateTicketCode(): string
    {
        $prefix = 'KNPI-' . date('Ym') . '-';
        do {
            $code = $prefix . strtoupper(Str::random(4));
        } while (static::where('ticket_code', $code)->exists());

        return $code;
    }

    public function handler(): BelongsTo
    {
        return $this->belongsTo(User::class, 'handled_by');
    }

    public function scopeSubmitted(Builder $query): Builder
    {
        return $query->where('status', 'submitted');
    }

    public function scopeInReview(Builder $query): Builder
    {
        return $query->where('status', 'in_review');
    }

    public function scopeResolved(Builder $query): Builder
    {
        return $query->where('status', 'resolved');
    }

    public function getStatusBadgeAttribute(): array
    {
        return match ($this->status) {
            'submitted' => ['bg' => 'bg-amber-50', 'text' => 'text-amber-700', 'border' => 'border-amber-200', 'label' => 'Terkirim'],
            'in_review' => ['bg' => 'bg-blue-50', 'text' => 'text-blue-700', 'border' => 'border-blue-200', 'label' => 'Diproses'],
            'resolved' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-700', 'border' => 'border-emerald-200', 'label' => 'Selesai'],
            default => ['bg' => 'bg-slate-50', 'text' => 'text-slate-700', 'border' => 'border-slate-200', 'label' => $this->status],
        };
    }
}
