<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('order_detail', function (Blueprint $table) {
            $table->renameColumn('order_id', 'id_order');
        });
    }

    public function down()
    {
        Schema::table('order_detail', function (Blueprint $table) {
            $table->renameColumn('id_order', 'order_id');
        });
    }
};
