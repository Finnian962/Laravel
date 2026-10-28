<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property-read Collection<int, Product> $products
 * @property-read int|null $products_count
 */
class Category extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function canDelete(): bool
    {
        if (isset($this->products_count)) {
            return $this->products_count === 0;
        }

        return ! $this->products()->exists();
    }
}
