<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('launch_test_sections', function (Blueprint $table) {
            $table->id();
            $table->string('request_number');
            $table->foreignId('order_number_id')->constrained('order_numbers');
            $table->string('board_number'); // Добавляем колонку для номера платы
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('launch_test_sections');
    }
};
