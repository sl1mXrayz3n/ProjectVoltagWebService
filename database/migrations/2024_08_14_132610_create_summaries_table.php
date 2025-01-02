<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('summaries', function (Blueprint $table) {
            $table->id();

            // Поле для связи с таблицей order_numbers (Номер заказа)
            $table->foreignId('order_number_id')->constrained('order_numbers')->onDelete('cascade');

            // Поле для связи с таблицей installation_objects (Объект установки)
            $table->foreignId('installation_object_id')->constrained('installation_objects')->onDelete('cascade');

            // Поле для связи с таблицей request_statuses (Статус заявки)
            $table->foreignId('status_id')->nullable()->constrained('request_statuses')->onDelete('set null');

            // Поле для хранения текстовой информации (уточнение объекта)
            $table->string('object_details');

            // Стандартные поля created_at и updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('summaries');
    }
}
