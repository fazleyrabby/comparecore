<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            'Open Source', 'Enterprise', 'Freemium', 'Free Trial',
            'API Available', 'No Code', 'Student Discount',
            'Startup Friendly', 'Windows', 'macOS', 'Linux',
            'Web-based', 'Mobile App', 'Chrome Extension',
            'SOC 2', 'GDPR Compliant', 'End-to-End Encrypted',
            'Money-Back Guarantee', 'Unlimited Bandwidth',
            'Zero-Log Policy', 'Multi-Platform', 'AI-Powered',
            'Self-Hosted', 'Cloud-Hosted', 'On-Premise',
        ];

        foreach ($tags as $tag) {
            Tag::firstOrCreate(
                ['slug' => Str::slug($tag)],
                ['name' => $tag]
            );
        }
    }
}
