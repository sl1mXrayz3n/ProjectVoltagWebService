<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RejectionReason extends Model
{
    protected $fillable = ['name'];

    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequest::class);
    }
}
