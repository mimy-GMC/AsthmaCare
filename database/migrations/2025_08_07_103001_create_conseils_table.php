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
        Schema::create('conseils', function (Blueprint $table) {
            $table->id();
            $table->string('categorie'); // Catégorie du conseil pour filtrer ou organiser l'information (ex: sport, environnement, médication,...)
            $table->text('contenu'); // message pour être actionnable ou personnalisé
            $table->unsignedTinyInteger('niveau_alerte')->comment('0-1:Information, 2-3:Attention, 4-5:Vigilance, 6-10:Alerte');
            $table->foreignId('user_id')->constrained('patients')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conseils');
    }
};
