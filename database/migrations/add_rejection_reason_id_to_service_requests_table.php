<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRejectionReasonIdToServiceRequestsTable extends Migration
{
    public function up()
    {
        Schema::table('service_requests', function (Blueprint $table) {
            // Проверяем, существует ли колонка перед её добавлением
            if (!Schema::hasColumn('service_requests', 'rejection_reason_id')) {
                $table->unsignedBigInteger('rejection_reason_id')->nullable();
                $table->foreign('rejection_reason_id')->references('id')->on('rejection_reasons');
            }
        });
    }

    public function down()
    {
        Schema::table('service_requests', function (Blueprint $table) {
            // Проверяем, существует ли колонка перед её удалением
            if (Schema::hasColumn('service_requests', 'rejection_reason_id')) {
                $table->dropForeign(['rejection_reason_id']);
                $table->dropColumn('rejection_reason_id');
            }
        });
    }
}
