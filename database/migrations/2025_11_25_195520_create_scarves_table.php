<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('scarves', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('image_url');
      $table->unsignedBigInteger('color_id')->nullable(); // foreign key
      $table->unsignedBigInteger('product_id')->nullable(); // foreign key
      $table->timestamps();

      $table->foreign('color_id')->references('id')->on('colors')->onDelete('set null');
      $table->foreign('product_id')->references('id')->on('products')->onDelete('set null');
    });

  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('scarves');
  }
};
