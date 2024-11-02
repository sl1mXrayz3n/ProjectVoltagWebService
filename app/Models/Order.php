<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number_id',
        'installation_object_id',
        'object_details',
        'counterparty_id',
        'shipment_year',
        'order_type_id',
        'acceptance_id',
        'addition',
    ];

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
}



