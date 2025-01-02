<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Summary extends Model
{
    // Указываем таблицу, связанную с моделью (если не совпадает с именем модели во множественном числе)
    protected $table = 'summaries';

    // Указываем, какие поля могут быть массово назначены
    protected $fillable = [
        'order_number_id',
        'installation_object_id',
        'status_id',
        'object_details',
    ];

    /**
     * Связь с моделью OrderNumber
     */
    public function orderNumber()
    {
        return $this->belongsTo(OrderNumber::class, 'order_number_id');
    }

    /**
     * Связь с моделью InstallationObject
     */
    public function installationObject()
    {
        return $this->belongsTo(InstallationObject::class, 'installation_object_id');
    }

    /**
     * Связь с моделью RequestStatus
     */
    public function requestStatus()
    {
        return $this->belongsTo(RequestStatus::class, 'status_id');
    }
}
