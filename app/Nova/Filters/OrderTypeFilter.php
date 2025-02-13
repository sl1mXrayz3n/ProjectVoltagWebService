<?php

namespace App\Nova\Filters;

use Laravel\Nova\Filters\Filter;
use Illuminate\Http\Request;
use App\Models\OrderType; // Убедись, что путь правильный

class OrderTypeFilter extends Filter
{
    public $name = 'Фильтр по типу заказа';

    public function apply(Request $request, $query, $value)
    {
        return $query->where('order_type_id', $value); // Поле типа заказа
    }

    public function options(Request $request)
    {
        return OrderType::pluck('name', 'id')->toArray();
    }
}
