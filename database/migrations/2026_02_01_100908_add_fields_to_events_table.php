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
        Schema::table('events', function (Blueprint $table) {
            $table->string('image')->nullable()->after('id');
            $table->string('type_name')->nullable()->after('image');
            $table->string('address')->nullable()->after('title');
            $table->string('time')->nullable()->after('address');
            $table->json('reasons')->nullable()->after('description');
            $table->json('schedule')->nullable()->after('reasons');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['image', 'type_name', 'address', 'time', 'reasons', 'schedule']);
        });
    }
};
