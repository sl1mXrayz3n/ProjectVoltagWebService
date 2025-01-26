<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class RequestStatus extends Resource
{
    public static $model = 'App\\Models\\RequestStatus';

    public static $title = 'status';

    public static $search = [
        'id', 'status',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Статус заявки', 'status')
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
        return '4. Статус заявки';
    }

    public static function singularLabel()
    {
        return 'Статус заявки';
    }

    public static $group = 'Сервисная служба';
}
