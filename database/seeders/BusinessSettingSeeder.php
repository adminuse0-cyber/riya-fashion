<?php

namespace Database\Seeders;

use App\Models\BusinessSetting;
use Illuminate\Database\Seeder;

class BusinessSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BusinessSetting::updateOrCreate(
            ['id' => 1],
            [
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
                'phone' => null, // Placeholder to be populated via Admin panel
                'whatsapp_number' => null, // Placeholder to be populated via Admin panel
                'email' => null, // Placeholder to be populated via Admin panel
                'business_hours' => 'Monday - Saturday: 9:00 AM - 8:00 PM | Sunday: Closed',
                'google_map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14879.458925232924!2d72.86874135!3d21.197543!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04f02e604f329%3A0xc0787a412015f8a0!2sPunagam%2C%20Surat%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1700000000000!5m2!1sen!2sin',
                'about_short' => 'Riya Fashion is a dedicated Surat-based textile and saree processing workshop specializing in value-added craftsmanship including lace patti work, diamond work, hotfix stone application, roll polish, and thread finishing.',
                'about_full' => 'With over a decade of hands-on experience in the heart of Surat’s textile industry, Riya Fashion partners with textile merchants and saree traders to deliver reliable, requirement-based saree value-addition. Equipped with our own dedicated office and workshop in Punagam, Surat, our team handles both regular processing batches and urgent time-sensitive bulk requirements with consistent quality control.',
                'bulk_work_heading' => 'Bulk & Time-Sensitive Work Support',
                'bulk_work_description' => 'Equipped with dedicated workshop capacity and experienced craftsmen to handle large volume saree orders and time-sensitive requirements with consistent quality.',
                'process_note' => 'Services are customized according to each saree design and merchant requirements. Not every saree requires every service.',
            ]
        );
    }
}
