<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;
use App\Models\OrderNumber;

class OrderNumberFilter extends Filter
{
    public $name = 'Номер заказа';

    public function apply(Request $request, $query, $value)
    {
        return $query->where('order_number_id', $value);
    }

    public function options(Request $request)
    {
        return OrderNumber::all()->pluck('number', 'id')->toArray();
    }
}
