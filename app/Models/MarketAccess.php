<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Fields\BelongsTo;
use MoonShine\Models\MoonshineUser;

class MarketAccess extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'brand_id',
        'access'
    ];

     public function users()
     {
        return $this->belongsTo(MoonshineUser::class, 'user_id', 'id');
    }
   public function markets()
   {
        return $this->belongsTo(WB::class, 'brand_id', 'brand_id');
    }


}
