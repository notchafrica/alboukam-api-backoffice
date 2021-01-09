<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('deliver_id')->nullable()->constrained();
            $table->foreignId('parcel_id')->nullable()->constrained();
            $table->string('reference');
            $table->string('amount')->default(0);
            $table->enum('status', ['pending', 'canceled', 'success', 'failed'])->default('pending');
            $table->enum('type', ['checkout', 'withdraw'])->default('checkout');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
