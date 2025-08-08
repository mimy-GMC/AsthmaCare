<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('air_qualites', function (Blueprint $table) {
            $table->id();
            $table->date('date_mesure');
            $table->unsignedSmallInteger('aqi');// 0-500 max
            $table->decimal('pm2_5', 5,2); // Précision critique santé (particules fines)
            $table->decimal('pm10', 5,2); // Précision critique santé (particules grossières)
            $table->unsignedSmallInteger('pollen')->nullable();
            $table->string('localite');
            $table->foreignId('user_id')->constrained('patients')->onDelete('cascade');       
            $table->timestamps();

            //index pour les performances
            $table->index(['date_mesure', 'localite']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('air_qualites');
    }
};
