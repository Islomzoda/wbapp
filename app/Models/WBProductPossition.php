<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WBProductPossition extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'sku',
        'keyword',
        'position',
        'ads',
        'position_before',
        'ads_bet',
        'position_date'
    ];

    // ads 0 - default, 1 - booster, 2 - search adds
}
