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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string("name", 100);
            $table->timestamps();
        });
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('intro');
            $table->longtext('description');
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->date('date_posted');
            $table->timestamps();

            // Define the foreign key constraint
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $arr = ['categories', 'posts'];
        foreach ($arr as $key) {
            Schema::dropIfExists($key);
        }
    }
};
