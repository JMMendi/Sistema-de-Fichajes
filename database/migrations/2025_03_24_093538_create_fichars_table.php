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
        Schema::create('fichars', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fechaInicio');
            $table->dateTime('fechaFin')->nullable();
            $table->boolean('modificado')->default(false);
            $table->float('latitudEntrada');
            $table->float('longitudEntrada');
            $table->float('latitudSalida')->nullable();
            $table->float('longitudSalida')->nullable();
            $table->enum('motivoEntrada', ['Rutina', 'Atraso', 'Médico', 'Almuerzo', 'Descanso', 'Otro']);
            $table->enum('motivoSalida', ['Rutina', 'Atraso', 'Médico', 'Almuerzo', 'Descanso', 'Otro'])->nullable();
            $table->enum('tipo', ['Manual', 'Diario']);
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fichars');
    }
};
