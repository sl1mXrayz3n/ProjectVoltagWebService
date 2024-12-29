<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('service_requests', function (Blueprint $table) {
            $table->id();
            $table->string('request_number');
            $table->date('open_date');
            $table->date('close_date')->nullable();
            $table->unsignedBigInteger('equipment_status_id');
            $table->string('request_description');
            $table->string('solution');
            $table->unsignedBigInteger('responsible_id')->nullable();
            $table->unsignedBigInteger('rejection_reason_id')->nullable();
            $table->string('contact');
            $table->unsignedBigInteger('request_status_id')->nullable();
            $table->timestamps();

            // Внешние ключи
            $table->foreign('equipment_status_id')->references('id')->on('equipment_statuses');
            $table->foreign('responsible_id')->references('id')->on('responsibles');
            $table->foreign('rejection_reason_id')->references('id')->on('rejection_reasons');
            $table->foreign('request_status_id')->references('id')->on('request_statuses');
        });
    }

    public function down()
    {
        Schema::dropIfExists('service_requests');
    }
}
