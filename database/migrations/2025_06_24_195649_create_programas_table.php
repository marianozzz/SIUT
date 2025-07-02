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
        Schema::create('programas', function (Blueprint $table) {
                $table->id();
                $table->foreignId('planificacion_id')->constrained()->onDelete('cascade');
                $table->string('eje_tematico')->nullable();
                $table->string('unidad')->nullable();
                $table->enum('cuatrimestre', ['1°', '2°'])->nullable();
                $table->text('contenidos')->nullable();
                $table->text('actividades')->nullable();
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programas');
    }
};
