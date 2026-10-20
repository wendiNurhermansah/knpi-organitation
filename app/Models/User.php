<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Role checks
     */
    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    public function isAdminHumas(): bool
    {
        return in_array($this->role, ['super_admin', 'admin_humas']);
    }

    public function isAdminOkp(): bool
    {
        return in_array($this->role, ['super_admin', 'admin_okp']);
    }

    /**
     * User has many articles (author)
     */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    /**
     * User handles many aspirations
     */
    public function handledAspirations(): HasMany
    {
        return $this->hasMany(Aspiration::class, 'handled_by');
    }
}
