<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->text('image')->nullable()->after('detail');
        });
        
        Schema::table('products', function (Blueprint $table) {
            $table->text('email')->nullable()->after('detail');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->text('phone')->nullable()->after('detail');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->integer('status')->nullable()->after('detail');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->date('dob')->nullable()->after('detail');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['email', 'phone', 'dob', 'image', 'status']);
            
        });
    }
};
