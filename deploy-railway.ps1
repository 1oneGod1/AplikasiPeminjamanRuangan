# 🌐 Quick Deploy Script untuk Railway

Write-Host "🚀 Memulai deployment ke Railway..." -ForegroundColor Cyan
Write-Host ""

# Check if Railway CLI is installed
$railwayInstalled = Get-Command railway -ErrorAction SilentlyContinue

if (-not $railwayInstalled) {
    Write-Host "❌ Railway CLI belum terinstall!" -ForegroundColor Red
    Write-Host "📦 Install dengan: npm install -g @railway/cli" -ForegroundColor Yellow
    Write-Host "Atau kunjungi: https://docs.railway.app/develop/cli" -ForegroundColor Yellow
    exit 1
}

Write-Host "✅ Railway CLI ditemukan" -ForegroundColor Green

# Check if logged in
Write-Host "🔐 Checking login status..." -ForegroundColor Cyan
$loginCheck = railway whoami 2>&1

if ($LASTEXITCODE -ne 0) {
    Write-Host "⚠️  Belum login ke Railway" -ForegroundColor Yellow
    Write-Host "🔑 Silakan login terlebih dahulu..." -ForegroundColor Cyan
    railway login
    
    if ($LASTEXITCODE -ne 0) {
        Write-Host "❌ Login gagal!" -ForegroundColor Red
        exit 1
    }
}

Write-Host "✅ Sudah login ke Railway" -ForegroundColor Green

# Generate APP_KEY if needed
Write-Host ""
Write-Host "🔑 Generating APP_KEY..." -ForegroundColor Cyan
$appKey = php artisan key:generate --show

if ($LASTEXITCODE -ne 0) {
    Write-Host "❌ Gagal generate APP_KEY!" -ForegroundColor Red
    exit 1
}

Write-Host "✅ APP_KEY: $appKey" -ForegroundColor Green

# Initialize Railway project if needed
Write-Host ""
Write-Host "📦 Initializing Railway project..." -ForegroundColor Cyan
railway init

# Set environment variables
Write-Host ""
Write-Host "⚙️  Setting environment variables..." -ForegroundColor Cyan

railway variables set APP_KEY="$appKey"
railway variables set APP_ENV=production
railway variables set APP_DEBUG=false
railway variables set DB_CONNECTION=sqlite
railway variables set DB_DATABASE=/data/database.sqlite

Write-Host "✅ Environment variables set!" -ForegroundColor Green

# Deploy
Write-Host ""
Write-Host "🚀 Deploying aplikasi..." -ForegroundColor Cyan
Write-Host "⏳ Ini mungkin memakan waktu beberapa menit..." -ForegroundColor Yellow

railway up

if ($LASTEXITCODE -ne 0) {
    Write-Host "❌ Deploy gagal!" -ForegroundColor Red
    Write-Host "💡 Coba cek logs dengan: railway logs" -ForegroundColor Yellow
    exit 1
}

Write-Host ""
Write-Host "✅ Deploy berhasil!" -ForegroundColor Green

# Generate domain
Write-Host ""
Write-Host "🌐 Generating public domain..." -ForegroundColor Cyan
railway domain

Write-Host ""
Write-Host "🎉 DEPLOYMENT SELESAI!" -ForegroundColor Green
Write-Host ""
Write-Host "📝 Langkah selanjutnya:" -ForegroundColor Cyan
Write-Host "  1. Buka Railway dashboard: https://railway.app/dashboard" -ForegroundColor White
Write-Host "  2. Lihat logs: railway logs" -ForegroundColor White
Write-Host "  3. Check status: railway status" -ForegroundColor White
Write-Host ""
Write-Host "🔗 URL aplikasi akan muncul di atas ☝️" -ForegroundColor Yellow
Write-Host ""
