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
        Schema::create('bottles', function (Blueprint $table) {
            $table->id();
            $table->string('brand');
            $table->float('liters');
            $table->integer('extrusion_time');
            $table->float('thickness');
            $table->integer('temperature');
            $table->integer('engine_speed');
            $table->float('bandwidth');
            $table->float('tape_length');
            $table->boolean('ventilation');
            $table->timestamp('created_at');
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bottles');
    }
};
