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
            Schema::create('cursos', function (Blueprint $table) {
                $table->id();
                $table->string('nivel');
                $table->unsignedBigInteger('especialidad_id')->nullable(); // ahora puede ser null
                $table->foreignId('ciclo_id')->constrained()->onDelete('cascade');
                $table->foreign('especialidad_id')->references('id')->on('especialidades')->onDelete('cascade');
                $table->foreignId('division_id')->constrained()->onDelete('cascade');
                $table->timestamps();
            });
        }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cursos');
    }
};
