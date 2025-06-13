<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');
            $table->string('apellido');
            $table->string('dni', 15)->unique();

            $table->date('fecha_nacimiento')->nullable();
            $table->string('sexo', 10)->nullable(); // Masculino, Femenino, Otro
            $table->string('nacionalidad')->nullable();

            $table->string('email')->nullable()->unique();
            $table->string('telefono', 20)->nullable();
            $table->string('domicilio')->nullable();

            $table->boolean('activo')->default(true); // útil para egresados o bajas
            $table->timestamps();
            // $table->softDeletes(); // si querés manejar "bajas" lógicas
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }
};
