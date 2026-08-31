# ☁️ Cloud Diary

Aplikasi SaaS (*Software as a Service*) kesehatan mental dan jurnal emosi yang dirancang khusus untuk siswa SMP dan SMA. Cloud Diary menjadi jembatan komunikasi yang aman antara siswa dan Guru Bimbingan Konseling (BK) dengan dukungan analisis AI.

## ✨ Fitur Utama (MVP)

*   🤖 **AI Emotion Analysis:** Menggunakan Google Gemini API untuk membaca, merangkum, dan mengklasifikasikan emosi siswa (Cerah, Mendung, Hujan, Badai, Cinta) sekaligus memberikan kalimat suportif secara instan.
*   🔒 **Privacy First (Tingkat Dewa):** Curhatan siswa adalah rahasia. Sistem menggunakan *Application-Level Encryption* di database Laravel (`encrypted casts`), sehingga data teks asli tidak bisa dibaca mentah-mentah jika terjadi kebocoran server.
*   🛡️ **Smart Anti-Spam & Limitasi:** Dilengkapi dengan 3 lapis filter validasi (Word Count, Regex, Blacklist) untuk menolak inputan teks tidak bermakna/spam, serta limitasi maksimal 3 curhatan per hari.
*   👥 **Role-Based Access Control:** Manajemen sistem yang rapi untuk **Superadmin** (Kelola Kelas & User), **Guru BK** (Dashboard Pemantauan Emosi), dan **Siswa** menggunakan Spatie Laravel-Permission.

## 🛠️ Tech Stack

*   **Framework:** Laravel
*   **Database:** MySQL
*   **AI Engine:** Google Gemini Pro / Flash API
*   **Access Management:** Spatie Laravel-Permission

## 🚀 Cara Instalasi (Local Development)

1. Clone repository ini:
```bash
git clone [https://github.com/RanggaWidiasmara/cloud-diary.git](https://github.com/RanggaWidiasmara/cloud-diary.git)
```
2. Masuk ke direktori project:
```bash
   cd cloud-diary
```   
3. Install dependencies:
```bash
composer install
```
4. Copy file environment dan atur konfigurasi database serta API Key:
```bash
cp .env.example .env
```
(Penting: Isi GEMINI_API_KEY dan kredensial database MySQL Anda di dalam file .env)

5. Generate application key:
```bash
php artisan key:generate
```
6. Jalankan migrasi database beserta tabel Role (Spatie):
```bash
php artisan migrate
```
7. Jalankan server lokal:
```bash
php artisan serve
```

👨‍💻 Tim Pengembang

Rangga - Backend Engineer & Database Architecture

Isfa - Server Hosting & Mobile Development

Iqmal - UI/UX Design & Frontend Development
