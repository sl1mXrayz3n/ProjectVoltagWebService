<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MultiSelect;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Panel;
use Laravel\Nova\Resource;
use Laravel\Nova\Http\Requests\NovaRequest;

class Otchet extends Resource
{
    public static $model = 'App\\Models\\Otchet';

    public static $title = 'name';

    public static $search = [
        'name',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Название отчёта', 'name')
                ->sortable()
                ->rules('required'),

            new Panel('Выбор данных для отчёта', [
                MultiSelect::make('Отделы', 'departments')
                    ->options([
                        'commercial' => 'Коммерческий отдел',
                        'service' => 'Сервисная служба',
                    ])
                    ->rules('required')
                    ->fillUsing(function ($request, $model, $attribute, $requestAttribute) {
                        $departments = $request->input($attribute);
                        $model->{$attribute} = json_encode($departments);
                    })
                    ->resolveUsing(function ($value) {
                        return json_decode($value, true);
                    }),

                // Поля для выбора данных из таблицы "Order" для Коммерческого отдела
                BelongsTo::make('Данные из Коммерческого отдела', 'order', 'App\\Nova\\Order')
                    ->hideFromIndex()
                    ->dependsOn('departments', function ($field, $request, $formData) {
                        if (!in_array('commercial', $formData->departments ?? [])) {
                            $field->hide();
                        }
                    }),

                // Поля для выбора данных из таблицы "ServiceRequest" для Сервисной службы
                BelongsTo::make('Данные из Сервисной службы', 'serviceRequest', 'App\\Nova\\ServiceRequest')
                    ->hideFromIndex()
                    ->dependsOn('departments', function ($field, $request, $formData) {
                        if (!in_array('service', $formData->departments ?? [])) {
                            $field->hide();
                        }
                    }),
            ]),
        ];
    }

    public static function label()
    {
        return 'Главный Отчёт';
    }

    public static function singularLabel()
    {
        return 'Главный Отчёт';
    }

    public static $group = 'Отчёты';

    public function filters(NovaRequest $request)
    {
        return [];
    }

    public function cards(NovaRequest $request)
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
}
