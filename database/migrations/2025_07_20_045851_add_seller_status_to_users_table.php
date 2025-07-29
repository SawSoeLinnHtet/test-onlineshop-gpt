<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the old boolean if you no longer need it:
            if (Schema::hasColumn('users','is_seller')) {
                $table->dropColumn('is_seller');
            }

            // Add the status column
            $table->string('seller_status')
                  ->default('none')   // possible: none, pending, approved, rejected
                  ->after('password');
        });
        
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('seller_status');
            // optionally re-add is_seller here if needed
        });
    }
};
