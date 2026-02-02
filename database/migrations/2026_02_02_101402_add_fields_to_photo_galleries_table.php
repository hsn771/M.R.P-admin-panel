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
        Schema::table('photo_galleries', function (Blueprint $table) {
            $table->string('title')->nullable()->after('id');
            $table->date('date')->nullable()->after('title');
            $table->json('images')->nullable()->after('date');
            $table->dropColumn('image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('photo_galleries', function (Blueprint $table) {
            $table->string('image')->after('id');
            $table->dropColumn(['title', 'date', 'images']);
        });
    }
};
