<?php

use App\Models\Payment;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('voucherNo');
            $table->string('qty')->nullable();
            $table->string('total');
            $table->string('paymentSlip');
            $table->foreignIdFor(Payment::class, 'paymentID');    
            $table->foreignIdFor(User::class, 'userID'); 
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
