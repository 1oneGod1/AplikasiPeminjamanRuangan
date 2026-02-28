# 🎯 CARA CEPAT DEPLOY - PILIH SALAH SATU

## ⚡ OPSI 1: RAILWAY (PALING MUDAH & CEPAT)

### Via Automated Script (Windows):
```powershell
.\deploy-railway.ps1
```

### Manual (Semua OS):
```bash
# 1. Install CLI
npm install -g @railway/cli

# 2. Login
railway login

# 3. Deploy!
railway init
railway up
railway domain
```

**⏱️ Waktu**: 2-3 menit  
**💰 Biaya**: $5 credit gratis/bulan  
**✅ Cocok untuk**: Prototype, Demo, Production kecil

---

## 🌟 OPSI 2: GOOGLE CLOUD RUN (FIREBASE ECOSYSTEM)

### Via Automated Script (Windows):
```powershell
.\deploy-gcloud.ps1
```

### Manual:
```bash
# 1. Login
gcloud auth login
gcloud config set project YOUR_PROJECT_ID

# 2. Enable APIs
gcloud services enable cloudbuild.googleapis.com run.googleapis.com

# 3. Build & Deploy
gcloud builds submit --tag gcr.io/YOUR_PROJECT_ID/booking-ruangan
gcloud run deploy booking-ruangan \
  --image gcr.io/YOUR_PROJECT_ID/booking-ruangan \
  --platform managed \
  --region asia-southeast1 \
  --allow-unauthenticated
```

**⏱️ Waktu**: 5-10 menit  
**💰 Biaya**: 2 juta request gratis/bulan  
**✅ Cocok untuk**: Production, Scale besar

---

## 🚀 OPSI 3: HEROKU (CLASSIC & RELIABLE)

```bash
# 1. Install Heroku CLI
npm install -g heroku

# 2. Login & Create
heroku login
heroku create booking-ruangan-sph

# 3. Deploy
git push heroku main

# 4. Setup Database
heroku run php artisan migrate --force
heroku run php artisan db:seed --force
```

**⏱️ Waktu**: 3-5 menit  
**💰 Biaya**: 550 hours gratis/bulan (1 dyno)  
**✅ Cocok untuk**: Development, Staging

---

## 🐳 OPSI 4: DOCKER (ANYWHERE)

```bash
# Build
docker build -t booking-ruangan .

# Run locally
docker run -p 8080:8080 booking-ruangan

# Deploy ke Cloud (pilih salah satu):
# - Google Cloud Run
# - AWS ECS
# - Azure Container Apps
# - DigitalOcean App Platform
```

**⏱️ Waktu**: 5-10 menit  
**💰 Biaya**: Tergantung provider  
**✅ Cocok untuk**: Flexibility maksimal

---

## 📊 PERBANDINGAN CEPAT

| Kriteria | Railway | Google Cloud | Heroku | Docker |
|----------|---------|--------------|--------|--------|
| **Setup** | ⭐⭐⭐⭐⭐ | ⭐⭐⭐ | ⭐⭐⭐⭐ | ⭐⭐⭐ |
| **Speed** | 2-3 min | 5-10 min | 3-5 min | 5-10 min |
| **Free Tier** | $5/month | 2M req/month | 550h/month | - |
| **Auto SSL** | ✅ | ✅ | ✅ | ⚠️ |
| **Auto Scale** | ✅ | ✅ | ⚠️ | ⚠️ |
| **Database** | ✅ Built-in | ✅ Cloud SQL | ✅ PostgreSQL | Manual |

---

## 💡 REKOMENDASI

### Untuk Pemula / Prototype
👉 **RAILWAY** - Gunakan script `.\deploy-railway.ps1`

### Untuk Production / Scale
👉 **GOOGLE CLOUD RUN** - Gunakan script `.\deploy-gcloud.ps1`

### Untuk Development Team
👉 **HEROKU** - Easy CI/CD integration

---

## 🔧 SETELAH DEPLOY

1. **Set Environment Variables**
   ```env
   APP_ENV=production
   APP_DEBUG=false
   APP_KEY=base64:xxxxx
   
   EMAILJS_PUBLIC_KEY=your_key
   EMAILJS_SERVICE_ID=your_service
   EMAILJS_TEMPLATE_ID_BOOKING_CREATED=template_xxx
   ```

2. **Run Migrations** (jika belum auto)
   ```bash
   # Railway
   railway run php artisan migrate --force
   
   # Heroku
   heroku run php artisan migrate --force
   
   # Google Cloud
   gcloud run services update booking-ruangan --command="php artisan migrate --force"
   ```

3. **Test Aplikasi**
   - Buka URL yang diberikan
   - Register akun baru
   - Test booking ruangan
   - Check email notifications

---

## 🆘 TROUBLESHOOTING

### "npm: command not found"
Untuk Railway/Heroku, skip npm, langsung pakai web dashboard atau CLI.

### "gcloud: command not found"  
Install Google Cloud SDK: https://cloud.google.com/sdk/docs/install

### "Error: APP_KEY not set"
```bash
php artisan key:generate --show
# Copy output dan set di platform environment variables
```

### Database error
Pastikan database path correct:
- SQLite: `/data/database.sqlite` 
- Atau gunakan PostgreSQL/MySQL dari provider

---

## 📚 DOKUMENTASI LENGKAP

Lihat [DEPLOYMENT.md](DEPLOYMENT.md) untuk:
- Tutorial detail setiap platform
- Setup database production
- Custom domain configuration
- Monitoring & logging
- Performance optimization
- Security checklist

---

## ✅ CHECKLIST SEBELUM DEPLOY

- [ ] `.env` sudah dikonfigurasi
- [ ] `APP_KEY` sudah di-generate
- [ ] Database credentials aman
- [ ] EmailJS sudah dikonfigurasi
- [ ] Test lokal berhasil (`php artisan serve`)
- [ ] Git repository up to date
- [ ] Backup database (jika ada data penting)

---

## 🎉 QUICK START (RAILWAY)

**Cara paling cepat (Windows)**:
```powershell
.\deploy-railway.ps1
```

**Atau manual**:
```bash
npm install -g @railway/cli
railway login
railway init
railway up
railway domain
```

**DONE!** Aplikasi online dalam 2-3 menit! 🚀

---

**Need help?** Baca [DEPLOYMENT.md](DEPLOYMENT.md) untuk panduan lengkap!
