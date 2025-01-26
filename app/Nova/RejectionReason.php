<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class RejectionReason extends Resource
{
    public static $model = 'App\\Models\\RejectionReason';

    public static $title = 'reason';

    public static $search = [
        'id', 'reason',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Причина отказа', 'reason')
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
        return '3. Причина отказа';
    }

    public static function singularLabel()
    {
        return 'Причина отказа';
    }

    public static $group = 'Сервисная служба';
}
