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
        Schema::create('agent_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('mobile_no');
            $table->string('email');
            $table->string('business_name');
            $table->enum('business_type', ['retail', 'wholesale', 'online', 'other']);
            $table->string('time_of_business');
            $table->text('address');
            $table->string('district');
            $table->string('nid_no')->nullable();
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agent_registrations');
    }
};
