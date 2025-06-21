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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->date("date_debut");
            $table->date("date_fin");
            $table->text("commentaire")->nullable();
            $table->enum("etat",['active','expirée','suspendue']);
            $table->unsignedBigInteger("client_id");
            $table->foreign("client_id")
            ->references("id")
            ->on("clients");
            $table->unsignedBigInteger("offre_id");
            $table->foreign("offre_id")
            ->references("id")
            ->on("offres");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
