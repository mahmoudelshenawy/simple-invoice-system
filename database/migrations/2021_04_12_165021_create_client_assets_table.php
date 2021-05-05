<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_assets', function (Blueprint $table) {
            $table->id();
            $table->text('reference_number');
            $table->string('name');
            $table->string('serial_number')->nullable();
            $table->string('identifier')->nullable();
            $table->string('address')->nullable();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('image')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->text('description')->nullable();
            $table->date('start_of_warranty')->nullable();
            $table->date('end_of_warranty')->nullable();
            $table->text('private_comments')->nullable();
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
        Schema::dropIfExists('client_assets');
    }
}
