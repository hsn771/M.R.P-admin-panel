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
        Schema::create('member_registrations', function (Blueprint $table) {
            $table->id();
            // Personal Information
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('father_name');
            $table->string('mother_name');
            $table->integer('family_member_num');
            $table->string('nid_no');
            $table->string('phone');
            $table->string('religion');
            $table->string('nationality');
            $table->string('merital_status');

            // Permanent Address
            $table->string('village_permanent');
            $table->string('post_name_permanent');
            $table->string('thana_upozilla_permanent');
            $table->string('block_permanent');
            $table->string('district_permanent');
            $table->string('post_code_permanent');

            // Present Address
            $table->string('road_present');
            $table->string('post_name_present');
            $table->string('thana_upozilla_present');
            $table->string('block_present');
            $table->string('district_present');
            $table->string('post_code_present');

            // Sponsor Information
            $table->string('sponsor_name');
            $table->string('sponsor_phone');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_registrations');
    }
};
