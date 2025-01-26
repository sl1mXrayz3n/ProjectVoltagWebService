<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaunchTestSection extends Model
{
    // Разрешаем массовое заполнение этих полей
    protected $fillable = [
        'request_number',
        'order_number_id',
        'board_number', // Добавляем поле в fillable
    ];

    // Связь с моделью OrderNumber
    public function orderNumber()
    {
        return $this->belongsTo(OrderNumber::class);
    }
}
