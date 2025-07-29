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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('shipping_name')->nullable()->after('paymentID');
            $table->string('shipping_address')->nullable()->after('shipping_name');
            $table->string('shipping_phone')->nullable()->after('shipping_address');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['shipping_name','shipping_address','shipping_phone']);
        });
    }
};
