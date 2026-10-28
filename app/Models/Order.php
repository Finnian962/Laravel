<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $orderdate
 * @property int $user_id
 * @property string $status
 * @property-read User $user
 * @property-read Collection<int, OrderRow> $orderrows
 */
class Order extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'orderdate',
        'user_id',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orderrows(): HasMany
    {
        return $this->hasMany(OrderRow::class);
    }

    public function canDelete(): bool
    {
        return ! $this->orderrows()->exists();
    }
}
