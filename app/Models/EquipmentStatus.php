<?php

// app/Models/EquipmentStatus.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentStatus extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequest::class);
    }
}
