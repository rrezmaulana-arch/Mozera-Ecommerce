<?php

namespace App\Modules\Wms\Models;

use App\Models\User;
use App\Modules\Core\Models\Sku;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PurchaseOrder extends Model
{
    protected $fillable = [
        'ulid',
        'po_number',
        'supplier_name',
        'status',
        'total_cost_idr',
        'expected_arrival_date',
        'notes',
        'created_by',
    ];

    protected $casts = [
        'total_cost_idr' => 'integer',
        'expected_arrival_date' => 'date',
    ];

    protected static function booted(): void
    {
        static::creating(function ($item) {
            if (empty($item->ulid)) {
                $item->ulid = (string) Str::ulid();
            }
        });
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function items()
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }
}

