<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_xxxxxx_add_approved_to_items_table.php
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->boolean('approved')->default(false);  // Adds an 'approved' column with a default value of 'false'
        });
    }

    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn('approved');
        });
    }
};
