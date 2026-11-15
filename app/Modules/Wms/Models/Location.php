<?php

namespace App\Modules\Wms\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['code', 'name', 'type', 'address', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];
}

