<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstallationObject extends Model
{
    public function orders()
    {
        return $this->hasMany(Order::class, 'installation_object_id');
    }
}
