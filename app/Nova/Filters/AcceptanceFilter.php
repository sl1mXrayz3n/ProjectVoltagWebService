<?php

namespace App\Nova\Filters;

use Laravel\Nova\Filters\Filter;
use Illuminate\Http\Request;
use App\Models\Acceptance; // Убедись, что путь правильный

class AcceptanceFilter extends Filter
{
    public $name = 'Фильтр по приёмке';

    public function apply(Request $request, $query, $value)
    {
        return $query->where('acceptance_id', $value); // Поле приёмки
    }

    public function options(Request $request)
    {
        return Acceptance::pluck('name', 'id')->toArray();
    }
}
