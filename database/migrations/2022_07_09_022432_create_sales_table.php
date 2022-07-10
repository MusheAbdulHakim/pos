<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->foreignId('customer_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('tax_id')->nullable()->constrained()->onDelete('cascade');
            $table->integer('quantity');
            $table->integer('amount_received')->nullable();
            $table->integer('grand_total')->nullable();
            $table->tinyInteger('payment_by')->nullable();
            $table->tinyInteger('payment_status')->nullable();
            $table->string('sale_note')->nullable();
            $table->string('payment_note')->nullable();
            $table->tinyInteger('discount_type')->nullable();
            $table->integer('discount')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->softDeletes();
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
        Schema::dropIfExists('sales');
    }
}
