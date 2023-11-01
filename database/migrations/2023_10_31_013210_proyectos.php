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
        Schema::create('proyectos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');

            $table->bigInteger('materias_id')->unsigned();
            $table->string('nombre');
            
            // Nuevas columnas para el título, descripción, fecha de entrega y estado
            $table->string('titulo');
            $table->text('descripcion');
            $table->date('fecha_entrega');
            $table->enum('status', ['Pendiente', 'Entregado'])->default('Pendiente');

            $table->timestamps();

            $table->foreign('materias_id')->references('id')->on('materias')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};