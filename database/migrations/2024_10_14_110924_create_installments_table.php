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
        Schema::create('installments', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount',10 ,2);// Amount of each installment
            $table->date('due_date');// Due date for the installment
            $table->unsignedBigInteger('account_payable_id')->nullable();// Foreign key to account payable
            $table->unsignedBigInteger('account_receivable_id')->nullable();// Foreign key to account receivable
            $table->foreign('account_payable_id')->references('id')->on('accounts_payable')->onDelete('cascade');
            $table->foreign('account_receivable_id')->references('id')->on('accounts_receivable')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('installments');
    }
};
