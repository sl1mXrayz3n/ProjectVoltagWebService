<?php

// app/Nova/ServiceRequest.php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Http\Request;

class ServiceRequest extends Resource
{
    public static $model = 'App\\Models\\ServiceRequest';

    public static $title = 'request_number';

    public static $search = [
        'id', 'request_number', 'contact'
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Номер заявки', 'request_number')
                ->sortable()
                ->rules('required', 'max:255')
                ->hideWhenCreating()
                ->hideWhenUpdating(),

            BelongsTo::make('Номер заказа', 'orderNumber', OrderNumber::class)
                ->sortable()
                ->rules('required')
                ->onlyOnForms(), // Видно только при создании и редактировании

            Date::make('Дата открытия заявки', 'open_date')
                ->sortable()
                ->rules('required', 'date'),

            Date::make('Дата закрытия заявки', 'close_date')
                ->sortable()
                ->rules('nullable', 'date'),

            BelongsTo::make('Статус оборудования', 'equipmentStatus', EquipmentStatus::class)
                ->sortable()
                ->rules('required'),

            Text::make('Описание заявки', 'request_description')
                ->asHtml()
                ->displayUsing(function ($value) {
                    return '<div class="text-content">' . nl2br(e($value)) . '</div>';
                }),

            Text::make('Решение', 'solution')
                ->sortable()
                ->rules('required'),

            BelongsTo::make('Ответственный', 'responsible', Responsible::class)
                ->sortable()
                ->rules('nullable'),

            BelongsTo::make('Причина отказа', 'rejectionReason', 'App\Nova\RejectionReason')
                ->sortable()
                ->rules('nullable'),

            Text::make('Контакт', 'contact')
                ->sortable()
                ->rules('required', 'max:255'),

            BelongsTo::make('Статус заявки', 'requestStatus', 'App\Nova\RequestStatus')
                ->sortable()
                ->rules('nullable'),
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
        return 'Сервисная служба';
    }

    public static function singularLabel()
    {
        return 'Запись сервиса';
    }

    public static $group = 'Сервисная служба';
}


