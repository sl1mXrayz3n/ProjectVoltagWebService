<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSummariesTable extends Migration
{
    public function up()
    {
        Schema::create('summaries', function (Blueprint $table) {
            $table->id();

            // Связь с таблицей order_numbers
            $table->foreignId('order_number_id')
                ->nullable()
                ->constrained('order_numbers')
                ->nullOnDelete();

            // Связь с таблицей installation_objects
            $table->foreignId('installation_object_id')
                ->nullable()
                ->constrained('installation_objects')
                ->nullOnDelete();

            // Поле для объекта установки (уточнение)
            $table->string('object_details')->nullable();

            // Связь с таблицей counterparties
            $table->foreignId('counterparty_id')
                ->nullable()
                ->constrained('counterparties')
                ->nullOnDelete();

            // Поле для года отгрузки
            $table->integer('shipment_year')->nullable();

            // Связь с таблицей order_types
            $table->foreignId('order_type_id')
                ->nullable()
                ->constrained('order_types')
                ->nullOnDelete();

            // Связь с таблицей acceptances
            $table->foreignId('acceptance_id')
                ->nullable()
                ->constrained('acceptances')
                ->nullOnDelete();

            // Поле для дополнения
            $table->text('addition')->nullable();

            // Поля для сервисной службы
            $table->string('request_number')->nullable();  // Номер заявки
            $table->date('open_date')->nullable();        // Дата открытия заявки
            $table->date('close_date')->nullable();       // Дата закрытия заявки

            // Связь с таблицей equipment_statuses
            $table->foreignId('equipment_status_id')
                ->nullable()
                ->constrained('equipment_statuses')
                ->nullOnDelete();

            // Описание заявки
            $table->text('request_description')->nullable();

            // Решение по заявке
            $table->text('solution')->nullable();

            // Связь с таблицей responsables
            $table->foreignId('responsible_id')
                ->nullable()
                ->constrained('responsibles')
                ->nullOnDelete();

            // Связь с таблицей rejection_reasons
            $table->foreignId('rejection_reason_id')
                ->nullable()
                ->constrained('rejection_reasons')
                ->nullOnDelete();

            // Контактная информация
            $table->string('contact')->nullable();

            // Связь с таблицей request_statuses
            $table->foreignId('request_status_id')
                ->nullable()
                ->constrained('request_statuses')
                ->nullOnDelete();

            $table->timestamps(); // Стандартные метки времени для создания и обновления записи
        });
    }

    public function down()
    {
        Schema::dropIfExists('summaries');
    }
}
