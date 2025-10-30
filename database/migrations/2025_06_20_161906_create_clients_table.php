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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string("nom");
            $table->string("prenom");
            $table->string("tel")->nullable();
            $table->string("email")->nullable();
            $table->enum("sexe",['h','f']);
            $table->date('date_naiss');
            $table->unsignedBigInteger("salle_id");
            $table->foreign("salle_id")
            ->references("id")
            ->on("salles");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
