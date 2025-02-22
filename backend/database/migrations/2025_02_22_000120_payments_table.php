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
        Schema::create('payments', static function (Blueprint $table) {
            $table->id();
            $table->string('asaas_id')->unique();
            $table->foreignId('customer_id')->index();
            $table->decimal('value', 10, 2);
            $table->string('billing_type');
            $table->string('status');
            $table->string('payment_date')->nullable();
            $table->string('invoice_number');
            $table->string('invoice_url');
            $table->string('transaction_receipt_url');
            $table->boolean('deleted');
            $table->boolean('anticipated');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
