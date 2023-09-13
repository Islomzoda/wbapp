<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WBProduct extends Model
{
    use HasFactory;
    public  $timestamps = false;
    protected  $fillable = [
        'brand_id',
        'sizes',
        'media_files',
        'colors',
        'update_at',
        'vendor_code',
        'brand',
        'object',
        'nm_id',
        'imt_id',
        'is_prohibited',
        'tags',
    ];
}
