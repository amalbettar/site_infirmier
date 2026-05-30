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
        Schema::create('rendezvous', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('heure');

            $table->string('service');

            $table->enum('etat', [
                'en_attente',
                'confirme',
                'annule',
                'termine'
            ])->default('en_attente');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('infirmier_id');

            $table->foreign('patient_id')
                ->references('id')
                ->on('patients')
                ->onDelete('cascade');

            $table->foreign('infirmier_id')
                ->references('id')
                ->on('infirmiers')
                ->onDelete('cascade');
                
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rendezvous');
    }
};
