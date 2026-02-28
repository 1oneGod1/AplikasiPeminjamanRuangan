#!/bin/bash

# Vercel Build Script
echo "🔨 Building Laravel for Vercel..."

# Install dependencies
composer install --no-dev --optimize-autoloader --no-interaction

# Generate key if not exists
if [ ! -f .env ]; then
    cp .env.example .env
    php artisan key:generate
fi

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create storage symlink
php artisan storage:link

echo "✅ Build completed!"
