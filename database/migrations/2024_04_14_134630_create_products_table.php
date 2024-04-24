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
            $table->foreignId('category_id')->nullable()->constrained('categories','id')->cascadeOnDelete();
            $table->string('name_ar')->nullable();
            $table->string('name_en')->nullable();

            $table->string('price')->nullable();
            $table->text('product_image')->default('product.png');
            $table->text('description_ar')->nullable();
            $table->text('description_en')->nullable();

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
