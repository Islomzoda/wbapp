<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WBProductKeyword extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'brand_id',
        'keyword'
    ];
    public function markets()
    {
        return $this->belongsTo(WB::class, 'brand_id', 'brand_id');
    }
}
