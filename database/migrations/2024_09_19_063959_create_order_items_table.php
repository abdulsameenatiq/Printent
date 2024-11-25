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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id');
            $table->unsignedBigInteger('design_id');
            $table->integer('quantity');
            $table->decimal('unit_price');
            $table->string('size');
            $table->string('side');
            $table->integer('days');
            $table->string('note')->nullable();
            $table->json('attributes')->nullable();
            $table->timestamps();

            $table->foreign('subcategory_id')
            ->references('id')
            ->on('subcategories')
            ->onDelete('cascade');

            $table->foreign('order_id')
            ->references('id')
            ->on('orders')
            ->onDelete('cascade');

            $table->foreign('product_id')
            ->references('id')
            ->on('products')
            ->onDelete('cascade');

            $table->foreign('design_id')
            ->references('id')
            ->on('designs')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
