<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WB extends Model
{
    use HasFactory;
    protected $fillable = [
        'brand_id',
        'name',
        'fbo_api_key',
        'fbs_api_key',
        'ads_api_key',
    ];
}
