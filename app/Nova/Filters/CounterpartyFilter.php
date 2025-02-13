<?php

namespace App\Nova\Filters;

use Laravel\Nova\Filters\Filter;
use Illuminate\Http\Request;
use App\Models\Counterparty; // Убедись, что путь правильный

class CounterpartyFilter extends Filter
{
    public $name = 'Фильтр по контрагенту';

    public function apply(Request $request, $query, $value)
    {
        return $query->where('counterparty_id', $value); // Поле контрагента
    }

    public function options(Request $request)
    {
        return Counterparty::pluck('name', 'id')->toArray();
    }
}
