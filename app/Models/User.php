<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $email_verified_at
 * @property string $password
 * @property int $role_id
 * @property-read Role $role
 * @property-read Collection<int, Review> $reviews
 * @property-read Collection<int, Order> $orders
 */
class User extends Authenticatable
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'role_id',
    ];

    protected $hidden = [
        'password',
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function canDelete(): bool
    {
        return ! $this->reviews()->exists() && ! $this->orders()->exists();
    }
}
