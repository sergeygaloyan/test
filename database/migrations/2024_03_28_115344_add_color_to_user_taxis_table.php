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
        Schema::table('user_taxis', function (Blueprint $table) {
            $table->enum('color', ['red', 'yellow', 'blue'])->default('red');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_taxis', function (Blueprint $table) {
            $table->dropColumn('color');
        });
    }
};

