<?php

namespace App\Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Channel extends Model
{
    protected $fillable = ['code', 'name', 'description', 'is_active'];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'channel_id');
    }
}


