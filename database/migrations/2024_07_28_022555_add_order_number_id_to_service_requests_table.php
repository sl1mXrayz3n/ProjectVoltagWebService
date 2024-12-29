<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderNumberIdToServiceRequestsTable extends Migration
{
    public function up()
    {
        Schema::table('service_requests', function (Blueprint $table) {
            // Проверяем, существует ли колонка перед её добавлением
            if (!Schema::hasColumn('service_requests', 'order_number_id')) {
                $table->unsignedBigInteger('order_number_id')->nullable();
                $table->foreign('order_number_id')->references('id')->on('order_numbers');
            }
        });
    }

    public function down()
    {
        Schema::table('service_requests', function (Blueprint $table) {
            // Проверяем, существует ли колонка перед её удалением
            if (Schema::hasColumn('service_requests', 'order_number_id')) {
                $table->dropForeign(['order_number_id']);
                $table->dropColumn('order_number_id');
            }
        });
    }
}
