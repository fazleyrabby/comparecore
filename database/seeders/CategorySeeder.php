<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Top-level categories
        $categories = [
            'Software' => [
                'icon' => 'monitor',
                'children' => [
                    'AI & Machine Learning' => ['icon' => 'brain', 'children' => [
                        'AI Chatbots', 'AI Coding Assistants', 'AI Image Generators',
                        'AI Video Tools', 'AI Writing Tools', 'AI Search Engines',
                    ]],
                    'Productivity' => ['icon' => 'zap', 'children' => [
                        'Project Management', 'Note Taking', 'Team Collaboration', 'Time Tracking',
                    ]],
                    'Design' => ['icon' => 'palette', 'children' => [
                        'UI/UX Design', 'Graphic Design', 'Prototyping', 'Design Systems',
                    ]],
                    'Development' => ['icon' => 'code', 'children' => [
                        'Code Editors', 'APIs', 'DevOps', 'Database Tools',
                    ]],
                ],
            ],
            'VPN & Security' => [
                'icon' => 'shield',
                'children' => [
                    'VPN Services', 'Password Managers', 'Antivirus', 'Firewall',
                ],
            ],
            'Cloud & Hosting' => [
                'icon' => 'cloud',
                'children' => [
                    'Cloud Providers', 'Web Hosting', 'CDN', 'Serverless',
                ],
            ],
            'Ecommerce' => [
                'icon' => 'shopping-cart',
                'children' => [
                    'Ecommerce Platforms', 'Payment Gateways', 'Email Marketing',
                ],
            ],
            'SaaS' => [
                'icon' => 'layers',
                'children' => [
                    'CRM Software', 'Accounting Software', 'HR Software', 'Analytics',
                ],
            ],
        ];

        foreach ($categories as $name => $data) {
            $parent = Category::firstOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'name' => $name,
                    'icon' => $data['icon'],
                    'description' => null,
                    'is_active' => true,
                ]
            );

            foreach ($data['children'] as $childName => $childData) {
                if (is_array($childData) && isset($childData['children'])) {
                    $child = Category::firstOrCreate(
                        ['slug' => Str::slug($childName)],
                        [
                            'name' => $childName,
                            'parent_id' => $parent->id,
                            'icon' => $childData['icon'],
                            'is_active' => true,
                        ]
                    );

                    foreach ($childData['children'] as $grandchild) {
                        Category::firstOrCreate(
                            ['slug' => Str::slug($grandchild)],
                            [
                                'name' => $grandchild,
                                'parent_id' => $child->id,
                                'is_active' => true,
                            ]
                        );
                    }
                } else {
                    Category::firstOrCreate(
                        ['slug' => Str::slug($childName)],
                        [
                            'name' => $childName,
                            'parent_id' => $parent->id,
                            'icon' => $childData['icon'] ?? null,
                            'is_active' => true,
                        ]
                    );
                }
            }
        }
    }
}
