<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Nommée "job_postings" (et non "jobs") pour ne pas entrer en conflit
        // avec la table "jobs" utilisée par le système de files d'attente de Laravel.
        Schema::create('job_postings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('contract_type')->nullable(); // CDD, CDI, Consultance...
            $table->string('location')->nullable();
            $table->text('description');
            $table->date('deadline')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_postings');
    }
};
