<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_name',
        'tagline',
        'owner_name',
        'experience_years',
        'target_market',
        'address_line',
        'city',
        'state',
        'pincode',
        'country',
        'phone',
        'whatsapp_number',
        'email',
        'business_hours',
        'hours_mon_sat',
        'hours_sun',
        'holiday_notes',
        'google_map_embed_url',
        'whatsapp_link',
        'instagram_url',
        'facebook_url',
        'youtube_url',
        'google_business_url',
        'about_short',
        'about_full',
        'bulk_work_heading',
        'bulk_work_description',
        'process_note',
        'hero_heading',
        'hero_subheading',
        'hero_cta_text',
        'hero_cta_link',
        'logo_path',
        'workshop_image_path',
        'office_image_path',
    ];

    /**
     * Get the single business settings instance (singleton helper).
     */
    public static function getSettings(): self
    {
        return static::firstOrCreate([], [
            'business_name' => 'Riya Fashion',
            'tagline' => 'Professional Saree Work & Textile Processing',
            'owner_name' => 'Pintu Kukadiya',
            'experience_years' => '10+ Years',
            'target_market' => 'Surat, Gujarat',
            'address_line' => 'B-115, Ishwernagar-2, Near Bombay Market to Sitanagar Road, Punagam',
            'city' => 'Surat',
            'state' => 'Gujarat',
            'pincode' => '395010',
            'country' => 'India',
            'business_hours' => 'Monday - Saturday: 9:00 AM - 8:00 PM | Sunday: Closed',
            'hours_mon_sat' => '9:00 AM - 8:00 PM',
            'hours_sun' => 'Closed',
            'bulk_work_heading' => 'Bulk & Time-Sensitive Work Support',
            'bulk_work_description' => 'Equipped with dedicated workshop capacity and experienced craftsmen to handle large volume saree orders and time-sensitive requirements with consistent quality.',
            'process_note' => 'Services are customized according to each saree design and merchant requirements. Not every saree requires every service.',
            'hero_heading' => 'Professional Saree Work & Value-Added Textile Processing',
            'hero_subheading' => 'Specialized value-addition, border stitching, diamond placement, hotfix stones, roll polishing, and thread cutting for Surat textile merchants.',
            'hero_cta_text' => 'Explore Our Work',
            'hero_cta_link' => '#services',
        ]);
    }
}
