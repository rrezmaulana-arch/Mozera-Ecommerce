<?php

namespace App\Modules\Store\Models;

use App\Modules\Core\Models\Sku;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = ['cart_id', 'sku_id', 'quantity'];
    protected $casts = ['quantity' => 'integer'];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function sku()
    {
        return $this->belongsTo(Sku::class);
    }

    public function getSubtotalAttribute(): int
    {
        return (int) (($this->sku ? $this->sku->price_idr : 0) * $this->quantity);
    }
}

