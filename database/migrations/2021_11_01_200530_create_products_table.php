<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('name')->unique();
            $table->string('barcode')->nullable()->unique();
            $table->foreignId('brand_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('product_category_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('tax_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('tax_method')->nullable();
            $table->foreignId('product_unit_id')->nullable()->constrained('units','id')->onDelete('cascade');
            $table->foreignId('sale_unit_id')->nullable()->constrained('units','id')->onDelete('cascade');
            $table->foreignId('purchase_unit_id')->nullable()->constrained('units','id')->onDelete('cascade');
            $table->double('cost',8,2)->nullable();
            $table->double('price',8,2)->nullable();
            $table->string('image')->nullable();
            $table->text('details')->nullable();
            $table->integer('alert_quantity')->nullable()->default(1);
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
        Schema::dropIfExists('products');
    }
}
