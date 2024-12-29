<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRequestStatusIdToServiceRequestsTable extends Migration
{
    public function up()
    {
        Schema::table('service_requests', function (Blueprint $table) {
            // Проверяем, существует ли колонка перед её добавлением
            if (!Schema::hasColumn('service_requests', 'request_status_id')) {
                $table->unsignedBigInteger('request_status_id')->nullable();
                $table->foreign('request_status_id')->references('id')->on('request_statuses');
            }
        });
    }

    public function down()
    {
        Schema::table('service_requests', function (Blueprint $table) {
            // Проверяем, существует ли колонка перед её удалением
            if (Schema::hasColumn('service_requests', 'request_status_id')) {
                $table->dropForeign(['request_status_id']);
                $table->dropColumn('request_status_id');
            }
        });
    }
}
