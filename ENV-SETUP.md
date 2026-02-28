# 🔐 Environment Variables Cheat Sheet

## ✅ WAJIB (REQUIRED)

```env
APP_NAME="Booking Ruangan SPH"
APP_ENV=production
APP_KEY=base64:xxxxxxxxxxxxxxxxxxxxx
APP_DEBUG=false
APP_URL=https://your-app-url.com
```

### Generate APP_KEY:
```bash
php artisan key:generate --show
```

---

## 🗄️ DATABASE

### SQLite (Prototype/Demo - Recommended untuk mulai)
```env
DB_CONNECTION=sqlite
DB_DATABASE=/data/database.sqlite
```

### PostgreSQL (Production - Railway/Heroku)
```env
DB_CONNECTION=pgsql
DB_HOST=your-db-host.com
DB_PORT=5432
DB_DATABASE=booking_ruangan
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### MySQL (Production Alternative)
```env
DB_CONNECTION=mysql
DB_HOST=your-db-host.com
DB_PORT=3306
DB_DATABASE=booking_ruangan
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

---

## 📧 EMAIL (EmailJS)

Dapatkan dari: https://www.emailjs.com/

```env
EMAILJS_PUBLIC_KEY=your_public_key_here
EMAILJS_SERVICE_ID=service_xxxxxxxxx
EMAILJS_TEMPLATE_ID_BOOKING_CREATED=template_xxxxxxxx
EMAILJS_TEMPLATE_ID_BOOKING_APPROVED=template_xxxxxxxx
EMAILJS_TEMPLATE_ID_BOOKING_REJECTED=template_xxxxxxxx
```

### Setup EmailJS:
1. Buat akun di https://www.emailjs.com
2. Tambah Email Service (Gmail/Outlook/etc)
3. Buat 3 Email Templates:
   - Booking Created
   - Booking Approved  
   - Booking Rejected
4. Copy Public Key & Template IDs

---

## ⚙️ OPTIONAL (Sudah ada default)

```env
LOG_CHANNEL=stack
LOG_LEVEL=debug

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

---

## 🚀 PLATFORM-SPECIFIC

### Railway
```bash
# Set via CLI
railway variables set APP_ENV=production
railway variables set APP_DEBUG=false
railway variables set APP_KEY="base64:xxxxx"
railway variables set DB_CONNECTION=sqlite
railway variables set DB_DATABASE=/data/database.sqlite

# Atau via Dashboard: railway.app/dashboard
```

### Google Cloud Run
```bash
# Set saat deploy
gcloud run deploy booking-ruangan \
  --set-env-vars "APP_ENV=production,APP_DEBUG=false,APP_KEY=base64:xxxxx"

# Update setelah deploy
gcloud run services update booking-ruangan \
  --set-env-vars "EMAILJS_PUBLIC_KEY=your_key"
```

### Heroku
```bash
# Set via CLI
heroku config:set APP_ENV=production
heroku config:set APP_DEBUG=false
heroku config:set APP_KEY="base64:xxxxx"

# View all vars
heroku config

# Atau via Dashboard: dashboard.heroku.com
```

### Docker
```bash
# Via docker run
docker run -e APP_ENV=production \
  -e APP_DEBUG=false \
  -e APP_KEY=base64:xxxxx \
  -p 8080:8080 booking-ruangan

# Atau buat .env file dan mount
docker run --env-file .env.production -p 8080:8080 booking-ruangan
```

---

## 📝 TEMPLATE LENGKAP

### Development (.env)
```env
APP_NAME="Booking Ruangan SPH"
APP_ENV=local
APP_KEY=base64:xxxxx
APP_DEBUG=true
APP_URL=http://localhost:8000

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database/database.sqlite

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

# EmailJS
EMAILJS_PUBLIC_KEY=your_key
EMAILJS_SERVICE_ID=service_xxx
EMAILJS_TEMPLATE_ID_BOOKING_CREATED=template_xxx
EMAILJS_TEMPLATE_ID_BOOKING_APPROVED=template_xxx
EMAILJS_TEMPLATE_ID_BOOKING_REJECTED=template_xxx
```

### Production (.env.production)
```env
APP_NAME="Booking Ruangan SPH"
APP_ENV=production
APP_KEY=base64:xxxxx
APP_DEBUG=false
APP_URL=https://your-app.com

LOG_CHANNEL=stack
LOG_LEVEL=error

# SQLite (simple) atau PostgreSQL (production)
DB_CONNECTION=sqlite
DB_DATABASE=/data/database.sqlite

# Optional: Use PostgreSQL for better performance
# DB_CONNECTION=pgsql
# DB_HOST=your-db.railway.app
# DB_PORT=5432
# DB_DATABASE=railway
# DB_USERNAME=postgres
# DB_PASSWORD=xxxxx

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

# EmailJS Production
EMAILJS_PUBLIC_KEY=your_production_key
EMAILJS_SERVICE_ID=service_production
EMAILJS_TEMPLATE_ID_BOOKING_CREATED=template_prod_xxx
EMAILJS_TEMPLATE_ID_BOOKING_APPROVED=template_prod_xxx
EMAILJS_TEMPLATE_ID_BOOKING_REJECTED=template_prod_xxx
```

---

## 🔍 TROUBLESHOOTING

### Error: "APP_KEY not set"
```bash
php artisan key:generate --show
# Copy output dan paste ke APP_KEY
```

### Error: "Database file not found"
Pastikan path database benar:
```bash
# Development (relative)
DB_DATABASE=database/database.sqlite

# Production (absolute)
DB_DATABASE=/data/database.sqlite
```

### Error: "EmailJS not configured"
Check di `.env`:
```bash
# Pastikan semua terisi
EMAILJS_PUBLIC_KEY=xxx
EMAILJS_SERVICE_ID=service_xxx
EMAILJS_TEMPLATE_ID_BOOKING_CREATED=template_xxx
```

### Check Current Config
```bash
php artisan config:show

# Or specific
php artisan config:show database
php artisan config:show mail
```

---

## 🎯 QUICK SETUP CHECKLIST

- [ ] Generate `APP_KEY` dengan `php artisan key:generate --show`
- [ ] Set `APP_ENV=production` untuk live site
- [ ] Set `APP_DEBUG=false` untuk security
- [ ] Update `APP_URL` dengan domain actual
- [ ] Configure database (SQLite untuk start, PostgreSQL untuk scale)
- [ ] Setup EmailJS account dan templates
- [ ] Copy semua template IDs ke env vars
- [ ] Test email notifications
- [ ] Backup `.env` di tempat aman

---

## 💡 BEST PRACTICES

1. **Never commit `.env` to git** (already in .gitignore)
2. **Use strong APP_KEY** (generated automatically)
3. **Disable debug in production** (`APP_DEBUG=false`)
4. **Use HTTPS** (handled by platforms)
5. **Rotate secrets regularly**
6. **Keep backups** of working .env files

---

## 📚 RESOURCES

- Laravel Config: https://laravel.com/docs/configuration
- EmailJS: https://www.emailjs.com/docs/
- Railway: https://docs.railway.app/
- Google Cloud: https://cloud.google.com/run/docs/
- Heroku: https://devcenter.heroku.com/

---

**Need help?** Check [DEPLOYMENT.md](DEPLOYMENT.md) atau [QUICK-DEPLOY.md](QUICK-DEPLOY.md)
