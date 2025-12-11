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
        Schema::create('ordenes', function (Blueprint $table) {
           $table->id();
        $table->string('nombre');
        $table->string('direccion');
        $table->string('ciudad');
        $table->string('zip');
        $table->string('pais');

        $table->string('metodo_pago');
        $table->unsignedBigInteger('tarjeta_id')->nullable(); // Foreign key opcional

        $table->decimal('total', 10, 2);

        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordenes');
    }
};
