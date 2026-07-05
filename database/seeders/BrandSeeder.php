<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            ['name' => 'OpenAI', 'website_url' => 'https://openai.com', 'description' => 'Creator of ChatGPT, GPT-4, and DALL-E. Leading AI research company.'],
            ['name' => 'Anthropic', 'website_url' => 'https://anthropic.com', 'description' => 'Creator of Claude. AI safety company focused on building reliable AI systems.'],
            ['name' => 'Google', 'website_url' => 'https://google.com', 'description' => 'Tech giant behind Gemini, Gemini Pro, and Google AI Studio.'],
            ['name' => 'Microsoft', 'website_url' => 'https://microsoft.com', 'description' => 'Creator of GitHub Copilot, Bing AI, and Azure OpenAI Service.'],
            ['name' => 'Meta', 'website_url' => 'https://meta.com', 'description' => 'Creator of Llama open-source models and Meta AI assistant.'],
            ['name' => 'Cursor', 'website_url' => 'https://cursor.sh', 'description' => 'AI-first code editor built on VS Code with intelligent code completion.'],
            ['name' => 'JetBrains', 'website_url' => 'https://jetbrains.com', 'description' => 'Creator of IntelliJ IDEA, PyCharm, and AI Assistant.'],
            ['name' => 'Mistral AI', 'website_url' => 'https://mistral.ai', 'description' => 'French AI company building open-source and commercial LLMs.'],
            ['name' => 'Perplexity', 'website_url' => 'https://perplexity.ai', 'description' => 'AI-powered answer engine and search platform.'],
            ['name' => 'NordVPN', 'website_url' => 'https://nordvpn.com', 'description' => 'Leading VPN service provider with 6000+ servers worldwide.'],
            ['name' => 'ExpressVPN', 'website_url' => 'https://expressvpn.com', 'description' => 'Premium VPN service known for speed and security.'],
            ['name' => 'Cloudflare', 'website_url' => 'https://cloudflare.com', 'description' => 'Web infrastructure and security company offering CDN, DDoS protection, and Zero Trust.'],
            ['name' => 'AWS', 'website_url' => 'https://aws.amazon.com', 'description' => 'Amazon Web Services - leading cloud computing platform.'],
            ['name' => 'Vercel', 'website_url' => 'https://vercel.com', 'description' => 'Frontend cloud platform for building and deploying web applications.'],
            ['name' => 'Notion', 'website_url' => 'https://notion.so', 'description' => 'All-in-one workspace for notes, docs, wikis, and project management.'],
            ['name' => 'Figma', 'website_url' => 'https://figma.com', 'description' => 'Collaborative interface design tool for teams.'],
            ['name' => 'Stripe', 'website_url' => 'https://stripe.com', 'description' => 'Payment infrastructure for the internet.'],
            ['name' => 'Shopify', 'website_url' => 'https://shopify.com', 'description' => 'Leading ecommerce platform for online stores and retail POS.'],
            ['name' => 'Midjourney', 'website_url' => 'https://midjourney.com', 'description' => 'AI image generation platform creating art from text prompts.'],
            ['name' => 'Stability AI', 'website_url' => 'https://stability.ai', 'description' => 'Creator of Stable Diffusion and open-source AI models.'],
        ];

        foreach ($brands as $brand) {
            Brand::firstOrCreate(
                ['slug' => Str::slug($brand['name'])],
                $brand
            );
        }
    }
}
