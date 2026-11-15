<?php

namespace App\Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = ['code', 'name', 'description', 'is_active'];
}

