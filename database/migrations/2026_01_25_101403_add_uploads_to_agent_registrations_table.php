<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('agent_registrations', function (Blueprint $table) {
            $table->string('birth_certificate')->nullable();
            $table->string('nid_file')->nullable();
            $table->string('photo_up')->nullable();
            $table->string('chairman_certificate')->nullable();
            $table->string('husbands_information')->nullable();
            $table->string('considerable_person_sign')->nullable();
            $table->string('bank_check')->nullable();
            $table->string('trade_license')->nullable();
            $table->string('digital_sign')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agent_registrations', function (Blueprint $table) {
            $table->dropColumn([
                'birth_certificate',
                'nid_file',
                'photo_up',
                'chairman_certificate',
                'husbands_information',
                'considerable_person_sign',
                'bank_check',
                'trade_license',
                'digital_sign',
            ]);
        });
    }
};
