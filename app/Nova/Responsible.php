<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Responsible extends Resource
{
    public static $model = 'App\\Models\\Responsible';

    public static $title = 'name';

    public static $search = [
        'id', 'name',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Name')
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
        return '3. Ответственный';
    }

    public static function singularLabel()
    {
        return 'Ответственный';
    }

    public static $group = 'Сервисная служба';
}
