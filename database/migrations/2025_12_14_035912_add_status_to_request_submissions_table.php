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
        Schema::table('request_submissions', function (Blueprint $table) {
            $table->string('status')->default('চলমান')->after('detailed_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('request_submissions', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
