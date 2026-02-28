# 🎯 RAILWAY DEPLOYMENT - QUICK REFERENCE

## ✅ APP_KEY ANDA (COPY INI!)

```
base64:7lTnfPKDG9U2U9d9Ft2Gp8IVOEc5ndkJ3mHAUvk5MLQ=
```

---

## 📝 ENVIRONMENT VARIABLES UNTUK RAILWAY

Copy semua ini ke Railway Dashboard → Variables:

```env
APP_NAME=Booking Ruangan SPH
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:7lTnfPKDG9U2U9d9Ft2Gp8IVOEc5ndkJ3mHAUvk5MLQ=
APP_URL=${{RAILWAY_PUBLIC_DOMAIN}}

DB_CONNECTION=sqlite
DB_DATABASE=/app/database/database.sqlite

SESSION_DRIVER=file
CACHE_DRIVER=file
QUEUE_CONNECTION=sync

# EmailJS - Update dengan key Anda
EMAILJS_PUBLIC_KEY=your_emailjs_public_key
EMAILJS_SERVICE_ID=your_emailjs_service_id
EMAILJS_TEMPLATE_ID_BOOKING_CREATED=your_template_id
EMAILJS_TEMPLATE_ID_BOOKING_APPROVED=your_template_id
EMAILJS_TEMPLATE_ID_BOOKING_REJECTED=your_template_id
```

---

## 🚀 DEPLOYMENT STEPS

### 1. Buka Railway
🔗 https://railway.app

### 2. Login dengan GitHub
✅ Authorize Railway

### 3. Create New Project
1. Klik **"New Project"**
2. Pilih **"Deploy from GitHub repo"**
3. Connect repository: **Booking-Ruangan**

### 4. Set Variables
1. Klik service Anda
2. Tab **"Variables"**
3. Klik **"+ New Variable"**
4. Copy-paste semua variables di atas

### 5. Wait for Deploy
⏳ 2-5 menit

### 6. Generate Domain
1. Tab **"Settings"**
2. Klik **"Generate Domain"**
3. Copy URL

### 7. Run Migrations (First Time)
Di **Settings** → **Deploy** → **Custom Start Command**:
```bash
php artisan migrate --force && php artisan db:seed --force && php artisan serve --host=0.0.0.0 --port=$PORT
```

---

## 🎯 JIKA BELUM ADA DI GITHUB

```powershell
# Initialize git
git init

# Add all files
git add .

# Commit
git commit -m "Deploy to Railway"

# Create repo di GitHub, lalu:
git remote add origin https://github.com/YOUR_USERNAME/Booking-Ruangan.git
git branch -M main
git push -u origin main
```

---

## ⚡ ALTERNATIVE: Deploy dari Local

Jika GitHub tidak tersedia, bisa upload langsung:
1. Install Railway CLI manual: https://github.com/railwayapp/cli/releases
2. Download `railway_windows_amd64.exe`
3. Rename ke `railway.exe` dan taruh di folder project
4. Jalankan:

```powershell
.\railway.exe login
.\railway.exe init
.\railway.exe up
.\railway.exe domain
```

---

## 📋 CHECKLIST

- [ ] Railway account created
- [ ] GitHub repo ready (atau Railway CLI installed)
- [ ] APP_KEY copied: `base64:7lTnfPKDG9U2U9d9Ft2Gp8IVOEc5ndkJ3mHAUvk5MLQ=`
- [ ] EmailJS configured (https://emailjs.com)
- [ ] All environment variables set
- [ ] Domain generated
- [ ] Migrations run
- [ ] Test aplikasi!

---

## 🔗 USEFUL LINKS

- Railway Dashboard: https://railway.app/dashboard
- Railway Docs: https://docs.railway.app
- EmailJS Setup: https://www.emailjs.com
- GitHub: https://github.com

---

## 🆘 TROUBLESHOOTING

### Build Failed
- Check Railway logs
- Verify `composer.json` exists
- Check PHP version compatibility

### Environment Variable Issues
- Make sure APP_KEY is set correctly
- Verify APP_URL uses `${{RAILWAY_PUBLIC_DOMAIN}}`
- Check database path for SQLite

### Database Not Working
- Run migrations manually via Railway shell
- Or set custom start command (see step 7)

### Email Not Sending
- Verify EmailJS keys are correct
- Check EmailJS dashboard for quotas
- Test with Postman first

---

## 💡 TIPS

1. **Auto-redeploy**: Connect GitHub for auto-deploy on push
2. **Custom Domain**: Set up in Railway Settings
3. **Monitoring**: Check logs in Railway Dashboard
4. **Database**: Upgrade to PostgreSQL for production
5. **Scaling**: Railway auto-scales based on traffic

---

## 🎉 SUCCESS!

Your app should be live at:
**https://booking-ruangan-production.up.railway.app**

Test it:
1. Register new user
2. Login
3. Try booking a room
4. Check email notifications

---

**Need Help?** Check [RAILWAY-DEPLOY-WEB.md](RAILWAY-DEPLOY-WEB.md) for detailed guide!
