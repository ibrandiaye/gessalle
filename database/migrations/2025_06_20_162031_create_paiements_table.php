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
            $table->date("date_paiement");
            $table->integer("montant");
            $table->text("reference");
            $table->enum("type_paiement",['OM','Wave','espece']);
            $table->unsignedBigInteger("souscription_id");
            $table->foreign("souscription_id")
            ->references("id")
            ->on("souscriptions");

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
