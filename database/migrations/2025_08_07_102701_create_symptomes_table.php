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
    Schema::create('symptomes', function (Blueprint $table) {
        $table->id();
        $table->dateTime('date_debut'); // date + heure exacte de la crise
        $table->string('nom'); // nom du symptôme
        $table->unsignedTinyInteger('intensite'); // 1 à 10
        $table->json('declencheurs')->nullable(); // pollen, pollution, etc.
        $table->text('commentaires')->nullable(); // description des symptômes
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->timestamps();

        $table->index(['user_id', 'date_debut']);
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('symptomes');
    }
};
