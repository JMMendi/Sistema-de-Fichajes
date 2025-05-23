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
        Schema::create('festivos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('dia');
            $table->string('mes');
            $table->enum('tipo', ['Fijo', 'Variable']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('festivos');
    }
};
