<?php

namespace App\Nova\Filters;

use Laravel\Nova\Filters\Filter;
use Illuminate\Http\Request;
use App\Models\InstallationObject; // Убедись, что путь правильный

class InstallationObjectFilter extends Filter
{
    public $name = 'Фильтр по объекту установки';

    public function apply(Request $request, $query, $value)
    {
        return $query->where('installation_object_id', $value); // Поле объекта установки
    }

    public function options(Request $request)
    {
        return InstallationObject::pluck('name', 'id')->toArray();
    }
}
