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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('payment_no');
            $table->string('payment_status')->nullable();
            $table->string('session_status')->nullable();
            $table->string('intent_id')->nullable();
            $table->string('amount_subtotal')->nullable();
            $table->string('amount_total')->nullable();
            $table->string('amount_tax')->nullable();
            $table->text('receipt')->nullable();
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
