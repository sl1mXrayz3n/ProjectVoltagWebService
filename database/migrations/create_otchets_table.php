<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtchetsTable extends Migration
{
    public function up()
    {
        Schema::create('otchets', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Название отчета
            $table->json('departments'); // Отделы, из которых будет собираться информация
            $table->json('fields')->nullable(); // Поля, которые выбрал пользователь

            // Добавляем внешний ключ для связи с таблицей orders
            $table->unsignedBigInteger('order_id')->nullable();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('set null');

            // Добавляем внешний ключ для связи с таблицей service_requests
            $table->unsignedBigInteger('service_request_id')->nullable();
            $table->foreign('service_request_id')->references('id')->on('service_requests')->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('otchets');
    }
}
