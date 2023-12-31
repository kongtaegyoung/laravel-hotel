<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('booking_room_lists', function (Blueprint $table) {
            $table->integer('room_number_id')->change(); // 변경할 타입으로 변경
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('booking_room_lists', function (Blueprint $table) {
            $table->integer('room_number_id')->change(); // 변경할 타입으로 변경
        });
    }
};
