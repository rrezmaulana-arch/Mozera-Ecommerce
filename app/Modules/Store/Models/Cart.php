<?php

namespace App\Modules\Store\Models;

use App\Modules\Core\Models\Customer;
use App\Modules\Core\Models\Sku;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['session_id', 'customer_id', 'expires_at'];
    protected $casts = ['expires_at' => 'datetime'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function getTotalAttribute(): int
    {
        return (int) $this->items->sum(function ($item) {
            return ($item->sku ? $item->sku->price_idr : 0) * $item->quantity;
        });
    }

    public function getItemCountAttribute(): int
    {
        return (int) $this->items->sum('quantity');
    }
}

