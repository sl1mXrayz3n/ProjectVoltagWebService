<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEquipmentStatusIdToServiceRequestsTable extends Migration
{
    public function up()
    {
        Schema::table('service_requests', function (Blueprint $table) {
            // Проверяем, существует ли колонка перед её добавлением
            if (!Schema::hasColumn('service_requests', 'equipment_status_id')) {
                $table->unsignedBigInteger('equipment_status_id');
                $table->foreign('equipment_status_id')->references('id')->on('equipment_statuses');
            }
        });
    }

    public function down()
    {
        Schema::table('service_requests', function (Blueprint $table) {
            // Проверяем, существует ли колонка перед её удалением
            if (Schema::hasColumn('service_requests', 'equipment_status_id')) {
                $table->dropForeign(['equipment_status_id']);
                $table->dropColumn('equipment_status_id');
            }
        });
    }
}
