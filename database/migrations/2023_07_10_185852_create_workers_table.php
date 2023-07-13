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
        Schema::create('workers', function (Blueprint $table) {
            $table-> id();
            $table-> unsignedBigInteger('user_ID');
            $table-> unsignedBigInteger('socialSecurityNumber');
            $table-> string('bankAccount');


            $table -> foreign('user_ID') -> references('id') -> on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workers');
    }
};
