# HRIS Modul Pengajuan Izin dan Cuti Karyawan

**Human Resource Information System (HRIS) Modul Pengajuan Izin dan Cuti Karyawan Berbasis Web Menggunakan Framework CodeIgniter 4**

Aplikasi ini merupakan sistem informasi berbasis web yang dikembangkan untuk mendukung pengelolaan data karyawan, pengajuan izin dan cuti, proses verifikasi oleh HRD, serta pembuatan laporan administrasi kepegawaian.

Project ini dikembangkan sebagai bagian dari penelitian pada bagian Logistik PT Sekar Laut Tbk Plant 2 Sidoarjo.

## 📌 Deskripsi

Sistem dikembangkan untuk mendigitalisasi proses administrasi izin dan cuti karyawan yang sebelumnya dilakukan menggunakan formulir kertas dan melalui proses persetujuan berjenjang.

Sistem menyediakan pengelolaan data karyawan secara terpusat, pengajuan izin dan cuti secara daring, unggahan dokumen pendukung, proses verifikasi oleh HRD, pengecekan sisa hak cuti, serta pembuatan laporan dalam format PDF dan Excel.

## ✨ Fitur Utama

### Admin

* Login dan logout
* Mengelola data departemen
* Mengelola data jabatan
* Mengelola data karyawan
* Mengelola akun pengguna

### HRD

* Melihat data karyawan
* Mengelola hak cuti karyawan per tahun
* Melihat pengajuan izin dan cuti
* Melakukan verifikasi pengajuan
* Menyetujui atau menolak pengajuan
* Melihat dokumen pendukung
* Menerima notifikasi pengajuan
* Membuat laporan izin dan cuti
* Ekspor laporan ke PDF dan Excel

### Karyawan

* Login dan logout
* Mengajukan izin secara online
* Mengajukan cuti secara online
* Mengunggah dokumen pendukung
* Melihat sisa hak cuti
* Memantau status pengajuan
* Melihat riwayat pengajuan izin
* Melihat riwayat pengajuan cuti

## ⚙️ Fitur Khusus Pengajuan Cuti

Pada pengajuan cuti, sistem melakukan pengecekan sisa hak cuti sebelum pengajuan diproses.

Alur utama:

```text
Karyawan mengisi form cuti
        ↓
Sistem menghitung lama cuti
        ↓
Pengecekan sisa hak cuti
        ↓
   ┌───────────────┐
   │ Sisa mencukupi│
   └───────┬───────┘
           ↓
Status "Menunggu"
           ↓
      Verifikasi HRD
           ↓
    Disetujui / Ditolak
           ↓
Jika disetujui → sisa cuti otomatis berkurang
```

Apabila sisa cuti tidak mencukupi, sistem menolak pengajuan dan menampilkan pesan kepada pengguna.

## 🛠️ Teknologi

* **PHP 8.1+**
* **CodeIgniter 4**
* **MySQL**
* HTML
* CSS
* JavaScript
* Bootstrap
* Dompdf
* Composer
* Visual Studio Code
* XAMPP / Laragon

## 🏗️ Metode Pengembangan

Pengembangan sistem menggunakan **model Fountain**.

Tahapan yang diterapkan:

1. Analysis
2. Requirements Specification
3. System Design
4. Program Design
5. Coding
6. Testing and Integration
7. Operation and Software Maintenance

## 🗄️ Perancangan Basis Data

Sistem menggunakan tujuh entitas utama:

```text
departemen
jabatan
karyawan
users
hak_cuti
pengajuan_izin
pengajuan_cuti
```

Relasi antarentitas dirancang untuk mendukung pengelolaan data karyawan, hak cuti, pengajuan izin, pengajuan cuti, serta proses persetujuan HRD.

## 👥 Hak Akses

| Role     | Fungsi Utama                                                 |
| -------- | ------------------------------------------------------------ |
| Admin    | Mengelola data master dan akun pengguna                      |
| HRD      | Memproses pengajuan, mengelola hak cuti, dan membuat laporan |
| Karyawan | Mengajukan izin/cuti dan memantau status pengajuan           |

## 📸 Screenshots

### Login

![Login](docs/screenshots/01-login.png)

### Dashboard Admin

![Dashboard Admin](docs/screenshots/02-dashboard-admin.png)

### Dashboard Karyawan

![Dashboard Karyawan](docs/screenshots/03-dashboard-karyawan.png)

### Dashboard HRD

![Dashboard HRD](docs/screenshots/04-dashboard-hrd.png)

### Manajemen Data Karyawan

![Data Karyawan](docs/screenshots/05-data-karyawan.png)

### Form Pengajuan Izin

![Form Izin](docs/screenshots/06-form-izin.png)

### Form Pengajuan Cuti

![Form Cuti](docs/screenshots/07-form-cuti.png)

### Verifikasi HRD

![Verifikasi HRD](docs/screenshots/08-verifikasi-hrd.png)

### Notifikasi HRD

![Notifikasi HRD](docs/screenshots/09-notifikasi-hrd.png)

### Riwayat Pengajuan Izin

![Riwayat Izin](docs/screenshots/10-riwayat-izin.png)

### Riwayat Pengajuan Cuti

![Riwayat Cuti](docs/screenshots/11-riwayat-cuti.png)

### Laporan PDF dan Excel

![Laporan](docs/screenshots/12-laporan.png)

## 🧪 Pengujian

Pengujian sistem dilakukan menggunakan:

* **Black Box Testing**
* **User Acceptance Testing (UAT)**

Hasil pengujian Black Box menunjukkan seluruh skenario pengujian utama berjalan sesuai harapan.

Hasil UAT memperoleh rata-rata persentase kelayakan sebesar **85%** dengan kategori **Sangat Layak**.

## 🚀 Instalasi

Clone repository:

```bash
git clone https://github.com/baihaqihafid/hris-modul-izincuti.git
```

Masuk ke folder project:

```bash
cd hris-modul-izincuti
```

Install dependency:

```bash
composer install
```

Buat file `.env` berdasarkan konfigurasi environment CodeIgniter 4 dan sesuaikan konfigurasi database MySQL.

Import database menggunakan file:

```text
db_izincuti.sql
```

Sesuaikan konfigurasi database pada `.env`, kemudian jalankan aplikasi:

```bash
php spark serve
```

## 📁 Struktur Project

```text
hris-modul-izincuti/
├── app/
├── docs/
│   └── screenshots/
├── public/
├── tests/
├── writable/
├── db_izincuti.sql
├── composer.json
├── composer.lock
├── spark
├── .gitignore
└── README.md
```

## 📚 Penelitian

Project ini dikembangkan berdasarkan penelitian:

**"Perancangan Human Resource Information System (HRIS) Modul Pengajuan Izin dan Cuti Karyawan Berbasis Web Menggunakan Framework CodeIgniter 4"**

Program Studi Informatika
Universitas Muhammadiyah Sidoarjo

## 👨‍💻 Pengembang

**Ahmad Baihaqi Hafid**

Mahasiswa S1 Informatika
Universitas Muhammadiyah Sidoarjo
