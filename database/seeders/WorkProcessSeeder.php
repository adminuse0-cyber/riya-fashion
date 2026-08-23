<?php

namespace Database\Seeders;

use App\Models\WorkProcess;
use Illuminate\Database\Seeder;

class WorkProcessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $processes = [
            [
                'step_number' => 1,
                'title' => 'Saree / Material Received',
                'description' => 'Raw, semi-finished, or simple sarees and materials are received from Surat textile merchants at our workshop.',
                'display_order' => 1,
                'is_active' => true,
            ],
            [
                'step_number' => 2,
                'title' => 'Requirement Analysis',
                'description' => 'Fabric type, design expectations, delivery schedules, and specific merchant preferences are thoroughly analyzed.',
                'display_order' => 2,
                'is_active' => true,
            ],
            [
                'step_number' => 3,
                'title' => 'Required Work Selection',
                'description' => 'Only the specific required services are selected (e.g., Lace Patti, Diamond Work, Hotfix, Roll Polish, or Dhaga Cutting). Not every saree goes through every service.',
                'display_order' => 3,
                'is_active' => true,
            ],
            [
                'step_number' => 4,
                'title' => 'Saree Processing',
                'description' => 'Skilled workshop craftsmen execute the selected value-added processing under systematic supervision.',
                'display_order' => 4,
                'is_active' => true,
            ],
            [
                'step_number' => 5,
                'title' => 'Quality Checking',
                'description' => 'Each processed saree undergoes careful manual inspection to ensure craftsmanship, neat finishing, and durability.',
                'display_order' => 5,
                'is_active' => true,
            ],
            [
                'step_number' => 6,
                'title' => 'Final Delivery',
                'description' => 'Finished sarees are neatly packed and safely dispatched or handed over back to the merchant on schedule.',
                'display_order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($processes as $process) {
            WorkProcess::updateOrCreate(
                ['step_number' => $process['step_number']],
                $process
            );
        }
    }
}
