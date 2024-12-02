<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_number_id');
            $table->unsignedBigInteger('installation_object_id');
            $table->unsignedBigInteger('counterparty_id');
            $table->unsignedBigInteger('order_type_id');
            $table->unsignedBigInteger('acceptance_id');
            $table->string('object_details');
            $table->integer('shipment_year');
            $table->text('addition');
            $table->timestamps();

            $table->foreign('order_number_id')->references('id')->on('order_numbers');
            $table->foreign('installation_object_id')->references('id')->on('installation_objects');
            $table->foreign('counterparty_id')->references('id')->on('counterparties');
            $table->foreign('order_type_id')->references('id')->on('order_types');
            $table->foreign('acceptance_id')->references('id')->on('acceptances');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

