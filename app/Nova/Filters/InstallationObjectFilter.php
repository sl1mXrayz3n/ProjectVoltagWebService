<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;
use App\Models\InstallationObject;

class InstallationObjectFilter extends Filter
{
    public $name = 'Объект установки';

    public function apply(Request $request, $query, $value)
    {
        \Log::info('Applying InstallationObjectFilter with value: ' . $value);
        return $query->where('installation_object_id', $value);
    }

    public function options(Request $request)
    {
        return InstallationObject::all()->pluck('name', 'id')->toArray();
    }
}
