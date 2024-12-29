<?php

// database/migrations/xxxx_xx_xx_create_equipment_statuses_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentStatusesTable extends Migration
{
    public function up()
    {
        Schema::create('equipment_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('equipment_statuses');
    }
}


