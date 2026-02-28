# 🚀 Panduan Deployment Aplikasi Booking Ruangan

Aplikasi Laravel ini dapat di-deploy ke berbagai platform. Berikut adalah panduan lengkap untuk masing-masing platform.

---

## 📋 Daftar Isi
1. [Railway (Paling Mudah)](#1-railway---paling-mudah-recommended)
2. [Google Cloud Run](#2-google-cloud-run)
3. [Heroku](#3-heroku)
4. [DigitalOcean App Platform](#4-digitalocean-app-platform)
5. [Vercel + PlanetScale](#5-vercel--planetscale)

---

## 1. Railway - Paling Mudah (✅ RECOMMENDED)

### Persiapan:
```bash
# Install Railway CLI
npm install -g @railway/cli

# Login ke Railway
railway login
```

### Langkah Deployment:

#### A. Via Website (Paling Mudah):

1. **Buat Akun Railway**
   - Kunjungi https://railway.app
   - Sign up dengan GitHub account

2. **Buat Project Baru**
   - Klik "New Project"
   - Pilih "Deploy from GitHub repo"
   - Connect repository Anda

3. **Setup Environment Variables**
   Di dashboard Railway, tambahkan:
   ```env
   APP_KEY=base64:xxx (generate dengan: php artisan key:generate --show)
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://${{RAILWAY_PUBLIC_DOMAIN}}
   
   DB_CONNECTION=sqlite
   DB_DATABASE=/data/database.sqlite
   
   EMAILJS_PUBLIC_KEY=your_key_here
   EMAILJS_SERVICE_ID=your_service_id
   EMAILJS_TEMPLATE_ID_BOOKING_CREATED=your_template
   EMAILJS_TEMPLATE_ID_BOOKING_APPROVED=your_template
   EMAILJS_TEMPLATE_ID_BOOKING_REJECTED=your_template
   ```

4. **Deploy!**
   - Railway akan otomatis detect Laravel dan deploy
   - Tunggu beberapa menit
   - Akses URL yang diberikan

#### B. Via CLI:

```bash
# Di folder project
railway init

# Link dengan project
railway link

# Set environment variables
railway variables set APP_ENV=production
railway variables set APP_DEBUG=false

# Deploy
railway up

# Generate domain
railway domain
```

### Troubleshooting Railway:
```bash
# Lihat logs
railway logs

# SSH ke container
railway shell

# Restart service
railway restart
```

---

## 2. Google Cloud Run

### Persiapan:
```bash
# Install Google Cloud SDK
# Windows: https://cloud.google.com/sdk/docs/install
# Mac: brew install google-cloud-sdk

# Login
gcloud auth login

# Set project
gcloud config set project YOUR_PROJECT_ID
```

### Deploy:

```bash
# Build dan push image
gcloud builds submit --tag gcr.io/YOUR_PROJECT_ID/booking-ruangan

# Deploy ke Cloud Run
gcloud run deploy booking-ruangan \
  --image gcr.io/YOUR_PROJECT_ID/booking-ruangan \
  --platform managed \
  --region asia-southeast1 \
  --allow-unauthenticated \
  --set-env-vars APP_ENV=production,APP_DEBUG=false \
  --memory 512Mi
```

### Setup Database (Cloud SQL - PostgreSQL):
```bash
# Create instance
gcloud sql instances create booking-ruangan-db \
  --database-version=POSTGRES_14 \
  --tier=db-f1-micro \
  --region=asia-southeast1

# Create database
gcloud sql databases create booking_ruangan \
  --instance=booking-ruangan-db

# Connect Cloud Run to Cloud SQL
gcloud run services update booking-ruangan \
  --add-cloudsql-instances YOUR_PROJECT_ID:asia-southeast1:booking-ruangan-db
```

---

## 3. Heroku

### Persiapan:
```bash
# Install Heroku CLI
npm install -g heroku

# Login
heroku login
```

### Deploy:

```bash
# Create app
heroku create booking-ruangan-sph

# Add buildpack
heroku buildpacks:set heroku/php

# Set environment variables
heroku config:set APP_ENV=production
heroku config:set APP_DEBUG=false
heroku config:set APP_KEY=$(php artisan key:generate --show)

# Deploy
git push heroku main

# Run migrations
heroku run php artisan migrate --force
heroku run php artisan db:seed --force
```

### Setup Database (PostgreSQL):
```bash
# Add PostgreSQL addon
heroku addons:create heroku-postgresql:mini

# Update .env untuk Heroku
heroku config:set DB_CONNECTION=pgsql
```

---

## 4. DigitalOcean App Platform

### Deploy via GUI:

1. **Login ke DigitalOcean**
   - Buka https://cloud.digitalocean.com

2. **Create New App**
   - Klik "Create" → "Apps"
   - Connect GitHub repository

3. **Configure App**
   - Detect PHP Laravel
   - Set build command: `composer install --no-dev --optimize-autoloader`
   - Set run command: `heroku-php-apache2 public/`

4. **Environment Variables**
   ```env
   APP_KEY=base64:xxx
   APP_ENV=production
   APP_DEBUG=false
   DB_CONNECTION=sqlite
   ```

5. **Deploy**
   - Klik "Create Resources"

---

## 5. Vercel + PlanetScale (Modern Stack)

### A. Setup Database (PlanetScale):

```bash
# Install PlanetScale CLI
brew install planetscale/tap/pscale

# Login
pscale auth login

# Create database
pscale database create booking-ruangan --region ap-southeast

# Create branch
pscale branch create booking-ruangan main

# Get connection string
pscale connect booking-ruangan main
```

### B. Deploy ke Vercel:

1. **Install Vercel CLI**
   ```bash
   npm install -g vercel
   ```

2. **Create vercel.json**
   ```json
   {
     "version": 2,
     "framework": null,
     "builds": [
       { "src": "/api/index.php", "use": "vercel-php@0.6.0" },
       { "src": "/public/**", "use": "@vercel/static" }
     ],
     "routes": [
       { "src": "/(css|js|images)/(.*)", "dest": "/public/$1/$2" },
       { "src": "/(.*)", "dest": "/api/index.php" }
     ],
     "env": {
       "APP_ENV": "production",
       "APP_DEBUG": "false",
       "APP_KEY": "@app-key"
     }
   }
   ```

3. **Deploy**
   ```bash
   vercel --prod
   ```

---

## 🔒 Security Checklist

Sebelum deploy production, pastikan:

- [ ] `APP_ENV=production`
- [ ] `APP_DEBUG=false`
- [ ] `APP_KEY` sudah di-generate
- [ ] Database credentials aman
- [ ] HTTPS enabled
- [ ] CSRF protection aktif
- [ ] Rate limiting dikonfigurasi
- [ ] Backup database regular

---

## 📊 Performance Optimization

Setelah deploy:

```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Optimize autoloader
composer install --optimize-autoloader --no-dev

# Clear all cache
php artisan optimize:clear
```

---

## 🐛 Debugging Production Issues

```bash
# Railway
railway logs

# Heroku
heroku logs --tail

# Google Cloud Run
gcloud run services logs read booking-ruangan --limit=50

# Check Laravel logs
tail -f storage/logs/laravel.log
```

---

## 💡 Tips

1. **Gunakan SQLite untuk prototype cepat** (sudah dikonfigurasi)
2. **Upgrade ke PostgreSQL/MySQL untuk production** yang serius
3. **Setup monitoring**: Railway includes built-in monitoring
4. **Enable caching**: Redis via Railway/Heroku addons
5. **CDN untuk assets**: Cloudflare, BunnyCDN

---

## 📞 Support

Jika ada masalah:
1. Check logs platform masing-masing
2. Verify environment variables
3. Check Laravel logs di `storage/logs/`
4. Test locally dengan `php artisan serve`

---

## 🎉 Quick Start (Railway - Tercepat)

```bash
# 1. Install Railway CLI
npm install -g @railway/cli

# 2. Init project
railway init

# 3. Deploy
railway up

# 4. Generate domain
railway domain

# Done! 🚀
```

Aplikasi Anda akan online dalam 2-3 menit!
