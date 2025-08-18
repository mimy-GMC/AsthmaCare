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
    Schema::create('symptomes', function (Blueprint $table) {
        $table->id();
        $table->date('date_debut');
        $table->unsignedTinyInteger('intensite'); // 1 à 10
        $table->json('declencheurs')->nullable(); // pollen, pollution, etc.
        $table->text('commentaires')->nullable(); // description des symptômes
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->timestamps();
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
