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
            $table->bigInteger('product_id');
            $table->string('invoice');
            $table->enum('price_level', ['retail','wholesale']);
            $table->string('category');
            $table->string('brand');
            $table->string('name');
            $table->float('cost_price');
            $table->float('selling_price');
            $table->Integer('qty');
            $table->float('discount');
            $table->float('amount');
            $table->float('profit');
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
