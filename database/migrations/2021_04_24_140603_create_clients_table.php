<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->text('reference_number');
            $table->text('legal_name');
            $table->text('name');
            $table->text('tin');
            $table->text('phone_1')->nullable();
            $table->text('phone_2')->nullable();
            $table->text('fax')->nullable();
            $table->text('email')->nullable();
            $table->enum('client_category', ['Unspecified', 'End Clients', 'Potential End Clients'])->default('Unspecified');
            $table->text('address')->nullable();
            $table->text('comments')->nullable();
            $table->float('discount', 8)->default(0.00);
            $table->enum('payment_option', ['unspecified', 'bank_transfer', 'direct_debit', 'check', 'cash'])->default('unspecified');
            $table->unsignedBigInteger('agent');
            $table->foreign('agent')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('invoice_to')->nullable();
            $table->foreign('invoice_to')->references('id')->on('clients')->onDelete('cascade');
            $table->enum('payment_terms', ['unspecified', 'immediate_payment', '30-60-90 Days Payment'])->default('unspecified');
            $table->enum('payment_adjustment', ['unspecified', 'previous_than', 'later_than', 'closest_to'])->default('unspecified');
            $table->text('currency')->default('USD $ - US Dollar');
            $table->float('max_risk')->default(0.00);
            $table->boolean('subject_to_VAT')->default(true);
            $table->boolean('subject_to_TAX')->default(false);
            $table->text('bank_account')->nullable();
            $table->text('bank_name')->nullable();
            $table->text('BIC/SWIFT')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
