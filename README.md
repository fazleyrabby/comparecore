# CompareCore

A reusable generic comparison platform built with Laravel 13, PostgreSQL, and Flowbite/Tailwind CSS. Compare any products side-by-side — software, VPNs, hosting, SaaS, or anything else.

## Tech Stack

- **Backend:** Laravel 13, PHP 8.3+
- **Database:** PostgreSQL
- **Frontend:** Blade + Alpine.js + Tailwind CSS (Flowbite)
- **Search:** Basic DB search (Meilisearch planned for Milestone 2)
- **Docker:** docker-compose for local development

## Features

### Public
- Landing page with featured products and categories
- Category browsing with product listings
- Product detail pages with attributes, brand, and tags
- Side-by-side comparison engine (up to 4 products)
- Shareable compare links (localStorage + URL query params)
- Full-text search across products, categories, and brands

### Admin
- Secure login with role-based access
- Dashboard with stats (products, categories, brands, tags)
- Full CRUD for Brands, Categories, Products, and Tags
- Hierarchical categories (parent/child)
- Product attributes stored as JSONB
- Product images management

## Getting Started

### Prerequisites

- Docker & Docker Compose
- PHP 8.3+, Composer, Node.js 20+

### Local Development

```bash
git clone https://github.com/fazleyrabby/comparecore.git
cd comparecore

# Start Docker containers
docker compose up -d

# Install dependencies
docker compose exec app composer install
docker compose exec app npm install

# Setup environment
cp .env.example .env
docker compose exec app php artisan key:generate

# Run migrations and seeders
docker compose exec app php artisan migrate:fresh --seed

# Build frontend assets
npm run build

# Start dev server
docker compose exec app php artisan serve --host=0.0.0.0 --port=8000
```

The app will be available at `http://localhost:8000`.

### Default Admin

- **Email:** admin@comparecore.com
- **Password:** password

## Project Structure

```
app/
  Http/Controllers/
    Admin/          # Admin panel controllers
    Auth/           # Authentication
    CompareController.php
    CategoryController.php
    ProductController.php
    SearchController.php
  Models/           # Eloquent models (Brand, Category, Product, Tag)
database/
  migrations/       # Database schema
  seeders/          # Demo data
resources/views/
  admin/            # Admin panel views
  public/           # Public-facing views
routes/web.php      # All routes
```

## Roadmap

### Milestone 1 (Current) ✅
- Admin auth & dashboard
- Product, Brand, Category, Tag CRUD
- Public product/category browsing
- Compare engine
- Basic search

### Milestone 2
- Advanced filtering (attributes, price range)
- Comparison history
- Analytics dashboard

### Milestone 3
- User accounts & favorites
- Voting/rating system
- API endpoints
- Webhooks for product updates

## License

MIT
