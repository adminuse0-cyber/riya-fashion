<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'Lace Patti / Border Work',
                'slug' => 'lace-patti-border-work',
                'short_description' => 'Precision stitching and attachment of decorative borders, designer lace patti, and finished edging on sarees.',
                'full_description' => 'Our specialized workshop attaches a wide variety of designer lace patti, embroidered borders, and decorative trims according to the merchant’s pattern and fabric specifications.',
                'icon' => 'bi-scissors',
                'display_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Diamond Work',
                'slug' => 'diamond-work',
                'short_description' => 'Careful placement and secure manual application of sparkling stones and decorative diamond embellishments on sarees.',
                'full_description' => 'Skilled artisans apply high-grade decorative crystals and diamonds onto selected sarees, motifs, and borders, enhancing visual appeal with reliable adhesion.',
                'icon' => 'bi-gem',
                'display_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Hotfix / Stone Work',
                'slug' => 'hotfix-stone-work',
                'short_description' => 'Heat and press-based application of decorative hotfix stones, motifs, and crystal elements onto sarees.',
                'full_description' => 'Using heat/press technology, decorative hotfix stones and crystal patterns are securely fused onto sarees with uniform heat application and long-lasting durability.',
                'icon' => 'bi-stars',
                'display_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Roll Polish',
                'slug' => 'roll-polish',
                'short_description' => 'Specialized saree roll polishing and calendar finishing to enhance fabric drape, luster, and hand-feel.',
                'full_description' => 'Restores fabric crispness, smooth finish, and elegant sheen to processed sarees, ensuring they are impeccably presented for wholesale and merchant delivery.',
                'icon' => 'bi-arrow-repeat',
                'display_order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Dhaga Cutting',
                'slug' => 'dhaga-cutting',
                'short_description' => 'Meticulous unwanted thread trimming, finishing, and thorough manual inspection of sarees.',
                'full_description' => 'Careful manual removal of loose and unwanted embroidery/weave threads across the entire saree length, ensuring neat, clean finishing before final delivery.',
                'icon' => 'bi-check2-circle',
                'display_order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($services as $serviceData) {
            Service::updateOrCreate(
                ['slug' => $serviceData['slug']],
                $serviceData
            );
        }
    }
}
