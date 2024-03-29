<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Color_change extends Model
{
    protected $fillable = [
        'user_taxis_id', 'color', 'count'
    ];
    protected $table = 'color_change';

}
