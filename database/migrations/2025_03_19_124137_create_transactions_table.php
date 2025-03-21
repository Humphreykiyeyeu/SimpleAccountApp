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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->string('transaction_type'); // deposit, withdraw, transfer
            $table->string('transaction_number')->unique();
            $table->string('journal_number')->unique();
            $table->string('description')->nullable();
            $table->decimal('debit', 15, 2)->default(0); 
            $table->decimal('credit', 15, 2)->default(0); 
            $table->decimal('balance', 15, 2)->default(0); 
            $table->timestamps(); 
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
