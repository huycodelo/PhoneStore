<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('img')->nullable();
            $table->integer('quantity')->default(0);
            $table->unsignedBigInteger('category_id');
            $table->text('detail')->nullable();
            $table->text('gallery')->nullable();
            $table->timestamps(); // Đã gọi đây rồi, không cần gọi lại nữa
    
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
