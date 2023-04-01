<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->foreignId('customer_id')->nullable(true)->constrained('customers', 'id')->onDelete('cascade');
            $table->decimal('total', 16, 2)->nullable(true);
            $table->decimal('kembalian', 16, 2)->nullable(true);
            $table->decimal('pay', 16, 2)->nullable(true);
            $table->string('status_transaction')->default('pending');
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
        Schema::dropIfExists('transactions');
    }
};
