<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('phone_number');
            $table->decimal('amount', 10, 2);
            $table->string('account_reference')->nullable();
            $table->string('transaction_desc')->nullable();
            $table->string('status')->default('pending'); // Transaction status
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
