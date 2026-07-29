# POS NTBK Store Tasikmalaya

Sistem Point of Sale (POS) berbasis web yang dirancang khusus untuk manajemen operasional Toko Laptop/Notebook. Aplikasi ini mencakup manajemen stok, inventaris jasa, transaksi penjualan dengan dukungan transfer bank, hingga dashboard laporan yang komprehensif.

## 🚀 Fitur Utama

- **Dashboard Modern**: Visualisasi statistik penjualan, produk terlaris, dan ringkasan transaksi.
- **Manajemen Data Master**:
  - Supplier & Kategori.
  - Data Pelanggan.
  - **Manajemen Bank**: Kelola rekening bank untuk pembayaran transfer.
- **Manajemen Barang & Jasa**:
  - Stok Barang (Masuk & Keluar).
  - Produk Jasa (Servis/Repair).
- **Transaksi Penjualan**:
  - Checkout cepat dengan dukungan metode pembayaran Tunai & Transfer.
  - **Nota Digital**: Kirim struk pembelian langsung via WhatsApp atau Email.
  - **PDF Receipt**: Generate struk dalam format PDF yang profesional.
- **Sistem Laporan**:
  - Laporan penjualan harian/mingguan/bulanan.
  - Laporan keuntungan dan kerugian.
  - Export laporan ke format PDF & Excel.
- **User Interface**:
  - Mendukung **Dark Mode** & Light Mode.
  - Responsif untuk berbagai ukuran layar (AdminLTE 3).

## 🛠️ Tech Stack

- **Framework**: Laravel 7.x
- **Frontend**: AdminLTE 3 (Bootstrap 4)
- **Database**: MySQL
- **Library Utama**:
  - `barryvdh/laravel-dompdf` (PDF Generation)
  - `maatwebsite/excel` (Excel Export)
  - `fontawesome` (Icons)

## 💻 Instalasi Lokal

### Prasyarat
- PHP >= 7.2.5 (Direkomendasikan 7.4 atau 8.0)
- Composer
- MySQL/MariaDB

### Langkah-langkah
1. Clone repository:
   ```bash
   git clone https://github.com/KanaNatsume/poscabangnvt.git
   cd poscabangnvt
   ```
2. Install dependencies:
   ```bash
   composer install
   ```
3. Salin file environment:
   ```bash
   cp .env.example .env
   ```
4. Generate application key:
   ```bash
   php artisan key:generate
   ```
5. Konfigurasi database di file `.env`.
6. Jalankan migrasi dan seeder:
   ```bash
   php artisan migrate --seed
   ```
7. Jalankan server lokal:
   ```bash
   php artisan serve
   ```

### Default Login
- **Email**: `admin@gmail.com`
- **Password**: `admin`

## 🌐 Deploy ke VPS (Ubuntu/Debian)

Aplikasi ini sudah dilengkapi dengan script deployment otomatis untuk VPS menggunakan Nginx.

1. Sesuaikan variabel dalam `scripts/vps_deploy.sh` (Domain, Database, dll).
2. Jalankan script di server:
   ```bash
   sudo bash scripts/vps_deploy.sh
   ```

## 📄 Lisensi
Sistem ini dibuat untuk penggunaan internal NTBK Store Tasikmalaya.
