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
        'object_details',
        'counterparty_id',
        'shipment_year',
        'order_type_id',
        'acceptance_id',
        'addition',
        'open_date', 'close_date', 'equipment_status_id',
        'request_description', 'solution', 'responsible_id', 'rejection_reason_id',
        'contact', 'request_status_id', 'request_number'
    ];

    protected $casts = [
        'open_date' => 'date',
        'close_date' => 'date',
    ];

    /**
     * Связь с моделью OrderNumber
     */
    public function orderNumber()
    {
        return $this->belongsTo(OrderNumber::class, 'order_number_id');
    }

    public function installationObject()
    {
        return $this->belongsTo(InstallationObject::class, 'installation_object_id');
    }

    public function counterparty()
    {
        return $this->belongsTo(Counterparty::class, 'counterparty_id');
    }

    public function orderType()
    {
        return $this->belongsTo(OrderType::class, 'order_type_id');
    }

    public function acceptance()
    {
        return $this->belongsTo(Acceptance::class, 'acceptance_id');
    }

    /**
     * Связь с моделью RequestStatus
     */
    public function equipmentStatus()
    {
        return $this->belongsTo(EquipmentStatus::class);
    }

    public function responsible()
    {
        return $this->belongsTo(Responsible::class, 'responsible_id');
    }

    public function rejectionReason()
    {
        return $this->belongsTo(RejectionReason::class);
    }

    public function requestStatus()
    {
        return $this->belongsTo(RequestStatus::class);
    }
}
