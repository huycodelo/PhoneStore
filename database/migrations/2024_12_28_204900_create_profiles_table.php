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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id(); // Khoá chính tự động tăng
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Khoá ngoại trỏ đến bảng users
            $table->string('name'); // Tên
            $table->string('email')->unique(); // Email
            $table->string('address')->nullable(); // Địa chỉ, có thể null
            $table->string('birthplace')->nullable(); // Nơi sinh, có thể null
            $table->date('birthdate')->nullable(); // Ngày sinh, có thể null
            $table->string('phone_number')->nullable(); // Số điện thoại, có thể null
            $table->timestamps(); // Cột thời gian tạo và cập nhật
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
