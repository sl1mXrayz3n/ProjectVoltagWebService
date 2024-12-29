<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateNullableFieldsInServiceRequests extends Migration
{
    public function up()
    {
        Schema::table('service_requests', function (Blueprint $table) {
            $table->date('close_date')->nullable()->change();
            $table->unsignedBigInteger('responsible_id')->nullable()->change();
            $table->unsignedBigInteger('rejection_reason_id')->nullable()->change();
            $table->unsignedBigInteger('request_status_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('service_requests', function (Blueprint $table) {
            $table->date('close_date')->nullable(false)->change();
            $table->unsignedBigInteger('responsible_id')->nullable(false)->change();
            $table->unsignedBigInteger('rejection_reason_id')->nullable(false)->change();
            $table->unsignedBigInteger('request_status_id')->nullable(false)->change();
        });
    }
}
