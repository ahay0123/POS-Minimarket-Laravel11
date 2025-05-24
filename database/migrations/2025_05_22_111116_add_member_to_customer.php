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
        Schema::table('customers', function (Blueprint $table) {
            //
            $table->string('nama');
            $table->string('no_hp');
            $table->string('alamat');
            $table->date('tanggal_daftar');
            $table->integer('poin');
            $table->enum('status', ['aktif','nonaktif'] );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer', function (Blueprint $table) {
            //
        });
    }
};
