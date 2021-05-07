<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->text('reference_number');
            $table->string('name', 999);
            $table->string('image')->nullable();
            $table->float('sales_price')->default(0.00);
            $table->text('description')->nullable();
            $table->float('purchase_price')->default(0.00);
            $table->float('discount')->default(0.00);
            $table->enum('tax', ['5%', '10%', '20%'])->nullable();
            $table->float('min_price')->default(0.00);
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
        Schema::dropIfExists('services');
    }
}
