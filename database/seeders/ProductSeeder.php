<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // AI Chatbots
            [
                'name' => 'ChatGPT',
                'brand' => 'OpenAI',
                'description' => 'AI-powered chatbot and virtual assistant. Conversational AI for writing, analysis, coding, and creative tasks.',
                'status' => 'published',
                'categories' => ['AI Chatbots'],
                'tags' => ['Freemium', 'API Available', 'Web-based', 'Mobile App', 'AI-Powered'],
                'attributes' => [
                    'free_tier' => 'Yes',
                    'context_window' => '128K (GPT-4o)',
                    'languages_supported' => '100+',
                    'pricing_model' => 'Subscription + Usage',
                    'api_access' => 'Yes',
                    'mobile_app' => 'Yes',
                    'platforms' => 'Web, iOS, Android, macOS, Windows',
                ],
            ],
            [
                'name' => 'Claude',
                'brand' => 'Anthropic',
                'description' => 'AI assistant built by Anthropic. Known for long context windows, safety, and nuanced reasoning.',
                'status' => 'published',
                'categories' => ['AI Chatbots'],
                'tags' => ['Freemium', 'API Available', 'Web-based', 'AI-Powered', 'SOC 2'],
                'attributes' => [
                    'free_tier' => 'Yes',
                    'context_window' => '200K',
                    'languages_supported' => 'Multilingual',
                    'pricing_model' => 'Subscription + Usage',
                    'api_access' => 'Yes',
                    'mobile_app' => 'Yes',
                    'platforms' => 'Web, iOS, Android',
                ],
            ],
            [
                'name' => 'Gemini',
                'brand' => 'Google',
                'description' => 'Google AI assistant powered by Gemini models. Integrates with Google Workspace.',
                'status' => 'published',
                'categories' => ['AI Chatbots'],
                'tags' => ['Freemium', 'API Available', 'Web-based', 'Mobile App', 'AI-Powered'],
                'attributes' => [
                    'free_tier' => 'Yes',
                    'context_window' => '1M (Gemini 1.5 Pro)',
                    'languages_supported' => '40+',
                    'pricing_model' => 'Subscription',
                    'api_access' => 'Yes',
                    'mobile_app' => 'Yes',
                    'platforms' => 'Web, iOS, Android',
                ],
            ],

            // AI Coding
            [
                'name' => 'GitHub Copilot',
                'brand' => 'Microsoft',
                'description' => 'AI pair programmer. Code completion and generation powered by GPT models.',
                'status' => 'published',
                'categories' => ['AI Coding Assistants'],
                'tags' => ['Paid', 'API Available', 'IDE Integration', 'AI-Powered'],
                'attributes' => [
                    'pricing_model' => 'Monthly Subscription',
                    'price' => '$10/mo individual',
                    'ide_support' => 'VS Code, JetBrains, Neovim, Xcode',
                    'code_completion' => 'Real-time',
                    'chat_support' => 'Yes',
                    'multi_file' => 'Yes',
                ],
            ],
            [
                'name' => 'Cursor',
                'brand' => 'Cursor',
                'description' => 'AI-first code editor. Built on VS Code with native AI code editing and generation.',
                'status' => 'published',
                'categories' => ['AI Coding Assistants', 'Code Editors'],
                'tags' => ['Freemium', 'macOS', 'Windows', 'Linux', 'AI-Powered'],
                'attributes' => [
                    'pricing_model' => 'Freemium',
                    'free_tier' => 'Yes (limited)',
                    'code_completion' => 'Real-time',
                    'ai_chat' => 'Yes',
                    'multi_file_editing' => 'Yes',
                    'terminal_integration' => 'Yes',
                    'git_integration' => 'Yes',
                ],
            ],
            [
                'name' => 'JetBrains AI Assistant',
                'brand' => 'JetBrains',
                'description' => 'AI-powered coding assistant integrated into JetBrains IDEs.',
                'status' => 'published',
                'categories' => ['AI Coding Assistants'],
                'tags' => ['Paid', 'IDE Integration', 'AI-Powered', 'macOS', 'Windows', 'Linux'],
                'attributes' => [
                    'pricing_model' => 'Monthly Subscription',
                    'price' => '$8.33/mo',
                    'ide_support' => 'IntelliJ, PyCharm, WebStorm, all JetBrains IDEs',
                    'code_completion' => 'Yes',
                    'chat_support' => 'Yes',
                    'refactoring' => 'AI-assisted',
                ],
            ],

            // AI Image
            [
                'name' => 'Midjourney',
                'brand' => 'Midjourney',
                'description' => 'AI image generation from text prompts. Known for artistic and high-quality outputs.',
                'status' => 'published',
                'categories' => ['AI Image Generators'],
                'tags' => ['Paid', 'Web-based', 'AI-Powered'],
                'attributes' => [
                    'pricing_model' => 'Subscription',
                    'price' => 'From $10/mo',
                    'image_quality' => 'High (up to 2048x2048)',
                    'api_access' => 'No',
                    'web_interface' => 'Yes',
                    'discord_bot' => 'Yes',
                ],
            ],
            [
                'name' => 'DALL-E 3',
                'brand' => 'OpenAI',
                'description' => 'AI image generation integrated into ChatGPT. Creates images from text descriptions.',
                'status' => 'published',
                'categories' => ['AI Image Generators'],
                'tags' => ['Paid', 'API Available', 'Web-based', 'AI-Powered'],
                'attributes' => [
                    'pricing_model' => 'Pay-per-use',
                    'api_access' => 'Yes',
                    'integration' => 'ChatGPT native',
                    'image_quality' => 'High',
                    'text_rendering' => 'Excellent',
                ],
            ],

            // VPN
            [
                'name' => 'NordVPN',
                'brand' => 'NordVPN',
                'description' => 'Fast and secure VPN service with 6000+ servers in 61 countries.',
                'status' => 'published',
                'categories' => ['VPN Services'],
                'tags' => ['Paid', 'Money-Back Guarantee', 'Multi-Platform', 'End-to-End Encrypted', 'Zero-Log Policy'],
                'attributes' => [
                    'pricing_model' => 'Monthly/Yearly',
                    'price' => 'From $3.49/mo',
                    'servers' => '6000+',
                    'countries' => '61',
                    'simultaneous_connections' => '6',
                    'protocol' => 'NordLynx, OpenVPN, IKEv2',
                    'kill_switch' => 'Yes',
                    'split_tunneling' => 'Yes',
                    'no_logs' => 'Audited',
                    'money_back_guarantee' => '30 days',
                ],
            ],
            [
                'name' => 'ExpressVPN',
                'brand' => 'ExpressVPN',
                'description' => 'Premium VPN known for speed, security, and ease of use.',
                'status' => 'published',
                'categories' => ['VPN Services'],
                'tags' => ['Paid', 'Money-Back Guarantee', 'Multi-Platform', 'End-to-End Encrypted', 'Zero-Log Policy'],
                'attributes' => [
                    'pricing_model' => 'Monthly/Yearly',
                    'price' => 'From $6.67/mo',
                    'servers' => '3000+',
                    'countries' => '105',
                    'simultaneous_connections' => '8',
                    'protocol' => 'Lightway, OpenVPN, IKEv2',
                    'kill_switch' => 'Yes',
                    'split_tunneling' => 'Yes',
                    'no_logs' => 'Audited',
                    'money_back_guarantee' => '30 days',
                ],
            ],

            // Cloud & Hosting
            [
                'name' => 'AWS EC2',
                'brand' => 'AWS',
                'description' => 'Elastic Compute Cloud. Scalable virtual servers in the cloud.',
                'status' => 'published',
                'categories' => ['Cloud Providers'],
                'tags' => ['Paid', 'Enterprise', 'API Available', 'Scalable'],
                'attributes' => [
                    'pricing_model' => 'Pay-as-you-go',
                    'free_tier' => '750 hours/mo for 12 months',
                    'global_regions' => '33',
                    'instance_types' => '600+',
                    'auto_scaling' => 'Yes',
                    'load_balancing' => 'Yes',
                    'container_support' => 'ECS, EKS',
                ],
            ],
            [
                'name' => 'Vercel',
                'brand' => 'Vercel',
                'description' => 'Frontend cloud platform for deploying Next.js and other frameworks.',
                'status' => 'published',
                'categories' => ['Cloud Providers', 'Serverless'],
                'tags' => ['Freemium', 'Developer Friendly', 'Git Integration'],
                'attributes' => [
                    'pricing_model' => 'Freemium',
                    'free_tier' => 'Yes (100GB bandwidth)',
                    'frameworks' => 'Next.js, Nuxt, SvelteKit, Astro',
                    'edge_functions' => 'Yes',
                    'analytics' => 'Built-in',
                    'preview_deployments' => 'Yes',
                ],
            ],

            // Productivity
            [
                'name' => 'Notion',
                'brand' => 'Notion',
                'description' => 'All-in-one workspace for notes, docs, wikis, and project management.',
                'status' => 'published',
                'categories' => ['Note Taking', 'Project Management'],
                'tags' => ['Freemium', 'Web-based', 'Mobile App', 'Team Collaboration', 'API Available'],
                'attributes' => [
                    'pricing_model' => 'Freemium',
                    'free_tier' => 'Yes (personal)',
                    'workspace_types' => 'Notes, Docs, Wikis, Databases, Projects',
                    'collaboration' => 'Real-time',
                    'api_access' => 'Yes',
                    'integrations' => '100+',
                    'offline_mode' => 'Yes (desktop)',
                ],
            ],

            // Design
            [
                'name' => 'Figma',
                'brand' => 'Figma',
                'description' => 'Collaborative interface design tool for teams. Browser-based with real-time collaboration.',
                'status' => 'published',
                'categories' => ['UI/UX Design', 'Prototyping'],
                'tags' => ['Freemium', 'Web-based', 'Team Collaboration', 'API Available'],
                'attributes' => [
                    'pricing_model' => 'Freemium',
                    'free_tier' => 'Yes (3 projects)',
                    'platforms' => 'Web, macOS, Windows',
                    'real_time_collaboration' => 'Yes',
                    'prototyping' => 'Yes',
                    'design_systems' => 'Yes',
                    'plugins' => '2000+',
                    'dev_mode' => 'Yes',
                ],
            ],

            // SaaS
            [
                'name' => 'Stripe',
                'brand' => 'Stripe',
                'description' => 'Payment infrastructure for the internet. Process payments and manage subscriptions.',
                'status' => 'published',
                'categories' => ['Payment Gateways'],
                'tags' => ['Paid', 'Enterprise', 'API Available', 'Developer Friendly'],
                'attributes' => [
                    'pricing_model' => 'Transaction-based',
                    'price' => '2.9% + 30¢ per transaction',
                    'payment_methods' => 'Cards, wallets, bank transfers',
                    'currencies' => '135+',
                    'countries' => '46+',
                    'recurring_payments' => 'Yes',
                    'fraud_detection' => 'Radar (built-in)',
                    'api_docs' => 'Excellent',
                ],
            ],
        ];

        foreach ($products as $data) {
            $brand = Brand::where('name', $data['brand'])->first();
            if (!$brand) continue;

            $product = Product::firstOrCreate(
                ['slug' => Str::slug($data['name'])],
                [
                    'brand_id' => $brand->id,
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'status' => $data['status'],
                    'attributes' => $data['attributes'] ?? [],
                ]
            );

            // Attach categories
            foreach ($data['categories'] as $i => $catName) {
                $cat = Category::where('name', $catName)->first();
                if ($cat) {
                    $product->categories()->syncWithoutDetaching([
                        $cat->id => ['is_primary' => $i === 0],
                    ]);
                }
            }

            // Attach tags
            foreach ($data['tags'] as $tagName) {
                $tag = Tag::where('name', $tagName)->first();
                if ($tag) {
                    $product->tags()->syncWithoutDetaching([$tag->id]);
                }
            }
        }
    }
}
