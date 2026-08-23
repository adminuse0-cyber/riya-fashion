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
        Schema::table('business_settings', function (Blueprint $table) {
            // Detailed Business Hours
            $table->string('hours_mon_sat')->nullable()->after('business_hours');
            $table->string('hours_sun')->nullable()->after('hours_mon_sat');
            $table->string('holiday_notes')->nullable()->after('hours_sun');

            // Social & Business Profile Links
            $table->string('whatsapp_link')->nullable()->after('google_map_embed_url');
            $table->string('instagram_url')->nullable()->after('whatsapp_link');
            $table->string('facebook_url')->nullable()->after('instagram_url');
            $table->string('youtube_url')->nullable()->after('facebook_url');
            $table->string('google_business_url')->nullable()->after('youtube_url');

            // Homepage CTA & Hero Elements (To be used when public website is built)
            $table->string('hero_heading')->nullable()->after('process_note');
            $table->text('hero_subheading')->nullable()->after('hero_heading');
            $table->string('hero_cta_text')->nullable()->after('hero_subheading');
            $table->string('hero_cta_link')->nullable()->after('hero_cta_text');

            // Business Branding & Workshop Images (Max 2MB per image)
            $table->string('logo_path')->nullable()->after('hero_cta_link');
            $table->string('workshop_image_path')->nullable()->after('logo_path');
            $table->string('office_image_path')->nullable()->after('workshop_image_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('business_settings', function (Blueprint $table) {
            $table->dropColumn([
                'hours_mon_sat',
                'hours_sun',
                'holiday_notes',
                'whatsapp_link',
                'instagram_url',
                'facebook_url',
                'youtube_url',
                'google_business_url',
                'hero_heading',
                'hero_subheading',
                'hero_cta_text',
                'hero_cta_link',
                'logo_path',
                'workshop_image_path',
                'office_image_path',
            ]);
        });
    }
};
