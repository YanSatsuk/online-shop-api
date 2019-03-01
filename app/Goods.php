<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $fillable = [
        'brand_id',
        'model',
        'price',
        'rating',
        'image_url',
        'category_id',
        'count',
        'status'
    ];
}
