<?php

namespace App\Nova;

use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;

class Order extends Resource
{
    public static $model = 'App\\Models\\Order';

    public static $title = 'id';

    public static $search = [
        'id', 'order_number'
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Номер заказа', 'orderNumber', 'App\Nova\OrderNumber')
                ->rules('required'),


            BelongsTo::make('Объект Установки', 'installationObject', 'App\Nova\InstallationObject')
                ->sortable()
                ->rules('required'),

            Text::make('Объект (уточнение)', 'object_details')
                ->rules('required'),

            BelongsTo::make('Контрагент', 'counterparty', 'App\Nova\Counterparty')
                ->sortable()
                ->rules('required'),

            Number::make('Год отгрузки', 'shipment_year')
                ->rules('required', 'digits:4'),

            BelongsTo::make('Тип заказа', 'orderType', 'App\Nova\OrderType')
                ->sortable()
                ->rules('required'),


            BelongsTo::make('Приёмка', 'acceptance', 'App\Nova\Acceptance')
                ->sortable()
                ->rules('required'),

            Text::make('Дополнение', 'addition')
                ->rules('required')
                ->displayUsing(function ($value) {
                    return strip_tags($value);
                }),
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
        return 'Заказы';
    }

    public static function singularLabel()
    {
        return 'Заказ';
    }
    public static $group = 'Коммерческий отдел';
}
