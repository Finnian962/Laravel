<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property float $price
 * @property string $effdate
 * @property int $product_id
 * @property-read Product $product
 */
class Price extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'price',
        'effdate',
        'product_id',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Er verwijzen geen records naar prijzen, dus een prijs kan altijd verwijderd worden.
     */
    public function canDelete(): bool
    {
        return true;
    }
}
