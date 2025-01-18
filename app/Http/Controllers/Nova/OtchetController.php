<?php

namespace App\Http\Controllers\Nova;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Nova\Resource;

class OtchetController extends Controller
{
    public function getFieldsOptions(Request $request)
    {
        $departments = $request->input('departments', []);

        $fields = [];

        // Сопоставление отделов с их Nova ресурсами
        $departmentResources = [
            'commercial' => \App\Nova\Order::class,
            'service' => \App\Nova\ServiceRequest::class,
        ];

        foreach ($departments as $department) {
            if (isset($departmentResources[$department])) {
                $resourceClass = $departmentResources[$department];
                $resourceInstance = new $resourceClass(new $resourceClass::$model);

                // Получение полей из Nova ресурса
                $resourceFields = $resourceInstance->fields(request());

                foreach ($resourceFields as $field) {
                    $fields[$department][] = [
                        'name' => $field->name,
                        'attribute' => $field->attribute,
                    ];
                }
            }
        }

        return response()->json($fields);
    }
}

