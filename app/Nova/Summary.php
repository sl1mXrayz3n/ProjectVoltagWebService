<?php

namespace App\Nova;

use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Panel;
use Laravel\Nova\Resource;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Number;

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
                    ->rules('nullable'),

                // Поле для выбора Объекта установки из таблицы InstallationObject
                BelongsTo::make('Объект Установки', 'installationObject', 'App\Nova\InstallationObject')
                    ->sortable()
                    ->rules('nullable'),

                // Поле для текста - уточнение Объекта
                Text::make('Объект (уточнение)', 'object_details')
                    ->sortable()
                    ->rules('nullable'),

                BelongsTo::make('Контрагент', 'counterparty', 'App\Nova\Counterparty')
                    ->sortable()
                    ->rules('nullable'),

                Number::make('Год отгрузки', 'shipment_year')
                    ->rules('nullable', 'digits:4'),

                BelongsTo::make('Тип заказа', 'orderType', 'App\Nova\OrderType')
                    ->sortable()
                    ->rules('nullable'),

                BelongsTo::make('Приёмка', 'acceptance', 'App\Nova\Acceptance')
                    ->sortable()
                    ->rules('nullable'),

                Text::make('Дополнение', 'addition')
                    ->rules('nullable')
                    ->displayUsing(function ($value) {
                        return strip_tags($value);
                    }),
            ]),

            new Panel('Сервисная служба', [
                // Поле для выбора Статуса заявки из таблицы RequestStatus
                Text::make('Номер заявки', 'request_number')
                    ->sortable()
                    ->rules('nullable', 'max:255'),

                Date::make('Дата открытия заявки', 'open_date')
                    ->sortable()
                    ->rules('nullable', 'date'),

                Date::make('Дата закрытия заявки', 'close_date')
                    ->sortable()
                    ->rules('nullable', 'date'),

                BelongsTo::make('Статус оборудования', 'equipmentStatus', EquipmentStatus::class)
                    ->sortable()
                    ->rules('nullable'),

                Text::make('Описание заявки', 'request_description')
                    ->asHtml()
                    ->displayUsing(function ($value) {
                        return '<div class="text-content">' . nl2br(e($value)) . '</div>';
                    }),

                Text::make('Решение', 'solution')
                    ->sortable()
                    ->rules('nullable'),

                BelongsTo::make('Ответственный', 'responsible', Responsible::class)
                    ->sortable()
                    ->rules('nullable'),

                BelongsTo::make('Причина отказа', 'rejectionReason', 'App\Nova\RejectionReason')
                    ->sortable()
                    ->rules('nullable'),

                Text::make('Контакт', 'contact')
                    ->sortable()
                    ->rules('nullable', 'max:255'),

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
