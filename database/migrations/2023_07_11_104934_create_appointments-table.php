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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table -> unsignedBigInteger('user_ID');
            $table -> unsignedBigInteger('worker_ID');
            $table -> unsignedBigInteger('store_ID');

            $table -> foreign('user_ID') -> references('id') -> on('users');
            $table -> foreign('worker_ID') -> references('id') -> on('workers');
            $table -> foreign('store_ID') -> references('id') -> on('stores');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
