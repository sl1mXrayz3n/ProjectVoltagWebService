<?php

namespace App\Nova;

use App\Models\OrderNumber;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;

class LaunchTestSection extends Resource
{
    public static $model = \App\Models\LaunchTestSection::class;

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Номер заявки', 'request_number')
                ->sortable()
                ->rules('required', 'max:255', 'unique:launch_test_sections,request_number')
                ->withMeta(['extraAttributes' => [
                    'placeholder' => 'Введите номер заявки (например, 23001-101)'
                ]]),

            BelongsTo::make('Номер заказа', 'orderNumber', \App\Nova\OrderNumber::class)
                ->sortable()
                ->rules('required')
                ->onlyOnForms(), // Доступно при создании и редактировании
            // Добавляем новое поле для номера платы
            Text::make('Номер платы', 'board_number')
                ->sortable()
                ->rules('required', 'max:255')
                ->creationRules('unique:launch_test_sections,board_number')
                ->updateRules('unique:launch_test_sections,board_number,{{resourceId}}'),
        ];
    }

    public static function authorizedToViewAny(Request $request): true
    {
        return true; // Позволяет всем видеть ресурс
    }

    public static function label()
    {
        return 'Участок запуска и испытаний';
    }

    public static function singularLabel()
    {
        return 'Участок запуска и испытаний';
    }

    public static $group = 'Участок запуска и испытаний';
    public static $priority = 1;
}

