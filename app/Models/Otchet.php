<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Otchet extends Model
{
    protected $casts = [
        'departments' => 'array',
        'fields' => 'array', // Если тоже JSON
    ];

    protected $fillable = [
        'name', // Название отчёта
        'departments', // Поле для хранения отделов в виде JSON
        'order_id', // ID для связи с моделью Order
        'service_request_id', // ID для связи с моделью ServiceRequest
    ];

    // Связь с моделью Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Связь с моделью ServiceRequest
    public function serviceRequest()
    {
        return $this->belongsTo(ServiceRequest::class);
    }
}
