<?php

namespace App\Modules\Wms\Models;

use App\Models\User;
use App\Modules\Core\Models\Channel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MarketplaceImport extends Model
{
    protected $fillable = [
        'ulid',
        'channel_id',
        'filename',
        'total_rows',
        'success_rows',
        'duplicate_rows',
        'error_rows',
        'status',
        'logs',
        'created_by',
    ];

    protected $casts = [
        'logs' => 'array',
        'total_rows' => 'integer',
        'success_rows' => 'integer',
        'duplicate_rows' => 'integer',
        'error_rows' => 'integer',
    ];

    protected static function booted(): void
    {
        static::creating(function ($item) {
            if (empty($item->ulid)) {
                $item->ulid = (string) Str::ulid();
            }
        });
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

