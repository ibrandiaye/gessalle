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
        Schema::table('offres', function (Blueprint $table) {
            $table->string("nom");
            $table->text("description")->nullable();
            $table->integer("duree");
            $table->integer("prix");
            $table->unsignedBigInteger("salle_id");
            $table->foreign("salle_id")
            ->references("id")
            ->on("salles");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('offres', function (Blueprint $table) {
            $table->dropColumn("nom");
            $table->dropColumn("description");
            $table->dropColumn("duree");
            $table->dropColumn("prix");
            $table->dropColumn("offres_salle_id_foreign");
            $table->dropColumn("salle_id");

        });
    }
};
