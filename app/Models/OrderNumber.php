<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderNumber extends Model
{
    public function orders()
    {
        return $this->hasMany(Order::class, 'order_number_id');
    }
}
