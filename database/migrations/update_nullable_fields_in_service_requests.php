<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateNullableFieldsInServiceRequests extends Migration
{
    public function up()
    {
        Schema::table('service_requests', function (Blueprint $table) {
            $table->date('new_close_date')->nullable();
            $table->unsignedBigInteger('new_responsible_id')->nullable();
            $table->unsignedBigInteger('new_rejection_reason_id')->nullable();
            $table->unsignedBigInteger('new_request_status_id')->nullable();
        });

        // Копируем данные из старых столбцов в новые
        DB::table('service_requests')->update([
            'new_close_date' => DB::raw('close_date'),
            'new_responsible_id' => DB::raw('responsible_id'),
            'new_rejection_reason_id' => DB::raw('rejection_reason_id'),
            'new_request_status_id' => DB::raw('request_status_id')
        ]);

        // Удаляем старые столбцы
        Schema::table('service_requests', function (Blueprint $table) {
            $table->dropColumn('close_date');
            $table->dropColumn('responsible_id');
            $table->dropColumn('rejection_reason_id');
            $table->dropColumn('request_status_id');
        });

        // Переименовываем новые столбцы
        Schema::table('service_requests', function (Blueprint $table) {
            $table->renameColumn('new_close_date', 'close_date');
            $table->renameColumn('new_responsible_id', 'responsible_id');
            $table->renameColumn('new_rejection_reason_id', 'rejection_reason_id');
            $table->renameColumn('new_request_status_id', 'request_status_id');
        });
    }

    public function down()
    {
        // Восстанавливаем изменения аналогично тому, как они были сделаны в up()
        Schema::table('service_requests', function (Blueprint $table) {
            $table->date('old_close_date')->nullable(false);
            $table->unsignedBigInteger('old_responsible_id')->nullable(false);
            $table->unsignedBigInteger('old_rejection_reason_id')->nullable(false);
            $table->unsignedBigInteger('old_request_status_id')->nullable(false);
        });

        DB::table('service_requests')->update([
            'old_close_date' => DB::raw('close_date'),
            'old_responsible_id' => DB::raw('responsible_id'),
            'old_rejection_reason_id' => DB::raw('rejection_reason_id'),
            'old_request_status_id' => DB::raw('request_status_id')
        ]);

        Schema::table('service_requests', function (Blueprint $table) {
            $table->dropColumn('close_date');
            $table->dropColumn('responsible_id');
            $table->dropColumn('rejection_reason_id');
            $table->dropColumn('request_status_id');
        });

        Schema::table('service_requests', function (Blueprint $table) {
            $table->renameColumn('old_close_date', 'close_date');
            $table->renameColumn('old_responsible_id', 'responsible_id');
            $table->renameColumn('old_rejection_reason_id', 'rejection_reason_id');
            $table->renameColumn('old_request_status_id', 'request_status_id');
        });
    }
}
