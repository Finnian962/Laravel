<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 *
 * @property-read Order $order
 * @property-read Product $product
 */
class OrderRow extends Model
{
    protected $table = 'orderrows';
    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'product_id',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Er verwijzen geen records naar bestelregels.
     */
    public function canDelete(): bool
    {
        return true;
    }
}
