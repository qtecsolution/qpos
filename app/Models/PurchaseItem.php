<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_id',
        'product_id',
        'purchase_price',
        'price',
        'discount_value',
        'discount_type',
        'quantity',
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
