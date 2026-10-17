<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('partners', function (Blueprint $table) {
            // Code pays ISO 3166-1 alpha-2 (ex. « bj »), ou « int » pour une organisation internationale.
            $table->string('country', 3)->nullable()->after('url');
        });
    }

    public function down(): void
    {
        Schema::table('partners', function (Blueprint $table) {
            $table->dropColumn('country');
        });
    }
};
