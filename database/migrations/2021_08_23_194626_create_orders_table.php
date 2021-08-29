<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('notes')->nullable();
            $table->enum('payment_type', ['STRIPE', 'CASH', 'PAYPAL', 'CREDIT_CARD']);
            $table->enum('status', ['PENDING', 'REJECTED', 'DELIVERED'])->default('PENDING');
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
        Schema::dropIfExists('orders');
    }
}
