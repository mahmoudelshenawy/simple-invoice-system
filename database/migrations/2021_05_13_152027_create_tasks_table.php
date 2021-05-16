<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->date('date')->nullable();
            $table->string('time')->nullable(); //hours
            $table->integer('dedicated_time')->nullable();
            $table->integer('estimated_time')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->boolean('completed')->default(0);
            $table->boolean('important')->default(0);
            $table->boolean('send_email_in_completed')->default(0);
            $table->integer('percentage_completed')->default(0);
            $table->text('description')->nullable();
            $table->unsignedBigInteger('user_id')->nullable(); //assigned to [employee or user]
            $table->unsignedBigInteger('share_with_admin')->nullable();
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
        Schema::dropIfExists('tasks');
    }
}
