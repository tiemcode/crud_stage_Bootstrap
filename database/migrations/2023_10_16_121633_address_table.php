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
        Schema::create('address', function (Blueprint $table) {
            $array = ['billing', 'shipping'];
            $table->bigIncrements('id');
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->enum('type', $array);
            $table->string('firstName');
            $table->string('lastName');
            $table->string('address');
            $table->string('zipCode');
            $table->string('city');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address');
    }
};
