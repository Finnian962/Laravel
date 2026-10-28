<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $comment
 * @property int $user_id
 * @property int $product_id
 * @property-read User $user
 * @property-read Product $product
 */
class Review extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'comment',
        'user_id',
        'product_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Er verwijzen geen records naar reviews.
     */
    public function canDelete(): bool
    {
        return true;
    }
}
