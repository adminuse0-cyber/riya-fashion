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
        Schema::create('business_settings', function (Blueprint $table) {
            $table->id();
            $table->string('business_name')->default('Riya Fashion');
            $table->string('tagline')->default('Professional Saree Work & Textile Processing');
            $table->string('owner_name')->default('Pintu Kukadiya');
            $table->string('experience_years')->default('10+ Years');
            $table->string('target_market')->default('Surat, Gujarat');
            $table->string('address_line')->default('B-115, Ishwernagar-2, Near Bombay Market to Sitanagar Road, Punagam');
            $table->string('city')->default('Surat');
            $table->string('state')->default('Gujarat');
            $table->string('pincode')->default('395010');
            $table->string('country')->default('India');
            $table->string('phone')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->string('email')->nullable();
            $table->string('business_hours')->default('Monday - Saturday: 9:00 AM - 8:00 PM | Sunday: Closed');
            $table->text('google_map_embed_url')->nullable();
            $table->text('about_short')->nullable();
            $table->longText('about_full')->nullable();
            $table->string('bulk_work_heading')->default('Bulk & Time-Sensitive Work Support');
            $table->text('bulk_work_description')->nullable();
            $table->text('process_note')->default('Services are customized according to each saree design and merchant requirements. Not every saree requires every service.');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_settings');
    }
};
