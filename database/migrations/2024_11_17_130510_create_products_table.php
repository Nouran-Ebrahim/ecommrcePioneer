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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('small_desc');
            $table->boolean('status')->default(1);
            $table->string('sku');
            $table->date('available_for')->nullable();
            $table->decimal('price', 8, 2);
            $table->decimal('discount', 8, 2);
            $table->date('start_disc')->nullable();
            $table->date('end_disc')->nullable();
            $table->boolean('manage_stock')->default(0);
            $table->integer('quantity');
            $table->boolean('available_in_stock')->default(1);
            $table->integer('views');
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->foreignId('brand_id')->constrained('brands')->cascadeOnDelete();

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
