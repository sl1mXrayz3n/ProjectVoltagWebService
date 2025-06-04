<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddResponsibleIdToServiceRequestsTable extends Migration
{
    public function up()
    {
        Schema::table('service_requests', function (Blueprint $table) {
            // Проверяем, существует ли колонка перед её добавлением
            if (!Schema::hasColumn('service_requests', 'responsible_id')) {
                $table->unsignedBigInteger('responsible_id')->nullable();
                $table->foreign('responsible_id')->references('id')->on('responsibles');
            }
        });
    }

    public function down()
    {
        Schema::table('service_requests', function (Blueprint $table) {
            // Проверяем, существует ли колонка перед её удалением
            if (Schema::hasColumn('service_requests', 'responsible_id')) {
                $table->dropForeign(['responsible_id']);
                $table->dropColumn('responsible_id');
            }
        });
    }
}
