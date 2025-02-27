<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTotalSalesTable extends Migration
{
    public function up()
    {
        Schema::create('total_sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->integer('total_sold')->default(0);
            $table->decimal('total_revenue', 10, 2)->default(0);
            $table->timestamps();

            // Foreign key ke tabel products
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('total_sales');
    }
}