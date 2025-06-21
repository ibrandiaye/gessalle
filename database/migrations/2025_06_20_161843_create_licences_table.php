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
        Schema::create('licences', function (Blueprint $table) {
            $table->id();
            $table->string("type");
            $table->date("date_debut");
            $table->date("date_fin");
            $table->double("montant");
            $table->enum("statut",['active','expire']);
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
        Schema::dropIfExists('licences');
    }
};
