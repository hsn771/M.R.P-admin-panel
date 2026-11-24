<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('share_investments', function (Blueprint $table) {
            $table->id();
            $table->string('member_id')->nullable();

            // Customer (applicant)
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('customer_photo')->nullable();
            foreach (['customer_permanent', 'customer_present', 'nominee_permanent', 'nominee_present'] as $prefix) {
                $table->string("{$prefix}_holding_no")->nullable();
                $table->string("{$prefix}_village")->nullable();
                $table->string("{$prefix}_ward_no")->nullable();
                $table->string("{$prefix}_union")->nullable();
                $table->string("{$prefix}_thana")->nullable();
                $table->string("{$prefix}_district")->nullable();
            }

            // Nominee
            $table->string('nominee_name');
            $table->string('nominee_photo')->nullable();

            // Investment
            $table->string('investment_category'); // daily, weekly, monthly, one_time
            $table->string('investment_duration');
            $table->decimal('investment_amount', 15, 2);
            $table->string('investment_amount_in_words');

            // Sponsor
            $table->string('sponsor_name')->nullable();
            $table->string('sponsor_id_mobile')->nullable();

            $table->string('digital_sign')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('share_investments');
    }
};
