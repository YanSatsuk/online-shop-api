<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const STATUS_IN_PROCESS = 'In process';
    const STATUS_DECLINED = 'Declined';
    const STATUS_DONE = 'Done';

    protected $fillable = [
        'user_id',
        'product_id',
        'amount',
        'delivery',
        'address',
        'payment',
        'status',
        'reason'
    ];
}
