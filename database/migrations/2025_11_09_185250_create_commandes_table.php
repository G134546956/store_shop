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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->string('numero_commande')->unique(); // ex: CMD_2025_001
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('nom_client');
            $table->string('email_client');
            $table->string('telephone');
            $table->text('adresse_livraison');
            $table->dateTime('date_commande')->default(now());
            $table->decimal('montant_total', 10, 2)->default(0);
            $table->enum('etat', ['en_attente', 'en_preparation', 'expédiée', 'livrée', 'annulée'])->default('en_attente');
            $table->enum('mode_paiement', ['en_ligne', 'à_la_livraison'])->default('à_la_livraison');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
