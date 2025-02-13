<?php

namespace App\Nova\Filters;

use Laravel\Nova\Filters\Filter;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class ShipmentYearFilter extends Filter
{
    public $name = 'Фильтр по году отгрузки';

    public function apply(Request $request, $query, $value)
    {
        return $query->where('shipment_year', $value);
    }

    public function options(Request $request)
    {
        return [
            '2030' => 2030,
            '2029' => 2029,
            '2028' => 2028,
            '2027' => 2027,
            '2026' => 2026,
            '2025' => 2025,
            '2024' => 2024,
            '2023' => 2023,
            '2022' => 2022,
            '2021' => 2021,
            '2020' => 2020,
            // добавь сюда все нужные года
        ];
    }
}
