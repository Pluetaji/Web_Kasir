# Sistem Kasir (Point of Sale) Restoran - Kelompok 10

Sistem informasi manajemen kasir restoran berbasis web dengan implementasi *Role-Based Access Control* (RBAC) yang memisahkan hak akses antara fungsionalitas Kasir dan Dasbor Analitik Manajer.

## 🛠️ Tech Stack Utama

*   **Backend & Interaktivitas:** Laravel 13 + Livewire 3
*   **Frontend UI:** HTML5 & Tailwind CSS
*   **Database:** MySQL 8.0
*   **Auth:** Laravel Breeze

## ⚙️ Requirements Dasar
Pastikan perangkat lokal (XAMPP/Laragon) memenuhi spesifikasi berikut sebelum menjalankan proyek:
*   PHP >= 8.2
*   Composer >= 2.x
*   Node.js >= 18
*   MySQL >= 8.0

## 🚀 Panduan Setup Lokal (Instalasi)

Ikuti langkah ini saat pertama kali menarik kode dari GitHub ke laptop masing-masing:

1. **Clone repository ini:**
   ```bash
   git clone https://github.com/Pluetaji/Web_Kasir.git
   cd Web_Kasir



2. **Install Dependencies:**
```bash
composer install
npm install

```


3. **Setup Environment:**
* Copy file `.env.example` menjadi `.env`.
* Buka file `.env`, lalu sesuaikan baris koneksi database:
`DB_DATABASE=db_kasir_restoran`
* Jalankan perintah *generate key*:
```bash
php artisan key:generate

```




4. **Setup Database & Storage:**
Pastikan MySQL menyala di lokal, lalu jalankan:
```bash
php artisan migrate:fresh --seed
php artisan storage:link

```



## 💻 Development Commands

Perintah harian yang sering digunakan selama masa pengembangan proyek:

```bash
# Menjalankan Vite dev server (hot reload CSS/JS untuk Faiz)
npm run dev

# Menjalankan Laravel server (untuk Dheka)
php artisan serve

# Membuat komponen Livewire baru (Tugas Dheka)
php artisan make:livewire NamaComponent

```
