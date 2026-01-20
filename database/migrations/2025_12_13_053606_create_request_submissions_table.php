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
        Schema::create('request_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // আপনার নাম
            $table->string('subject'); // বিষয়
            $table->text('address'); // ঠিকানা
            $table->string('email')->nullable(); // ইমেইল / যদি থাকে
            $table->string('mobile_number'); // মোবাইল নম্বর
            $table->string('voter_id_card_number'); // ভোটার আইডি কার্ড নাম্বার
            $table->text('detailed_description'); // বিস্তারিত বিবরণ
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_submissions');
    }
};
