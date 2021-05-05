<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_id');
            $table->string('reference_number')->nullable();
            $table->string('title')->nullable();
            $table->text('comments')->nullable();
            $table->text('private_comments')->nullable();
            $table->date('date')->nullable();
            $table->date('delivery_date')->nullable();
            $table->date('valid_until')->nullable();
            $table->date('email_sent_date')->nullable();
            $table->string('currency')->default('USD $- USD Dollar');
            $table->enum('payment_option', ['unspecified', 'bank_transfer', 'direct_debit', 'check', 'cash'])->default('unspecified');
            $table->enum('payment_term', ['immediate_payment', '30-60-90 days_payment'])->default('immediate_payment');
            $table->enum('bank_account', ['credit_bank', 'standard'])->default('credit_bank');
            $table->enum('status', ['Paid', 'Unpaid'])->default('Unpaid');
            $table->boolean('set_as_paid')->default(false);
            $table->unsignedBigInteger('agent')->nullable();
            $table->string('created_by')->nullable();
            $table->foreign('agent')->references('id')->on('users')->onDelete('cascade');
            $table->float('discount')->default(0.00);
            $table->float('subtotal')->default(0.00);
            $table->float('total')->default(0.00);
            $table->enum('tax', ['VAT', 'income_tax'])->default('VAT');
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
        Schema::dropIfExists('purchase_invoices');
    }
}
