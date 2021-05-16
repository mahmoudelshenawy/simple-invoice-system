<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->text('reference_number');
            $table->string('name', 999);
            $table->string('image')->nullable();
            $table->float('sales_price')->default(0.00);
            $table->float('special_sales_price')->default(0.00);
            $table->float('whole_sales_price')->default(0.00);
            $table->float('purchase_price')->default(0.00);
            $table->float('profit_margin')->default(0.00);
            $table->integer('barcode')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->boolean('inactive')->default(false);
            $table->text('description')->nullable();
            $table->float('discount')->default(0.00);
            $table->float('tax')->default(0.00);
            $table->float('min_price')->default(0.00);
            $table->integer('stock')->default(0);
            $table->integer('min_stock')->default(0);
            $table->boolean('managed_stock')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
