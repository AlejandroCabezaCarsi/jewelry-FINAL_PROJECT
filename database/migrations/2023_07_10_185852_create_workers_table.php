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
            $table->id();
            $table-> string('name');
            $table-> string('surname');
            $table-> string('email');
            $table-> string('password');
            $table-> string('DNI');
            $table-> string('city');
            $table-> string('postalCode');
            $table-> string('address');
            $table-> unsignedBigInteger('socialSecurityNumber');
            $table-> string('bankAccount');
            $table-> string('role_ID');

            $table -> foreign('role_ID') -> references('id') -> on('roles');
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