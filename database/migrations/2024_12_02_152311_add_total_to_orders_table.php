<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
     * Chạy migration để thêm cột `total`.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('total', 15, 2)->default(0);  // Thêm cột `total` với kiểu dữ liệu decimal
        });
    }

    /**
     * Reverse migration (hủy bỏ cột `total`).
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('total');  // Xóa cột `total` khi rollback migration
        });
    }
};
