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
        Schema::create('infirmiers', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();

            $table->string('specialite');
            $table->integer('experience');
            $table->string('status')->nullable();

            $table->text('description')->nullable();

            $table->enum('validation', [
                'en_attente',
                'accepte',
                'refuse'
            ])->default('en_attente');

            $table->foreign('id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infirmiers');
    }
};
