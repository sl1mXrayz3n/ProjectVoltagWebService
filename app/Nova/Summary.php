<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Panel;
use Laravel\Nova\Resource;
use Laravel\Nova\Http\Requests\NovaRequest;

class Summary extends Resource
{
    public static $model = 'App\\Models\\Summary';  // Указываем правильную модель

    public static $title = 'id';

    public static $search = [
        'id', 'object_details', 'order_number_id', 'installation_object_id', 'status_id',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            new Panel('Коммерческий отдел', [
                // Поле для выбора Номера заказа из таблицы OrderNumber
                BelongsTo::make('Номер заказа', 'orderNumber', 'App\Nova\OrderNumber')
                    ->sortable()
                    ->rules('required'),

                // Поле для выбора Объекта установки из таблицы InstallationObject
                BelongsTo::make('Объект Установки', 'installationObject', 'App\Nova\InstallationObject')
                    ->sortable()
                    ->rules('required'),

                // Поле для текста - уточнение Объекта
                Text::make('Объект (уточнение)', 'object_details')
                    ->sortable()
                    ->rules('required'),
            ]),

            new Panel('Сервисная служба', [
                // Поле для выбора Статуса заявки из таблицы RequestStatus
                BelongsTo::make('Статус заявки', 'requestStatus', 'App\Nova\RequestStatus')
                    ->sortable()
                    ->rules('nullable'),
            ]),
        ];
    }

    public static function label()
    {
        return ('Отчёт');
    }

    public static function singularLabel()
    {
        return ('Запись Отчёта');
    }

    public static $group = 'Отчёты';
}
