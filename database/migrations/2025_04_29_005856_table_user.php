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
        //
        Schema::create('table_user', function (Blueprint $table) {
            $table->increments('id_user');
            $table->string('username')->unique();
            $table->string('password');
            $table->enum('role', ['admin', 'kasir'])->default('kasir');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('table_user');
    }
};
