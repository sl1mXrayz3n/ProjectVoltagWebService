<?php

// app/Models/ServiceRequest.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    protected $fillable = [
        'order_number_id', 'open_date', 'close_date', 'equipment_status_id',
        'request_description', 'solution', 'responsible_id', 'rejection_reason_id',
        'contact', 'request_status_id', 'request_number'
    ];

    protected $casts = [
        'open_date' => 'date',
        'close_date' => 'date',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if ($model->order_number_id) {
                $model->request_number = self::generateRequestNumber($model->order_number_id);
            }
        });
    }

    public static function generateRequestNumber($orderNumberId)
    {
        $orderNumber = OrderNumber::find($orderNumberId)->number;
        $lastRequest = self::where('request_number', 'like', "$orderNumber-%")->latest('id')->first();

        if ($lastRequest) {
            $lastNumber = (int) substr($lastRequest->request_number, strrpos($lastRequest->request_number, '-') + 1);
            return $orderNumber . '-' . ($lastNumber + 1);
        } else {
            return $orderNumber . '-1';
        }
    }

    public function orderNumber()
    {
        return $this->belongsTo(OrderNumber::class);
    }

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



