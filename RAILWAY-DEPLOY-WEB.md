# 🚂 CARA DEPLOY KE RAILWAY (TANPA CLI)

## ✨ Cara Paling Mudah - Via Web Dashboard

### Step 1: Buat Akun Railway
1. Buka https://railway.app
2. Klik **"Login"** atau **"Start a New Project"**
3. Sign up dengan **GitHub account** (recommended)
4. Verifikasi email jika diminta

### Step 2: Push Code ke GitHub (Jika Belum)

```powershell
# Initialize git (jika belum)
git init

# Add all files
git add .

# Commit
git commit -m "Ready for Railway deployment"

# Create repository di GitHub, lalu:
git remote add origin https://github.com/YOUR_USERNAME/YOUR_REPO_NAME.git
git branch -M main
git push -u origin main
```

**ATAU** bisa deploy langsung dari folder lokal (lihat Step 3 Alternative).

### Step 3A: Deploy dari GitHub (Recommended)

1. **Buka Railway Dashboard**: https://railway.app/dashboard
2. Klik **"New Project"**
3. Pilih **"Deploy from GitHub repo"**
4. Pilih repository Anda: `Booking-Ruangan`
5. Railway akan otomatis detect Laravel!

### Step 3B: Deploy dari Local (Alternative - Butuh CLI)

Jika npm bermasalah, download Railway CLI manual:
1. Download: https://github.com/railwayapp/cli/releases
2. Extract ke folder (misal: C:\railway)
3. Jalankan dari folder tersebut

### Step 4: Configure Environment Variables

Di Railway Dashboard → Your Project → Variables, tambahkan:

```env
APP_NAME=Booking Ruangan SPH
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:YOUR_KEY_HERE
APP_URL=${{RAILWAY_PUBLIC_DOMAIN}}

DB_CONNECTION=sqlite
DB_DATABASE=/app/database/database.sqlite

EMAILJS_PUBLIC_KEY=your_emailjs_key
EMAILJS_SERVICE_ID=your_service_id
EMAILJS_TEMPLATE_ID_BOOKING_CREATED=template_xxx
EMAILJS_TEMPLATE_ID_BOOKING_APPROVED=template_xxx
EMAILJS_TEMPLATE_ID_BOOKING_REJECTED=template_xxx
```

#### Generate APP_KEY:
```powershell
php artisan key:generate --show
```
Copy outputnya dan paste ke APP_KEY

### Step 5: Add PostgreSQL Database (Optional - Recommended)

1. Di Railway project, klik **"New"** → **"Database"** → **"PostgreSQL"**
2. Railway akan auto-create database
3. Otomatis add environment variables:
   - DATABASE_URL
   - PGHOST
   - PGPORT
   - PGUSER
   - PGPASSWORD
   - PGDATABASE

4. Update variables:
   ```env
   DB_CONNECTION=pgsql
   DB_HOST=${{PGHOST}}
   DB_PORT=${{PGPORT}}
   DB_DATABASE=${{PGDATABASE}}
   DB_USERNAME=${{PGUSER}}
   DB_PASSWORD=${{PGPASSWORD}}
   ```

### Step 6: Deploy!

1. Railway akan otomatis build dan deploy
2. Tunggu 2-5 menit
3. Klik **"Generate Domain"** untuk dapat public URL
4. Akses URL Anda!

### Step 7: Run Migrations (First Time)

Cara 1 - Via Railway CLI (jika berhasil install):
```bash
railway run php artisan migrate --force
railway run php artisan db:seed --force
```

Cara 2 - Via Railway Dashboard:
1. Klik service Anda
2. Tab **"Deployments"** → pilih deployment terakhir
3. Klik **"View Logs"**
4. Jika ada error, tambahkan di **Settings** → **Deploy**:
   ```
   php artisan migrate --force && php artisan db:seed --force && php artisan serve --host=0.0.0.0 --port=$PORT
   ```

---

## 🎯 QUICK CHECKLIST

- [ ] Akun Railway sudah dibuat
- [ ] Code di-push ke GitHub (atau siap deploy local)
- [ ] APP_KEY sudah di-generate
- [ ] EmailJS sudah dikonfigurasi
- [ ] Environment variables sudah di-set
- [ ] Database dipilih (SQLite atau PostgreSQL)
- [ ] Domain generated
- [ ] Migrations sudah dijalankan

---

## 🔧 TROUBLESHOOTING

### "Build Failed"
- Check logs di Railway dashboard
- Pastikan `composer.json` ada
- Pastikan PHP version compatible

### "Application Error"
- Check environment variables
- Pastikan APP_KEY sudah di-set
- Check logs untuk detail error

### "Database Error"
- Pastikan DB_CONNECTION benar
- Check database credentials
- Run migrations via Railway shell

### "Can't Install Railway CLI"
Tidak masalah! Gunakan **Web Dashboard** - lebih mudah dan tidak perlu CLI.

---

## 📱 ALTERNATIVE: Deploy via Railway CLI (Manual Download)

Jika npm tidak berfungsi:

1. **Download Railway CLI**: https://github.com/railwayapp/cli/releases
2. Download file untuk Windows: `railway_windows_amd64.exe`
3. Rename ke `railway.exe`
4. Letakkan di folder project Anda
5. Jalankan dari terminal:

```powershell
# Login
.\railway.exe login

# Initialize
.\railway.exe init

# Deploy
.\railway.exe up

# Generate domain
.\railway.exe domain
```

---

## 🌟 TIPS

1. **Gunakan GitHub** untuk auto-redeploy setiap push
2. **Enable PostgreSQL** untuk production
3. **Monitor logs** di Railway dashboard
4. **Setup custom domain** (optional, tapi keren!)
5. **Gunakan Railway variables** untuk secrets

---

## ✅ NEXT STEPS AFTER DEPLOY

1. Test aplikasi di URL Railway
2. Register user baru
3. Test booking ruangan
4. Verify email notifications
5. Check logs untuk errors
6. Setup monitoring

---

## 🎉 DONE!

Aplikasi Anda seharusnya sudah online di Railway!

**URL**: https://your-app.railway.app

**Dashboard**: https://railway.app/dashboard

**Support**: https://help.railway.app
