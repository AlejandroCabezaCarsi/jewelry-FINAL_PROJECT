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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('material_ID');
            $table->unsignedBigInteger('type_ID');
            $table->boolean('diamonds');
            $table->integer('reference');
            $table->float('price');
            $table->string('description');
            $table->string('image');

            $table -> foreign('material_ID')->references('id')->on('materials');
            $table -> foreign('type_ID')->references('id')->on('types');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
