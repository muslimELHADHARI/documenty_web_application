<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key referencing the users table
            $table->text('description'); // Activity description
            $table->timestamps(); // Created_at and updated_at fields
        });
    }

    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
