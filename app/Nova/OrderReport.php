<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Nova\Filters\OrderNumberFilter;

class OrderReport extends Resource
{
    public static $model = 'App\\Models\\Order';
    public static $title = 'id';
    public static $search = ['id', 'order_number'];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Номер заказа', 'orderNumber', 'App\Nova\OrderNumber')
                ->searchable()
                ->sortable()
                ->rules('required'),

            Text::make('Объект Установки', function () {
                return $this->installationObject->name ?? '';
            }),

            Text::make('Объект (уточнение)', 'object_details'),

            Text::make('Контрагент', function () {
                return $this->counterparty->name ?? '';
            }),

            Text::make('Год отгрузки', 'shipment_year'),

            Text::make('Тип заказа', function () {
                return $this->orderType->name ?? '';
            }),

            Text::make('Приёмка', function () {
                return $this->acceptance->name ?? '';
            }),

            Text::make('Дополнение', 'addition')
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
        return '2. Отчеты по заказам';
    }

    public static function singularLabel()
    {
        return 'Отчет по заказу';
    }

    public static $group = 'Коммерческий отдел';
}

