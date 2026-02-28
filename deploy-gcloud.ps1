# 🌟 Quick Deploy ke Google Cloud Run
# Platform yang sama dengan Firebase (Google Cloud)

Write-Host "🚀 Memulai deployment ke Google Cloud Run..." -ForegroundColor Cyan
Write-Host ""

# Check if gcloud CLI is installed
$gcloudInstalled = Get-Command gcloud -ErrorAction SilentlyContinue

if (-not $gcloudInstalled) {
    Write-Host "❌ Google Cloud SDK belum terinstall!" -ForegroundColor Red
    Write-Host "📦 Download dari: https://cloud.google.com/sdk/docs/install" -ForegroundColor Yellow
    Write-Host ""
    Write-Host "💡 Alternatif mudah: Gunakan Railway dengan script:" -ForegroundColor Cyan
    Write-Host "   .\deploy-railway.ps1" -ForegroundColor White
    exit 1
}

Write-Host "✅ Google Cloud SDK ditemukan" -ForegroundColor Green

# Login check
Write-Host "🔐 Checking login status..." -ForegroundColor Cyan
$loginCheck = gcloud auth list --filter=status:ACTIVE --format="value(account)" 2>&1

if (-not $loginCheck) {
    Write-Host "⚠️  Belum login ke Google Cloud" -ForegroundColor Yellow
    Write-Host "🔑 Silakan login terlebih dahulu..." -ForegroundColor Cyan
    gcloud auth login
}

Write-Host "✅ Sudah login: $loginCheck" -ForegroundColor Green

# Get or set project
Write-Host ""
Write-Host "📋 Checking project..." -ForegroundColor Cyan
$currentProject = gcloud config get-value project 2>$null

if (-not $currentProject -or $currentProject -eq "(unset)") {
    Write-Host "⚠️  Project belum di-set" -ForegroundColor Yellow
    Write-Host "📝 Membuat project baru..." -ForegroundColor Cyan
    
    $projectId = "booking-ruangan-" + (Get-Random -Maximum 9999)
    
    Write-Host "🆕 Project ID: $projectId" -ForegroundColor Yellow
    gcloud projects create $projectId --name="Booking Ruangan SPH"
    gcloud config set project $projectId
} else {
    Write-Host "✅ Project aktif: $currentProject" -ForegroundColor Green
    $projectId = $currentProject
}

# Enable required APIs
Write-Host ""
Write-Host "🔧 Enabling required APIs..." -ForegroundColor Cyan
gcloud services enable cloudbuild.googleapis.com
gcloud services enable run.googleapis.com
gcloud services enable sqladmin.googleapis.com

Write-Host "✅ APIs enabled" -ForegroundColor Green

# Build image
Write-Host ""
Write-Host "🏗️  Building Docker image..." -ForegroundColor Cyan
Write-Host "⏳ Ini mungkin memakan waktu 5-10 menit untuk pertama kali..." -ForegroundColor Yellow

$imageName = "gcr.io/$projectId/booking-ruangan"

gcloud builds submit --tag $imageName

if ($LASTEXITCODE -ne 0) {
    Write-Host "❌ Build gagal!" -ForegroundColor Red
    exit 1
}

Write-Host "✅ Image built successfully!" -ForegroundColor Green

# Deploy to Cloud Run
Write-Host ""
Write-Host "🚀 Deploying to Cloud Run..." -ForegroundColor Cyan

$appKey = php artisan key:generate --show

gcloud run deploy booking-ruangan `
    --image $imageName `
    --platform managed `
    --region asia-southeast1 `
    --allow-unauthenticated `
    --set-env-vars "APP_ENV=production,APP_DEBUG=false,APP_KEY=$appKey,DB_CONNECTION=sqlite,DB_DATABASE=/data/database.sqlite" `
    --memory 512Mi `
    --cpu 1 `
    --min-instances 0 `
    --max-instances 10

if ($LASTEXITCODE -ne 0) {
    Write-Host "❌ Deploy gagal!" -ForegroundColor Red
    exit 1
}

Write-Host ""
Write-Host "🎉 DEPLOYMENT SELESAI!" -ForegroundColor Green
Write-Host ""
Write-Host "📝 Info penting:" -ForegroundColor Cyan
Write-Host "  • Region: asia-southeast1 (Singapore)" -ForegroundColor White
Write-Host "  • Database: SQLite (untuk prototype)" -ForegroundColor White
Write-Host "  • Auto-scaling: 0-10 instances" -ForegroundColor White
Write-Host ""
Write-Host "🔗 Akses aplikasi Anda di URL yang tertera di atas ☝️" -ForegroundColor Yellow
Write-Host ""
Write-Host "💡 Tips:" -ForegroundColor Cyan
Write-Host "  • Lihat logs: gcloud run services logs read booking-ruangan --limit=50" -ForegroundColor White
Write-Host "  • Update env: gcloud run services update booking-ruangan --set-env-vars KEY=VALUE" -ForegroundColor White
Write-Host "  • Delete: gcloud run services delete booking-ruangan" -ForegroundColor White
Write-Host ""

# Optional: Setup Cloud SQL
Write-Host ""
$setupDB = Read-Host "Apakah ingin setup Cloud SQL PostgreSQL untuk production? (y/n)"

if ($setupDB -eq "y" -or $setupDB -eq "Y") {
    Write-Host ""
    Write-Host "🗄️  Creating Cloud SQL instance..." -ForegroundColor Cyan
    Write-Host "⏳ Ini akan memakan waktu sekitar 5-10 menit..." -ForegroundColor Yellow
    
    gcloud sql instances create booking-ruangan-db `
        --database-version=POSTGRES_14 `
        --tier=db-f1-micro `
        --region=asia-southeast1 `
        --root-password=$(New-Guid).Guid
    
    gcloud sql databases create booking_ruangan --instance=booking-ruangan-db
    
    Write-Host "✅ Database created!" -ForegroundColor Green
    Write-Host "📝 Update Cloud Run untuk connect ke database" -ForegroundColor Cyan
}

Write-Host ""
Write-Host "✨ All done! Happy deploying! ✨" -ForegroundColor Green
