<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/2025_xx_xx_create_colors_table.php
    public function up()
    {
        Schema::create('colors', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(); // إسم/وصف اللون
            $table->string('hex', 7); // "#aabbcc"
            $table->float('lab_l', 8,);
            $table->float('lab_a', 8,);
            $table->float('lab_b', 8,);
            $table->string('model_3d')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('name');
        Schema::dropIfExists('hex');
        Schema::dropIfExists('lab_l');
        Schema::dropIfExists('lab_a');
        Schema::dropIfExists('lab_b');
    }
};
