<?php

namespace App\Nova\Filters;

use Laravel\Nova\Filters\Filter;
use Illuminate\Http\Request;
use App\Models\OrderNumber; // Убедись, что путь правильный

class OrderNumberFilter extends Filter
{
    public $name = 'Фильтр по номеру заказа';

    public function apply(Request $request, $query, $value)
    {
        return $query->where('order_number_id', $value); // Убедись, что поле называется order_number_id
    }

    public function options(Request $request)
    {
        // Генерируем список из связанных значений номера заказа
        return OrderNumber::pluck('number', 'id')->toArray();
    }
}
