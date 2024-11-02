<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class OrderNumber extends Resource
{
    public static $model = 'App\\Models\\OrderNumber';

    public static $title = 'number';

    public static $search = [
        'id', 'number'
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Order Number', 'number')
                ->sortable()
                ->rules('required', 'max:255'),
        ];
    }

    public function cards(NovaRequest $request)
    {
        return [];
    }

    public function filters(NovaRequest $request)
    {
        return [];
    }

    public function lenses(NovaRequest $request)
    {
        return [];
    }

    public function actions(NovaRequest $request)
    {
        return [];
    }
    public static function label()
    {
        return 'Номера заказов';
    }

    public static function singularLabel()
    {
        return 'Номер заказа';
    }
    public static $group = 'Коммерческий отдел';
}

